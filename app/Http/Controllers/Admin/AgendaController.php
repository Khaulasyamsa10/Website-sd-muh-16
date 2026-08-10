<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{
    public function index()
{
    $agenda = Agenda::orderByRaw('tanggal IS NULL')
        ->orderBy('tanggal', 'asc')
        ->orderBy('jam_mulai', 'asc')
        ->get();

    return view('admin.agenda.index', compact('agenda'));
}

    public function create()
    {
        return view('admin.agenda.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateAgenda($request);

        $data['aktif'] = $request->boolean('aktif');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')
                ->store('agenda', 'public');
        }

        Agenda::create($data);

        return redirect()
            ->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function edit(Agenda $agenda)
    {
        return view('admin.agenda.edit', compact('agenda'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        $data = $this->validateAgenda($request);

        $data['aktif'] = $request->boolean('aktif');

        if ($request->hasFile('gambar')) {

            if ($agenda->gambar) {
                Storage::disk('public')->delete($agenda->gambar);
            }

            $data['gambar'] = $request->file('gambar')
                ->store('agenda', 'public');
        }

        $agenda->update($data);

        return redirect()
            ->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy(Agenda $agenda)
    {
        if ($agenda->gambar) {
            Storage::disk('public')->delete($agenda->gambar);
        }

        $agenda->delete();

        return redirect()
            ->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil dihapus.');
    }

    private function validateAgenda(Request $request): array
    {
        return $request->validate([
            'judul' => [
                'required',
                'string',
                'max:255',
            ],
    
            'tanggal' => [
                'nullable',
                'date',
            ],
    
            'jam_mulai' => [
                'nullable',
                'date_format:H:i',
            ],
    
            'jam_selesai' => [
                'nullable',
                'date_format:H:i',
                'required_with:jam_mulai',
                'after:jam_mulai',
            ],
    
            'lokasi' => [
                'nullable',
                'string',
                'max:255',
            ],
    
            'deskripsi' => [
                'nullable',
                'string',
            ],
    
            'gambar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);
    }
}