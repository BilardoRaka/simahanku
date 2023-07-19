<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductTypeRequest;
use App\Models\Material;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        if($search != null){
            $product_type = ProductType::where('product_type', 'iLIKE', "%{$search}%")->paginate(10)->withQueryString(); 
        } else {
            $product_type = ProductType::paginate(10)->withQueryString();
        }

        return view('product_type.index',[
            'product_types' => $product_type
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $material = Material::all();

        return view('product_type.create',[
            'materials' => $material
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductTypeRequest $request)
    {
        $data = $request->validated();

        ProductType::create($data);

        $material = $request->material;
        $amount = $request->amount;
        $product_type = ProductType::where('product_type', $data['product_type'])->first();
        
        for( $i=0; $i < count($amount); $i++ ) {
            $product_type->material()->attach($material[$i], [
                'amount' => $amount[$i]
            ]);
        }

        return redirect('/type')->with('peringatan', 'Berhasil menambahkan jenis produk baru.');
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
        $product_type = ProductType::where('id', $id)->first();
        $material = Material::all();

        return view('product_type.edit',[
            'product_type' => $product_type,
            'mats' => $material
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductTypeRequest $request, string $id)
    {
        $data = $request->validated();

        ProductType::where('id', $id)->update($data);

        $material = $request->material;
        $amount = $request->amount;
        $product_type = ProductType::where('id', $id)->first();

        $extra = array_map(function($qty){
            return ['amount' => $qty];
        }, $amount);

        $pivot = array_combine($material, $extra);

        $product_type->material()->sync($pivot);

        return redirect('/type')->with('peringatan', 'Berhasil mengubah data jenis produk.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ProductType::destroy($id);

        return back()->with('peringatan', 'Berhasil menghapus data jenis produk.');
    }
}
