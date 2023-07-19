<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        if($search != null){
            $customer = Customer::where('company_name', 'iLIKE', "%{$search}%")->orWhere('pic', 'iLIKE', "%{$search}%")->paginate(10)->withQueryString(); 
        } else {
            $customer = Customer::paginate(10)->withQueryString();
        }

        return view('customer.index',[
            'customers' => $customer
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        $data = $request->validated();

        Customer::create($data);

        return redirect('/customer')->with('peringatan', 'Berhasil menambahkan data pelanggan.');
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
        $customer = Customer::where('id', $id)->first();

        return view('customer.edit',[
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, string $id)
    {
        $data = $request->validated();

        Customer::where('id', $id)->update($data);

        return redirect('/customer')->with('peringatan', 'Berhasil mengubah data pelanggan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::where('user_id', $id)->first();
        // dd($customer->image);
        User::destroy($id);
        if($customer->image != null){
            $file_path = storage_path('/app/public/'.$customer->image);
            unlink($file_path); 
        }

        return back()->with('peringatan', 'Berhasil menghapus data pelanggan.');
    }
}
