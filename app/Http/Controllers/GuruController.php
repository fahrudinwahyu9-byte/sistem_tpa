<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Guru;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::latest()->get();
        return view('guru.index', compact('gurus'));
    }

    public function create()
    {
        $guru = new Guru();
        return view('guru.form', compact('guru'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_guru' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        Guru::create($request->all());

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $guru = Guru::findOrFail($id);
        return view('guru.form', compact('guru'));
    }

    public function update(Request $request, string $id)
    {
        $guru = Guru::findOrFail($id);
        $request->validate([
            'nama_guru' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        $guru->update($request->all());

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
