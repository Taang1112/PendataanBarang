<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    
    public function index(Request $request)
{
    $search = $request->search;

    $kategoris = Kategori::when($search, function ($q) use ($search) {
        $q->where('NamaKategori','like',"%$search%");
    })->get();

    return view('kategoris.index', compact('kategoris'));
}


    

    
    public function create()
    {
        return view('kategoris.create');
    }

    
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

    
    public function show($id)
    {
        
    }

    
    public function edit($KategoriID)
{
    $kategori = Kategori::findOrFail($KategoriID);
    return view('kategoris.edit', compact('kategori'));
}


    
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

    
    public function destroy($KategoriID)
    {
        $kategori = Kategori::findOrFail($KategoriID);
        $kategori->delete();

        return redirect('/kategoris')->with('success', 'Data Kategori Berhasil Dihapus');
    }
}
