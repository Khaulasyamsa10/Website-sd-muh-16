<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ppdb', function (Blueprint $table) {
            $table->boolean('aktif')
                ->default(false)
                ->after('brosur_pdf');
        });

        /*
         * Data PPDB terakhir yang sudah ada
         * otomatis dijadikan aktif.
         */
        $ppdbTerakhir = DB::table('ppdb')
            ->orderByDesc('id')
            ->first();

        if ($ppdbTerakhir) {
            DB::table('ppdb')
                ->where('id', $ppdbTerakhir->id)
                ->update([
                    'aktif' => true,
                ]);
        }
    }

    public function down(): void
    {
        Schema::table('ppdb', function (Blueprint $table) {
            $table->dropColumn('aktif');
        });
    }
};