<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\AntarJemput;

class AntarJemputController extends Controller
{
    public function index()
    {
        $antarJemput = AntarJemput::query()
            ->latest('id')
            ->first();

        return view(
            'website.layanan.antarjemput',
            compact('antarJemput')
        );
    }
}