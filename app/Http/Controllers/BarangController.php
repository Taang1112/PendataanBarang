<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BarangCreatedMail;

class BarangController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;
    $kategori = $request->kategori; // dari dropdown filter

    $barangs = Barang::with('kategori')
        ->when($search, function ($q) use ($search) {
            $q->where('NamaBarang', 'like', "%$search%")
              ->orWhere('Harga', 'like', "%$search%")
              ->orWhere('Stock', 'like', "%$search%")
              ->orWhereHas('kategori', function ($k) use ($search) {
                  $k->where('NamaKategori', 'like', "%$search%");
              });
        })
        ->when($kategori, function ($q) use ($kategori) {
            $q->where('KategoriID', $kategori);
        })
        ->get();

    // ⬇️ INI YANG KURANG
    $kategoris = \App\Models\Kategori::all();

    return view('barangs.index', compact('barangs','kategoris'));
}

    

    public function store(Request $request)
  
{
    $request->validate([
        'KategoriID' => 'required|exists:kategoris,KategoriID',
        'NamaBarang' => 'required',
        'Harga' => 'required|numeric',
        'Stock' => 'required|numeric',
        'Deskripsi' => 'required',
        'Foto' => 'nullable|image',
    ]);

    $foto = null;

    if ($request->hasFile('Foto')) {
        $file = $request->file('Foto');
        $namaFoto = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('foto_barang'), $namaFoto);
        $foto = $namaFoto;
    }

    $barang = Barang::create([
        'NamaBarang' => $request->NamaBarang,
        'KategoriID' => $request->KategoriID,
        'Harga' => $request->Harga,
        'Stock' => $request->Stock,
        'Deskripsi' => $request->Deskripsi,
        'Foto' => $foto
    ]);

    Mail::to('dummy@mail.com')->send(
        new BarangCreatedMail($barang)
    );

    return redirect()->route('barangs.index')->with('success', 'Barang berhasil ditambahkan');
}

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategoris = Kategori::all();
        return view('barangs.edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'KategoriID' => 'required|exists:kategoris,KategoriID',
            'NamaBarang' => 'required',
            'Harga' => 'required|numeric',
            'Stock' => 'required|numeric',
            'Deskripsi' => 'required',
            'Foto' => 'nullable|image',
        ]);

        $data = $request->all();

        if ($request->hasFile('Foto')) {
            $foto = $request->file('Foto');
            $namaFoto = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('foto_barang'), $namaFoto);
            $data['Foto'] = $namaFoto;
        }

        $barang->update($data);

        return redirect()->route('barangs.index')->with('success', 'Barang berhasil diupdate');
    }

    public function destroy($id)
    
    {
        Barang::destroy($id);
        return redirect()->route('barangs.index')->with('success', 'Data berhasil dihapus');
    }

}
