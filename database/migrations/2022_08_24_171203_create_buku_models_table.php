<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku_models', function (Blueprint $table) {
            $table->id('id_buku');
            $table->string('nama');
            $table->string('pengarang');
            $table->string('penerbit');
            $table->foreignId('id_kategori_buku');
            $table->string('barcode');
            $table->string('jumlah');
            $table->foreignId('id_kelas');
            $table->enum('status', [1, 2]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buku_models');
    }
};
