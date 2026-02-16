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

    
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'BarangID', 'BarangID');
    }

    
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'SupplierID', 'SupplierID');
    }
}
