<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Agenda;

class AgendaPageController extends Controller
{
    public function index()
    {
        $agenda = Agenda::where('aktif', true)
            ->orderByRaw('tanggal IS NULL')
            ->orderBy('tanggal', 'asc')
            ->orderBy('jam_mulai', 'asc')
            ->get();

        return view('website.agenda', compact('agenda'));
    }
}