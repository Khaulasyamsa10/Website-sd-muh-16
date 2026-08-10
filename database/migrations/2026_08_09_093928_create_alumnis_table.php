<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumni', function (Blueprint $table) {

            $table->id();

            $table->string('nama_lengkap');

            $table->year('tahun_lulus');

            $table->enum('jenis_kelamin', [
                'Laki-laki',
                'Perempuan',
            ]);

            $table->string('no_hp')
                ->nullable();

            $table->string('email')
                ->nullable();

            $table->string('pendidikan_saat_ini')
                ->nullable();

            $table->string('pekerjaan')
                ->nullable();

            $table->text('alamat')
                ->nullable();

            $table->text('pesan_kesan')
                ->nullable();

            $table->enum('status', [
                'baru',
                'dibaca',
            ])->default('baru');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};