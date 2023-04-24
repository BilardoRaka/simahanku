<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaterialRequest;
use App\Models\Material;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MaterialController extends Controller
{
    /**
     * Display a listing of the
     *  resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        if($search != null){
            $material = Material::where('name', 'iLIKE', "%{$search}%")->paginate(10)->withQueryString(); 
        } else {
            $material = Material::paginate(10)->withQueryString();
        }

        return view('material.index',[
            'materials' => $material
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('material.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MaterialRequest $request)
    {
        $data = $request->validated();

        Material::create($data);

        return redirect('/material')->with('peringatan', 'Berhasil menambahkan data bahan baku baru.');
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
        $material = Material::where('id', $id)->first();

        return view('material.edit',[
            'material' => $material
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MaterialRequest $request, string $id)
    {
        $data = $request->validated();

        Material::where('id', $id)->update($data);

        return redirect('/material')->with('peringatan', 'Berhasil mengubah data bahan baku.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Material::destroy($id);

        return redirect('/material')->with('peringatan', 'Berhasil menghapus data bahan baku.');
    }

    public function pdf()
    {
        $material = Material::all();
        $date = Carbon::now()->format('d-m-Y');

        $pdf = Pdf::loadView('material.pdf', [
            'materials' => $material,
            'date' => $date
        ])->setPaper('a5');;

        return $pdf->stream('BahanBaku - '. $date .'.pdf',array('Attachment'=>0));

    }
}
