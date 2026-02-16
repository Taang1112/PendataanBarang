<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        
        $totalBarang   = Barang::count();
        $totalKategori = Kategori::count();
        $totalSupplier = Supplier::count();
        $totalStok     = Barang::sum('Stock');
        $totalNilai    = Barang::selectRaw('SUM(Harga * Stock) as total')->value('total');

        
        $masukHariIni  = BarangMasuk::whereDate('TanggalMasuk', today())->sum('JumlahMasuk');
        $keluarHariIni = BarangKeluar::whereDate('TanggalKeluar', today())->sum('JumlahKeluar');

        
        $grafikKategori = DB::table('barangs')
            ->join('kategoris', 'barangs.KategoriID', '=', 'kategoris.KategoriID')
            ->select('kategoris.NamaKategori', DB::raw('COUNT(barangs.BarangID) as total'))
            ->groupBy('kategoris.NamaKategori')
            ->get();

        return view('dashboard', compact(
            'totalBarang',
            'totalKategori',
            'totalSupplier',
            'totalStok',
            'totalNilai',
            'masukHariIni',
            'keluarHariIni',
            'grafikKategori'
        ));
    }
}
