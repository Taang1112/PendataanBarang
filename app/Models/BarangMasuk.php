<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuk';
    protected $primaryKey = 'BarangMasukID';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'BarangID',
        'SupplierID',
        'JumlahMasuk',
        'TanggalMasuk',
        'Keterangan'
    ];

    // 🔗 Relasi ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'BarangID', 'BarangID');
    }

    // 🔗 Relasi ke Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'SupplierID', 'SupplierID');
    }
}
