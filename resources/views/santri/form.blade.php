@extends('layouts.app')

@section('title', $santri->exists ? 'Edit Santri' : 'Tambah Santri')

@section('content')
<div style="max-width: 600px; margin: 0 auto;">
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('dashboard') }}" style="color: var(--accent); text-decoration: none; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
        <h1 style="font-size: 2rem;">{{ $santri->exists ? 'Update Data Santri' : 'Registrasi Santri Baru' }}</h1>
    </div>

    <div class="glass-card animate-fade">
        <form action="{{ $santri->exists ? route('santri.update', $santri) : route('santri.store') }}" method="POST">
            @csrf
            @if($santri->exists)
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="nama_santri">Nama Lengkap Santri</label>
                <input type="text" name="nama_santri" id="nama_santri" value="{{ old('nama_santri', $santri->nama_santri) }}" placeholder="Contoh: Ahmad Abdullah" required>
                @error('nama_santri') <small style="color: #fca5a5;">{{ $message }}</small> @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="umur">Umur (Tahun)</label>
                    <input type="number" name="umur" id="umur" value="{{ old('umur', $santri->umur) }}" placeholder="7" required>
                    @error('umur') <small style="color: #fca5a5;">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label for="jilid_bacaan">Jilid Bacaan</label>
                    <select name="jilid_bacaan" id="jilid_bacaan" required>
                        <option value="" disabled {{ !$santri->jilid_bacaan ? 'selected' : '' }}>Pilih Jilid</option>
                        @foreach(['Iqro 1', 'Iqro 2', 'Iqro 3', 'Iqro 4', 'Iqro 5', 'Iqro 6', 'Al-Qur\'an'] as $jilid)
                            <option value="{{ $jilid }}" {{ old('jilid_bacaan', $santri->jilid_bacaan) == $jilid ? 'selected' : '' }}>
                                {{ $jilid }}
                            </option>
                        @endforeach
                    </select>
                    @error('jilid_bacaan') <small style="color: #fca5a5;">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="nama_wali">Nama Orang Tua / Wali</label>
                <input type="text" name="nama_wali" id="nama_wali" value="{{ old('nama_wali', $santri->nama_wali) }}" placeholder="Masukkan nama wali santri" required>
                @error('nama_wali') <small style="color: #fca5a5;">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1.5rem;">
                <i class="fas fa-save"></i> {{ $santri->exists ? 'Simpan Perubahan' : 'Daftarkan Santri' }}
            </button>
        </form>
    </div>
</div>
@endsection
