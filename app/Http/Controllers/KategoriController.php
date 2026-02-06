<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $search = $request->search;

    $kategoris = Kategori::when($search, function ($q) use ($search) {
        $q->where('NamaKategori','like',"%$search%");
    })->get();

    return view('kategoris.index', compact('kategoris'));
}


    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategoris.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'NamaKategori' => 'required',
            'Deskripsi'    => 'required',
        ]);
        Kategori::create([
            'NamaKategori' => $request->NamaKategori,
            'Deskripsi'    => $request->Deskripsi,
        ]);
        return redirect('/kategoris')
               ->with('success', 'Data kategori berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($KategoriID)
{
    $kategori = Kategori::findOrFail($KategoriID);
    return view('kategoris.edit', compact('kategori'));
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $KategoriID)
    {
        $request->validate([
            'NamaKategori' => 'required',
            'Deskripsi' => 'required',
        ]);
        $kategori = Kategori::findOrFail($KategoriID);
        $kategori->update([
            'NamaKategori' => $request->NamaKategori,
            'Deskripsi' => $request->Deskripsi,
        ]);
        return redirect('/kategoris')
                ->with('success', 'Data Kategori Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($KategoriID)
    {
        $kategori = Kategori::findOrFail($KategoriID);
        $kategori->delete();

        return redirect('/kategoris')->with('success', 'Data Kategori Berhasil Dihapus');
    }
}
