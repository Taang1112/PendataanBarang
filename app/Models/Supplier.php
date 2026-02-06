<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $primaryKey = 'SupplierID';

    protected $fillable = [
        'NamaSupplier',
        'Alamat',
        'NoTelp',
        'Email'
    ];

    public function barangMasuk()
{
    return $this->hasMany(BarangMasuk::class, 'SupplierID', 'SupplierID');
}

}
