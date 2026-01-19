<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('program_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->text('penulis');
            $table->text('nama_file');
            $table->string('kategori');
            $table->date('tanggal');
            $table->string('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_kegiatan');
    }
};
