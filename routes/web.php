<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;


/*
|--------------------------------------------------------------------------
| CONTROLLER WEBSITE
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Website\PpdbController;
use App\Http\Controllers\Website\AgendaPageController;
use App\Http\Controllers\Website\EkstrakurikulerPageController;
use App\Http\Controllers\Website\PrestasiPageController;
use App\Http\Controllers\Website\AntarJemputController;
use App\Http\Controllers\Website\BeritaController;
use App\Http\Controllers\Website\GaleriController;
use App\Http\Controllers\Website\AlumniController;
use App\Http\Controllers\Website\BerandaController as WebsiteBerandaController;


/*
|--------------------------------------------------------------------------
| CONTROLLER ADMIN
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\AgendaController as AdminAgendaController;
use App\Http\Controllers\Admin\PrestasiController as AdminPrestasiController;
use App\Http\Controllers\Admin\PpdbController as AdminPpdbController;
use App\Http\Controllers\Admin\AntarJemputController as AdminAntarJemputController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\EkstrakurikulerController as AdminEkstrakurikulerController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\AlumniController as AdminAlumniController;
use App\Http\Controllers\Admin\BerandaController as AdminBerandaController;


/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA / BERANDA
|--------------------------------------------------------------------------
*/

Route::get(
    '/',
    [WebsiteBerandaController::class, 'index']
)->name('beranda');


/*
|--------------------------------------------------------------------------
| BERITA WEBSITE
|--------------------------------------------------------------------------
*/

Route::get(
    '/berita',
    [BeritaController::class, 'index']
)->name('berita');

Route::get(
    '/berita/{berita:slug}',
    [BeritaController::class, 'show']
)->name('berita.show');


/*
|--------------------------------------------------------------------------
| AGENDA WEBSITE
|--------------------------------------------------------------------------
*/

Route::get(
    '/agenda',
    [AgendaPageController::class, 'index']
)->name('agenda');


/*
|--------------------------------------------------------------------------
| EKSTRAKURIKULER WEBSITE
|--------------------------------------------------------------------------
*/

Route::get(
    '/ekstrakurikuler',
    [EkstrakurikulerPageController::class, 'index']
)->name('ekstrakurikuler');


/*
|--------------------------------------------------------------------------
| PRESTASI WEBSITE
|--------------------------------------------------------------------------
*/

Route::get(
    '/prestasi/akademik',
    [PrestasiPageController::class, 'akademik']
)->name('prestasi.akademik');

Route::get(
    '/prestasi/olahraga',
    [PrestasiPageController::class, 'olahraga']
)->name('prestasi.olahraga');

Route::get(
    '/prestasi/keislaman',
    [PrestasiPageController::class, 'keislaman']
)->name('prestasi.keislaman');

Route::get(
    '/prestasi/seni',
    [PrestasiPageController::class, 'seni']
)->name('prestasi.seni');


/*
|--------------------------------------------------------------------------
| GALERI WEBSITE
|--------------------------------------------------------------------------
*/

Route::get(
    '/galeri/foto',
    [GaleriController::class, 'foto']
)->name('galeri.foto');

Route::get(
    '/galeri/video',
    [GaleriController::class, 'video']
)->name('galeri.video');


/*
|--------------------------------------------------------------------------
| PPDB WEBSITE
|--------------------------------------------------------------------------
*/

Route::get(
    '/layanan/ppdb',
    [PpdbController::class, 'index']
)->name('layanan.ppdb');


/*
|--------------------------------------------------------------------------
| ANTAR JEMPUT WEBSITE
|--------------------------------------------------------------------------
*/

Route::get(
    '/layanan/antar-jemput',
    [AntarJemputController::class, 'index']
)->name('layanan.antarjemput');


/*
|--------------------------------------------------------------------------
| ALUMNI WEBSITE
|--------------------------------------------------------------------------
*/

Route::get(
    '/alumni',
    [AlumniController::class, 'index']
)->name('alumni');

Route::post(
    '/alumni',
    [AlumniController::class, 'store']
)->name('alumni.store');


/*
|--------------------------------------------------------------------------
| HALAMAN YANG MEMERLUKAN LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');


    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {


            /*
            |--------------------------------------------------------------------------
            | BERANDA ADMIN
            |--------------------------------------------------------------------------
            */

            Route::get(
                'beranda',
                [AdminBerandaController::class, 'edit']
            )->name('beranda.edit');

            Route::put(
                'beranda',
                [AdminBerandaController::class, 'update']
            )->name('beranda.update');


            /*
            |--------------------------------------------------------------------------
            | AGENDA ADMIN
            |--------------------------------------------------------------------------
            */

            Route::resource(
                'agenda',
                AdminAgendaController::class
            )->except(['show']);


            /*
            |--------------------------------------------------------------------------
            | BERITA ADMIN
            |--------------------------------------------------------------------------
            */

            Route::resource(
                'berita',
                AdminBeritaController::class
            )->except(['show']);


            /*
            |--------------------------------------------------------------------------
            | PRESTASI ADMIN
            |--------------------------------------------------------------------------
            */

            Route::resource(
                'prestasi',
                AdminPrestasiController::class
            )->except(['show']);


            /*
            |--------------------------------------------------------------------------
            | GALERI ADMIN
            |--------------------------------------------------------------------------
            */

            Route::resource(
                'galeri',
                AdminGaleriController::class
            )->except(['show']);


            /*
            |--------------------------------------------------------------------------
            | EKSTRAKURIKULER ADMIN
            |--------------------------------------------------------------------------
            */

            Route::resource(
                'ekstrakurikuler',
                AdminEkstrakurikulerController::class
            )->except(['show']);


            /*
            |--------------------------------------------------------------------------
            | PPDB ADMIN
            |--------------------------------------------------------------------------
            */

            Route::resource(
                'ppdb',
                AdminPpdbController::class
            )->except(['show']);


            /*
            |--------------------------------------------------------------------------
            | ANTAR JEMPUT ADMIN
            |--------------------------------------------------------------------------
            */

            Route::get(
                'antar-jemput',
                [AdminAntarJemputController::class, 'index']
            )->name('antar-jemput.index');

            Route::put(
                'antar-jemput',
                [AdminAntarJemputController::class, 'update']
            )->name('antar-jemput.update');


            /*
            |--------------------------------------------------------------------------
            | ALUMNI ADMIN
            |--------------------------------------------------------------------------
            */

            Route::get(
                'alumni',
                [AdminAlumniController::class, 'index']
            )->name('alumni.index');

            Route::get(
                'alumni/{alumni}',
                [AdminAlumniController::class, 'show']
            )->name('alumni.show');

            Route::delete(
                'alumni/{alumni}',
                [AdminAlumniController::class, 'destroy']
            )->name('alumni.destroy');

        });

});


/*
|--------------------------------------------------------------------------
| ROUTE AUTENTIKASI
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';