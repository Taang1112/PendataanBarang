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

/* ================= PUBLIC ================= */
Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

/* ================= GOOGLE LOGIN ================= */
Route::get('/auth/google', [GoogleController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

/* ================= CAPTCHA ================= */
Route::get('refresh-captcha', function () {
    return response()->json(['captcha' => captcha_img()]);
})->name('refresh.captcha');

/* ================= AUTH AREA ================= */
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /* PROFILE */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    /* ================= LAPORAN ================= */
    Route::get('/laporan/barang-masuk/pdf', [BarangMasukController::class, 'pdf'])->name('barang-masuk.pdf');
    Route::get('/laporan/barang-masuk/excel', [BarangMasukController::class, 'excel'])->name('barang-masuk.excel');

    Route::get('/laporan/barang-keluar/pdf', [BarangKeluarController::class, 'pdf'])->name('barang-keluar.pdf');
    Route::get('/laporan/barang-keluar/excel', [BarangKeluarController::class, 'excel'])->name('barang-keluar.excel');

    /* ================= BARANG MASUK INDEX (ADMIN + SUPPLIER) ================= */
    Route::get('barang-masuk', [BarangMasukController::class, 'index'])
        ->middleware('role:admin,supplier')
        ->name('barang-masuk.index');

    /* ================= ADMIN ONLY ================= */
    Route::middleware('role:admin')->group(function () {
        Route::resource('kategoris', KategoriController::class);
        Route::resource('barangs', BarangController::class);
        Route::resource('suppliers', SupplierController::class);
        Route::resource('barang-keluar', BarangKeluarController::class);
    });

    /* ================= SUPPLIER ONLY ================= */
    Route::middleware('role:supplier')->group(function () {
        Route::resource('barang-masuk', BarangMasukController::class)
            ->only(['create', 'store', 'destroy']);
    });

});

/* ================= TEST EMAIL ================= */
Route::get('/test-email', function () {
    Mail::raw('Ini email testing SMTP (Mailtrap)', function ($message) {
        $message->to('dummy@mail.com')->subject('Test SMTP');
    });

    return 'Email berhasil dikirim';
});
