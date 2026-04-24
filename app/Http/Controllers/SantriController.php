<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Santri;
use App\Models\User;


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
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'nama_santri' => 'required|string|max:255',
            'umur' => 'required|integer|min:1',
            'nama_wali' => 'required|string|max:255',
            'jilid_bacaan' => 'required|string|max:50',
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => $request->password,
            'role' => User::ROLE_SANTRI,
        ]);

        Santri::create([
            'user_id' => $user->id,
            'nama_santri' => $request->nama_santri,
            'umur' => $request->umur,
            'nama_wali' => $request->nama_wali,
            'jilid_bacaan' => $request->jilid_bacaan,
        ]);

        return redirect()->route('santri.progress')->with('success', 'Data santri berhasil ditambahkan. Username login: ' . $user->username);
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
        $request->validate([
            'password' => 'nullable|string|min:6',
            'nama_santri' => 'required|string|max:255',
            'umur' => 'required|integer|min:1',
            'nama_wali' => 'required|string|max:255',
            'jilid_bacaan' => 'required|string|max:50',
        ]);

        if ($request->filled('password')) {
            $santri->user->update(['password' => $request->password]);
        }

        $santri->update($request->only(['nama_santri', 'umur', 'nama_wali', 'jilid_bacaan']));
        
        return redirect()->route('santri.progress')->with('success', 'Data santri berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $santri = Santri::findOrFail($id);
        $santri->delete();
        return redirect()->route('santri.progress')->with('success', 'Data santri berhasil dihapus.');
    }
}
