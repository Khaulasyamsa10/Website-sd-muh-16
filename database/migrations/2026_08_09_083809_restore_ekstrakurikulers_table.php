<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Buat tabel hanya jika belum tersedia
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasTable('ekstrakurikulers')) {

            Schema::create('ekstrakurikulers', function (Blueprint $table) {

                $table->id();

                $table->string('nama');

                $table->enum('kategori', [
                    'wajib',
                    'pilihan',
                    'bimpres',
                ]);

                $table->string('kelas')
                    ->nullable();

                $table->string('jadwal')
                    ->nullable();

                $table->text('keterangan')
                    ->nullable();

                $table->string('gambar')
                    ->nullable();

                $table->boolean('aktif')
                    ->default(true);

                $table->unsignedInteger('urutan')
                    ->default(0);

                $table->timestamps();

            });

        }
    }

    public function down(): void
    {
        Schema::dropIfExists('ekstrakurikulers');
    }
};