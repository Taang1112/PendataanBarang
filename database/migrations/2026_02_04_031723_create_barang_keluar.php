<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangKeluar extends Migration
{
    
    public function up()
    {
            Schema::create('barang_keluar', function (Blueprint $table) {
                $table->bigIncrements('BarangKeluarID');
            
                $table->unsignedBigInteger('BarangID');
                $table->integer('JumlahKeluar');
                $table->date('TanggalKeluar');
                $table->string('Tujuan')->nullable();
                $table->text('Keterangan')->nullable();
            
                $table->timestamps();
            
                
                $table->foreign('BarangID')
                      ->references('BarangID')
                      ->on('barangs')
                      ->onDelete('cascade');
            });
            
        
    }

    
    public function down()
    {
        Schema::dropIfExists('barang_keluar');
    }
}
