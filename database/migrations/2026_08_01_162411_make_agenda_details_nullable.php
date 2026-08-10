<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('agendas', function (Blueprint $table) {
            $table->date('tanggal')->nullable()->change();
            $table->time('jam_mulai')->nullable()->change();
            $table->time('jam_selesai')->nullable()->change();
            $table->string('lokasi')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('agendas', function (Blueprint $table) {
            $table->date('tanggal')->nullable(false)->change();
            $table->time('jam_mulai')->nullable(false)->change();
            $table->time('jam_selesai')->nullable()->change();
            $table->string('lokasi')->nullable(false)->change();
        });
    }
};