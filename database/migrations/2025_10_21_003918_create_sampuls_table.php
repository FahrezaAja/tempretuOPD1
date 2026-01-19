<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sampuls', function (Blueprint $table) {
            $table->id();
            $table->string('nama_opd');
            $table->text('deskripsi');
            $table->string('foto_pemimpin')->nullable(); // foto pimpinan OPD
            $table->string('media')->nullable(); // bisa gambar/video sampul
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('sampuls');
    }
};
