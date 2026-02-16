<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Supplier;

// -------------------------------
// Root Route (Safe Version)
// -------------------------------
Route::get('/', function () {
    try {
        $barangs = Barang::with('kategori')->latest()->take(3)->get();
        $kategoris = Kategori::take(4)->get();
        $totalBarang = Barang::count();
        $totalSupplier = Supplier::count();
    } catch (\Exception $e) {
        // fallback aman kalau database belum siap
        $barangs = collect();
        $kategoris = collect();
        $totalBarang = 0;
        $totalSupplier = 0;
    }

    return view('welcome', [
        'barangs' => $barangs,
        'kategoris' => $kategoris,
        'totalBarang' => $totalBarang,
        'totalSupplier' => $totalSupplier,
    ]);
});

// -------------------------------
// Auth Routes
// -------------------------------
require __DIR__.'/auth.php';

// Google OAuth
Route::get('/auth/google', [GoogleController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

// Refresh Captcha
Route::get('refresh-captcha', function () {
    return response()->json(['captcha' => captcha_img()]);
})->name('refresh.captcha');

// -------------------------------
// Authenticated Routes
// -------------------------------
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Laporan Barang Masuk / Keluar
    Route::get('/laporan/barang-masuk/pdf', [BarangMasukController::class, 'pdf'])->name('barang-masuk.pdf');
    Route::get('/laporan/barang-masuk/excel', [BarangMasukController::class, 'excel'])->name('barang-masuk.excel');

    Route::get('/laporan/barang-keluar/pdf', [BarangKeluarController::class, 'pdf'])->name('barang-keluar.pdf');
    Route::get('/laporan/barang-keluar/excel', [BarangKeluarController::class, 'excel'])->name('barang-keluar.excel');

    // Barang Masuk (admin & supplier)
    Route::get('barang-masuk', [BarangMasukController::class, 'index'])
        ->middleware('role:admin,supplier')
        ->name('barang-masuk.index');

    // -------------------------------
    // Admin Only Routes
    // -------------------------------
    Route::middleware('role:admin')->group(function () {
        Route::resource('kategoris', KategoriController::class);
        Route::resource('barangs', BarangController::class);
        Route::resource('suppliers', SupplierController::class);
        Route::resource('barang-keluar', BarangKeluarController::class);
    });

    // -------------------------------
    // Supplier Only Routes
    // -------------------------------
    Route::middleware('role:supplier')->group(function () {
        Route::resource('barang-masuk', BarangMasukController::class)
            ->only(['create', 'store', 'destroy']);
    });

});

// -------------------------------
// Test Email
// -------------------------------
Route::get('/test-email', function () {
    try {
        Mail::raw('Ini email testing SMTP (Mailtrap)', function ($message) {
            $message->to('dummy@mail.com')->subject('Test SMTP');
        });
        return 'Email berhasil dikirim';
    } catch (\Exception $e) {
        return 'Gagal kirim email: '.$e->getMessage();
    }
});
