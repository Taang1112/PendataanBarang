<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $table = 'barang_keluar';
    protected $primaryKey = 'BarangKeluarID';

    protected $fillable = [
        'BarangID',
        'JumlahKeluar',
        'TanggalKeluar',
        'Tujuan',
        'Keterangan',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'BarangID', 'BarangID');
    }
}
