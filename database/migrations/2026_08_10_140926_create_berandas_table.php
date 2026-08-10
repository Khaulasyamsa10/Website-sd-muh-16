<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beranda', function (Blueprint $table) {
            $table->id();

            /* HERO */
            $table->string('hero_background')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('hero_judul')->default('Selamat Datang di');
            $table->string('hero_nama_sekolah')->default('SD Muhammadiyah 16 Karangasem Surakarta');
            $table->string('hero_tagline')->nullable();

            /* VISI MISI */
            $table->string('visi_image')->nullable();
            $table->string('visi_caption')->nullable();
            $table->string('visi_tagline')->nullable();

            $table->longText('visi')->nullable();
            $table->longText('misi')->nullable();

            /* KEPALA SEKOLAH */
            $table->string('kepsek_foto')->nullable();
            $table->string('kepsek_nama')->nullable();
            $table->string('kepsek_jabatan')->nullable();

            $table->string('kepsek_pembuka')->nullable();
            $table->longText('kepsek_sambutan')->nullable();
            $table->string('kepsek_penutup')->nullable();

            /* VIDEO PROFIL */
            $table->string('video_judul')->nullable();
            $table->text('video_deskripsi')->nullable();
            $table->string('video_url')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beranda');
    }
};