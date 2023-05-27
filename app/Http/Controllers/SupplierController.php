<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        if($search != null){
            $supplier = Supplier::where('name', 'iLIKE', "%{$search}%")->orWhere('email', 'iLIKE', "%{$search}%")->paginate(10)->withQueryString(); 
        } else {
            $supplier = Supplier::paginate(10)->withQueryString();
        }

        return view('supplier.index',[
            'suppliers' => $supplier
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
        $data = $request->validated();

        Supplier::create($data);

        return redirect('/supplier')->with('peringatan', 'Berhasil menambahkan data pemasok.');
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
        $supplier = Supplier::where('id', $id)->first();

        return view('supplier.edit',[
            'supplier' => $supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierRequest $request, string $id)
    {
        $data = $request->validated();

        Supplier::where('id', $id)->update($data);

        return redirect('/supplier')->with('peringatan', 'Berhasil mengubah data pemasok.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Supplier::destroy($id);

        return back()->with('peringatan', 'Berhasil menghapus data pemasok.');
    }
}
