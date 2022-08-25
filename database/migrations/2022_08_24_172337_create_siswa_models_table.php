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
        Schema::create('siswa_models', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->string('nama');
            $table->string('nisn');
            $table->foreignId('id_kelas');
            $table->string('jurusan');
            $table->string('alamat');
            $table->string('tanggal_lahir');
            $table->string('foto');
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
        Schema::dropIfExists('siswa_models');
    }
};
