<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeris', function (Blueprint $table) {

            $table->id();

            $table->string('judul');

            $table->enum('tipe', [
                'foto',
                'video',
            ]);

            $table->text('deskripsi')
                ->nullable();

            /*
             * Untuk galeri foto.
             * Untuk video juga boleh dipakai sebagai thumbnail.
             */
            $table->string('gambar')
                ->nullable();

            /*
             * Link YouTube untuk tipe video.
             */
            $table->string('video_url')
                ->nullable();

            $table->boolean('aktif')
                ->default(true);

            $table->unsignedInteger('urutan')
                ->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeris');
    }
};