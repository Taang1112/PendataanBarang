<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barangs';
    protected $primaryKey = 'BarangID';

    protected $fillable = [
        'KategoriID',
        'NamaBarang',
        'Harga',
        'Stock',
        'Foto',
        'Deskripsi'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'KategoriID', 'KategoriID');
    }

    public function barangMasuk()
{
    return $this->hasMany(BarangMasuk::class, 'BarangID', 'BarangID');
}

public function barangKeluar()
{
    return $this->hasMany(BarangKeluar::class, 'BarangID', 'BarangID');
}

}
