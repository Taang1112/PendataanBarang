<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Barang;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BarangMasukExport;
use App\Mail\BarangMasukNotif;
use Illuminate\Support\Facades\Mail;
use App\Models\User;


use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('role:supplier')->only(['create', 'store', 'destroy']);
    }

    public function index(Request $request)
    {
        $search  = $request->search;
        $tanggal = $request->tanggal;
    
        $data = BarangMasuk::with(['barang','supplier'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query->whereHas('barang', fn($b)=>$b->where('NamaBarang','like',"%$search%"))
                          ->orWhereHas('supplier', fn($s)=>$s->where('NamaSupplier','like',"%$search%"));
                });
            })
            ->when($tanggal, function ($q) use ($tanggal) {
                $q->whereDate('TanggalMasuk', $tanggal);
            })
            ->latest()
            ->get();
    
        return view('barang_masuk.index', compact('data'));
    }
    
    
    

    public function create()
    {
        $barangs = Barang::all();
        $suppliers = Supplier::all();
        return view('barang_masuk.create', compact('barangs', 'suppliers'));
    }

    public function store(Request $request)
{
    $request->validate([
        'BarangID' => 'required',
        'SupplierID' => 'required',
        'JumlahMasuk' => 'required|integer|min:1',
        'TanggalMasuk' => 'required|date',
    ]);

    
    $barangMasuk = BarangMasuk::create($request->all());

    
    $barang = Barang::find($request->BarangID);
    $barang->Stock += $request->JumlahMasuk;
    $barang->save();

    
    $barangMasuk->load(['barang.kategori','supplier']);

    
    $admins = User::where('role', 'admin')->pluck('email');

    
    foreach ($admins as $email) {
        Mail::to($email)->send(new BarangMasukNotif($barangMasuk));
    }

    return redirect()->route('barang-masuk.index')
           ->with('success', 'Barang masuk berhasil & stok bertambah');
}

    public function destroy($id)
    {
        $data = BarangMasuk::findOrFail($id);

        
        $barang = Barang::find($data->BarangID);
        $barang->Stock -= $data->JumlahMasuk;
        $barang->save();

        $data->delete();

        return back()->with('success', 'Data dihapus & stok dikurangi');
    }

    public function pdf(Request $request)
{
    $data = BarangMasuk::with(['barang','supplier'])
        ->whereBetween('TanggalMasuk', [$request->dari, $request->sampai])
        ->get();

    $pdf = Pdf::loadView('laporan.masuk_pdf', compact('data'));
    return $pdf->download('Laporan_Barang_Masuk.pdf');
}

public function excel()
{
    return Excel::download(new BarangMasukExport, 'BarangMasuk.xlsx');
}

}
