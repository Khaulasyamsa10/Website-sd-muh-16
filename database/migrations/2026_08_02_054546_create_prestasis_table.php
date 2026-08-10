<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id();

            $table->string('judul');

            /*
             * Pilihan:
             * akademik
             * olahraga
             * keislaman
             * seni
             */
            $table->string('kategori')->index();

            $table->string('nama_peserta')->nullable();
            $table->string('kelas')->nullable();
            $table->string('peringkat')->nullable();
            $table->string('tingkat')->nullable();

            $table->date('tanggal')->nullable();

            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();

            $table->boolean('aktif')->default(true);
            $table->unsignedInteger('urutan')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};