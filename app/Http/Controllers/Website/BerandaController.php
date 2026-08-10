<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Beranda;

class BerandaController extends Controller
{
    public function index()
    {
        $beranda = Beranda::first();

        return view('website.beranda', compact('beranda'));
    }
}