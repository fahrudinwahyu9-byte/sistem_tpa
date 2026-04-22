<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Santri;

class SantriController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === \App\Models\User::ROLE_ADMIN) {
            $santris = Santri::latest()->get();
        } else {
            $santris = Santri::where('user_id', auth()->id())->get();
        }
        return view('santri.index', compact('santris'));
    }

    public function progress()
    {
        if (auth()->user()->role === \App\Models\User::ROLE_ADMIN) {
            $totalSantri = Santri::count();
            
            // Group by Jilid for statistics
            $stats = Santri::select('jilid_bacaan', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
                ->groupBy('jilid_bacaan')
                ->orderBy('jilid_bacaan')
                ->get();

            $santris = Santri::latest()->take(10)->get(); // Recent progress
            
            return view('santri.admin_progress', compact('totalSantri', 'stats', 'santris'));
        }

        $santri = Santri::where('user_id', auth()->id())->first();
        
        if (!$santri) {
            return redirect()->route('dashboard')->with('error', 'Data kartu progress tidak ditemukan.');
        }

        return view('santri.progress', compact('santri'));
    }

    public function create()
    {
        $santri = new Santri();
        return view('santri.form', compact('santri'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_santri' => 'required|string|max:255',
            'umur' => 'required|integer|min:1',
            'nama_wali' => 'required|string|max:255',
            'jilid_bacaan' => 'required|string|max:50',
        ]);

        // Create User account for the santri
        $username = strtolower(str_replace(' ', '', $data['nama_santri']));
        
        // Ensure unique username
        if (\App\Models\User::where('username', $username)->exists()) {
            $username = $username . rand(10, 99);
        }

        $user = \App\Models\User::create([
            'username' => $username,
            'password' => 'santri123', // Default password
            'role' => \App\Models\User::ROLE_SANTRI,
        ]);

        $data['user_id'] = $user->id;

        Santri::create($data);
        return redirect()->route('dashboard')->with('success', 'Data santri berhasil ditambahkan. Username login: ' . $username);
    }

    public function show()
    {
        return redirect()->route('dashboard');
    }

    public function edit(string $id)
    {
        $santri = Santri::findOrFail($id);
        return view('santri.form', compact('santri'));
    }

    public function update(Request $request, string $id)
    {
        $santri = Santri::findOrFail($id);
        $data = $request->validate([
            'nama_santri' => 'required|string|max:255',
            'umur' => 'required|integer|min:1',
            'nama_wali' => 'required|string|max:255',
            'jilid_bacaan' => 'required|string|max:50',
        ]);

        $santri->update($data);
        return redirect()->route('dashboard')->with('success', 'Data santri berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $santri = Santri::findOrFail($id);
        $santri->delete();
        return redirect()->route('dashboard')->with('success', 'Data santri berhasil dihapus.');
    }
}
