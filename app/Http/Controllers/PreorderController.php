<?php

namespace App\Http\Controllers;

use App\Http\Requests\PreorderRequest;
use App\Models\Customer;
use App\Models\Material;
use App\Models\Preorder;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PreorderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $preorder = Preorder::latest()->paginate(10);

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

        $data['user_id'] = auth()->user()->id;
        $data['status'] = 'Pending';

        Preorder::create($data);

        return redirect('/preorder')->with('peringatan', 'Berhasil menambahkan data preorder baru. Status masih pending, silahkan konfirmasi dahulu untuk memulai produksi.');

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

        return back()->with('peringatan', 'Berhasil menolak dan menghapus data preorder.');
    }

    public function confirm(string $id)
    {
        $preorder = Preorder::find($id);
        $product = Product::find($preorder->product_id);
        $materials = $product->material;

        Preorder::where('id', $id)->update([
            'status' => 'Confirmed'
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
}
