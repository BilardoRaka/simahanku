<?php

namespace App\Http\Controllers;

use App\Http\Requests\PreorderRequest;
use App\Models\Customer;
use App\Models\Material;
use App\Models\PaymentLog;
use App\Models\Preorder;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use iPaymu\iPaymu;

class PreorderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->role == 'customer'){
            $preorder = Preorder::where('customer_id', auth()->user()->customer?->id)->latest()->paginate(10);
        } else {
            $preorder = Preorder::latest()->paginate(10);
        }

        return view('preorder.index',[
            'preorders' => $preorder
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customer = Customer::all();
        $product = Product::all();

        return view('preorder.create',[
            'customers' => $customer,
            'products' => $product
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PreorderRequest $request)
    {
        $data = $request->validated();

        $data['status'] = 'pending';

        $data['payment_status'] = 'pending';

        Preorder::create($data);

        return redirect('/preorder')->with('peringatan', 'Pesanan berhasil dibuat, silahkan lakukan pembayaran agar perusahaan dapat memulai produksi.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Preorder::destroy($id);

        return back()->with('peringatan', 'Berhasil membatalkan data preorder.');
    }

    public function confirm(string $id)
    {
        $preorder = Preorder::find($id);
        $product = Product::find($preorder->product_id);
        $materials = $product->material;

        Preorder::where('id', $id)->update([
            'status' => 'confirmed'
        ]);

        foreach($materials as $material){
            Material::where('id', $material->id)->decrement('stock', $material->pivot->amount*$preorder->amount);
        }

        return back()->with('peringatan', 'Berhasil menerima preorder dan memulai produksi.');
    }

    public function pdf(string $id)
    {
        $preorder = Preorder::find($id);

        $image = base64_encode(file_get_contents(public_path('images/nifandatama.png')));

        $pdf = Pdf::loadView('preorder.pdf', [
            'preorder' => $preorder,
            'image' => $image
        ])->setPaper('a5','landscape');;

        return $pdf->stream('Preorder-id-'. $id .'.pdf',array('Attachment'=>0));
    }

    public function paymentPage(string $id)
    {
        $preorder = Preorder::where('id', $id)->first();

        return view('preorder.payment',[
            'preorder' => $preorder
        ]);
    }

    public function paymentPost(Request $request, string $id)
    {
        $preorder = Preorder::where('id', $id)->first();
        $customer_name = $request->customer_name;
        $customer_email = $request->customer_email;
        $customer_phone = $request->customer_phone;
        $product_name = $request->product_name;
        $total_price = $request->total_price;
        $payment_channel = $request->payment_channel;
        $referenceId = 'PRE-'.time();

        $apiKey = \Config::get('env.apiKey'); // your api key
        $va = \Config::get('env.va'); // your va
        $production = \Config::get('env.staging');

        $iPaymu = new iPaymu($apiKey, $va, $production);

        // set callback url
        $iPaymu->setURL([
            'ureturn' => 'https://your-website/thankyou_page',
            'unotify' => \Config::get('env.notifyURL'),
            'ucancel' => 'https://your-website/cancel_page',
        ]);

        // set buyer name
        $iPaymu->setBuyer([
            'name' => $customer_name,
            'phone' => '085555983293',
            'email' => $customer_email,
        ]);

        // set your reference id (optional)
        $iPaymu->setReferenceId($referenceId);

        // set your expiredPayment
        $iPaymu->setExpired(24, 'hours'); // 24 hours

        // set payment method
        // check https://ipaymu.com/api-collection for list payment method
        $iPaymu->setPaymentMethod('va');

        // check https://ipaymu.com/api-collection for list payment channel
        // $iPaymu->setPaymentChannel($paymentChannel);
        $iPaymu->setPaymentChannel($payment_channel);

        $carts = [];
        $carts = $iPaymu->add(
            $preorder->id, // product id (string)
            $product_name, // product name (string)
            $total_price, // price (float)
            1, // quantity (int)
            $preorder->product->description, // description
        );        

        $iPaymu->addCart($carts);
        $encode_data = json_encode($iPaymu->directPayment());
        $decode_data = json_decode($encode_data);

        if($decode_data->Status != 200){
            return to_route('preorder.index')->with('alertFailed', $decode_data->Message);            
        }

        PaymentLog::create([
            'session_id' => $decode_data->Data->SessionId,
            'transaction_id' => $decode_data->Data->TransactionId,
            'reference_id' => $decode_data->Data->ReferenceId,
            'via' => $decode_data->Data->Via,
            'channel' => $decode_data->Data->Channel,
            'payment_no' => $decode_data->Data->PaymentNo,
            'payment_name' => $decode_data->Data->PaymentName,
            'subtotal' => $decode_data->Data->SubTotal,
            'fee' => $decode_data->Data->Fee,
            'total' => $decode_data->Data->Total,
            'fee_direction' => $decode_data->Data->FeeDirection,
            'log_json' => $encode_data,
            'expired_at' => $decode_data->Data->Expired
        ]);

        $data['reference_id'] = $decode_data->Data->ReferenceId;
        Preorder::where('id', $id)->update($data);

        return to_route('preorder.notification', $referenceId)->with('alertSuccess', 'Berhasil melakukan permintaan transaksi, silahkan dibayar.');
        
        // return to_route('preorder.index')->with('peringatan', 'Pembuatan invoice berhasil, silahkan bayar pada nomor rekening yang tersedia');

    }

    public function paymentNotification($session_id)
    {
        $payment = PaymentLog::where('session_id', $session_id)->first(); 
        
        $now = str_replace(['-',':',' '],'',date('Y-m-d H:i', strtotime(now('GMT+7'))));
        $expire = str_replace(['-',':',' '],'',date('Y-m-d H:i', strtotime($payment->expired_at)));

        if($expire < $now){
            return back()->with('alertFailed', 'Payment kadaluarsa, silahkan membuat invoice baru.');
        }

        return view('preorder.notification',[
            'payment' => $payment
        ]);
    }

    public function callbackPayment(Request $request)
    {
        $status = $request->status;
        $reference_id = $request->reference_id;

        if($status == 'berhasil'){
            $status = 'paid';
        }

        $data['payment_status'] = $status;
        Preorder::where('reference_id', $reference_id)->update($data);

        return response('Callback Berhasil!',200);
    }
}
