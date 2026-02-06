<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangMasuk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->bigIncrements('BarangMasukID');
            $table->unsignedBigInteger('BarangID');
            $table->unsignedBigInteger('SupplierID');
            $table->integer('JumlahMasuk');
            $table->date('TanggalMasuk');
            $table->text('Keterangan')->nullable();
            $table->timestamps();
        
            $table->foreign('BarangID')->references('BarangID')->on('barangs')->onDelete('cascade');
            $table->foreign('SupplierID')->references('SupplierID')->on('suppliers')->onDelete('cascade');
        });
        
         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_masuk');
    }
}
