<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ppdb', function (Blueprint $table) {
            $table->string('brosur_gambar')
                ->nullable()
                ->after('link_pendaftaran');

            $table->string('brosur_pdf')
                ->nullable()
                ->after('brosur_gambar');
        });
    }

    public function down(): void
    {
        Schema::table('ppdb', function (Blueprint $table) {
            $table->dropColumn([
                'brosur_gambar',
                'brosur_pdf',
            ]);
        });
    }
};