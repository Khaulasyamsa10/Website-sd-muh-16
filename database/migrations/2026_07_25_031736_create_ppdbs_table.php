<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ppdb', function (Blueprint $table) {
            $table->id();

            // Informasi PPDB
            $table->string('judul');
            $table->text('deskripsi')->nullable();

            $table->string('gambar')->nullable();
            $table->string('brosur')->nullable();

            // Informasi singkat
            $table->string('tahun_ajaran');
            $table->string('jenjang');
            $table->string('status');
            $table->string('kuota');

            // Tombol daftar
            $table->string('link_pendaftaran')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb');
    }
};