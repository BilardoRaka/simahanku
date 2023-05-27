<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Material;
use App\Models\Product;
use App\Models\ProductType;
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
        $product_type = ProductType::all();
        
        return view('product.create',[
            'materials' => $material,
            'product_types' => $product_type
        ]);        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['space'] = $data['long'] * $data['wide'] * $data['height'];
        Product::create($data);

        $material = $request->material;
        $product = Product::where('product_type_id', $data['product_type_id'])->where('space', $data['space'])->first();
        $recommendation = ProductType::where('id', $data['product_type_id'])->first();

        if($data['product_type_id'] == '1') {
            $PSheet = (($data['long']+1)+($data['wide']+1)+5) * 2;
            $LSheet = ($data['wide']+1)+($data['height']+1);
            $stringSheet = 'Sheet ukuran '.$PSheet.'x'.$LSheet;
            $material = Material::where('name', $stringSheet)->first();

            if($material == null){
                Material::create([
                    'name' => $stringSheet,
                    'unit' => 'Lembar',
                ]);
            }

            $addSheet = Material::where('name', $stringSheet)->first();
            $product->material()->attach($addSheet->id, [
                'amount' => 1
            ]);
        }


        foreach($recommendation->material as $material){
            $product->material()->attach($material->id, [
                'amount' => $material->pivot->amount * $data['space']
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
        $product = Product::where('id', $id)->first();

        $extra = array_map(function($qty){
            return ['amount' => $qty];
        }, $amount);

        $pivot = array_combine($material, $extra);

        $product->material()->sync($pivot);

        return redirect('/product')->with('peringatan', 'Berhasil mengubah data produk.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);

        return back()->with('peringatan', 'Berhasil menghapus data produk.');
    }
}
