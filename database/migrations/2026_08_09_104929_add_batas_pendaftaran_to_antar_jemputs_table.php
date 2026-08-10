<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('antar_jemputs', function (Blueprint $table) {
            $table->date('batas_pendaftaran')
                ->nullable()
                ->after('pamflet_gambar');
        });
    }

    public function down(): void
    {
        Schema::table('antar_jemputs', function (Blueprint $table) {
            $table->dropColumn('batas_pendaftaran');
        });
    }
};