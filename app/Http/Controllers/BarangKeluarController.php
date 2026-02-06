<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BarangKeluarExport;
use Illuminate\Http\Request;



class BarangKeluarController extends Controller
{
    public function index(Request $request)
{
    $search  = $request->search;
    $tanggal = $request->tanggal;

    $data = BarangKeluar::with('barang')
        ->when($search, function ($q) use ($search) {
            $q->whereHas('barang', fn($b)=>$b->where('NamaBarang','like',"%$search%"));
        })
        ->when($tanggal, function ($q) use ($tanggal) {
            $q->whereDate('tanggal_keluar', $tanggal);
        })
        ->latest()
        ->get();

    return view('barang_keluar.index', compact('data'));
}

    


    public function create()
    {
        $barangs = Barang::all();
        return view('barang_keluar.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'BarangID' => 'required',
            'JumlahKeluar' => 'required|integer|min:1',
            'TanggalKeluar' => 'required|date',
        ]);

        $barang = Barang::findOrFail($request->BarangID);

        // ❌ Cegah stok minus
        if ($request->JumlahKeluar > $barang->Stock) {
            return back()->with('error', 'Stok tidak cukup!');
        }

        // Simpan barang keluar
        BarangKeluar::create($request->all());

        // Kurangi stok
        $barang->decrement('Stock', $request->JumlahKeluar);

        return redirect()->route('barang-keluar.index')
                         ->with('success', 'Barang keluar berhasil dicatat & stok diperbarui');
    }

    public function destroy($id)
    {
        $data = BarangKeluar::findOrFail($id);

        // Balikin stok kalau dihapus
        $barang = Barang::find($data->BarangID);
        $barang->increment('Stock', $data->JumlahKeluar);

        $data->delete();

        return back()->with('success', 'Data dihapus & stok dikembalikan');
    }


    public function pdf(Request $request)
{
    $data = BarangKeluar::with('barang')
        ->whereBetween('TanggalKeluar', [$request->dari, $request->sampai])
        ->get();

    $pdf = Pdf::loadView('laporan.keluar_pdf', compact('data'));
    return $pdf->download('Laporan_Barang_Keluar.pdf');
}

public function excel()
{
    return Excel::download(new BarangKeluarExport, 'BarangKeluar.xlsx');
}


}
