<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplyRequest;
use App\Models\Material;
use App\Models\Supplier;
use App\Models\Supply;
use Illuminate\Http\Request;

class SupplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supply = Supply::with(['user','supplier','material'])->latest()->paginate(10);

        return view('supply.index',[
            'supplies' => $supply,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $supplier = Supplier::all();
        $material = Material::all();

        return view('supply.create',[
            'suppliers' => $supplier,
            'materials' => $material
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplyRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->user()->id;

        Supply::create($data);
        Material::where('id', $data['material_id'])->increment('stock', $data['amount']);

        return redirect('/supply')->with('peringatan', 'Berhasil menambahkan data suplai bahan baku masuk.');
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
        //
    }
}
