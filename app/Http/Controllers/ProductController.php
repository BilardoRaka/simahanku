<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Material;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        if($search != null){
            $product = Product::where('name', 'iLIKE', "%{$search}%")->orWhere('description', 'iLIKE', "%{$search}%")->paginate(10)->withQueryString(); 
        } else {
            $product = Product::paginate(10)->withQueryString();
        }

        return view('product.index',[
            'products' => $product
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $material = Material::all();
        
        return view('product.create',[
            'materials' => $material
        ]);        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        Product::create($data);

        $material = $request->material;
        $amount = $request->amount;
        $product = Product::where('name', $data['name'])->first();
        
        for( $i=0; $i < count($amount); $i++ ) {
            $product->material()->attach($material[$i], [
                'amount' => $amount[$i]
            ]);
        }

        return redirect('/product')->with('peringatan', 'Berhasil menambahkan produk baru.');

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
        $product = Product::where('id', $id)->first();
        $material = Material::all();

        return view('product.edit',[
            'product' => $product,
            'mats' => $material
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $data = $request->validated();

        Product::where('id', $id)->update($data);

        $material = $request->material;
        $amount = $request->amount;
        $product = Product::where('name', $data['name'])->first();
        
        $product->material()->sync($material,[
            'amount' => $amount
        ]);

        return redirect('/product')->with('peringatan', 'Berhasil mengubah data produk.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
