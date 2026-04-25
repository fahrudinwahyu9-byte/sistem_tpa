@extends('layouts.app')

@section('title', $guru->exists ? 'Edit Guru' : 'Tambah Guru')

@section('content')
<div style="max-width: 600px; margin: 0 auto;">
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('guru.index') }}" style="color: var(--accent); text-decoration: none; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Guru
        </a>
        <h1 style="font-size: 2rem;">{{ $guru->exists ? 'Update Data Guru' : 'Tambah Guru Baru' }}</h1>
    </div>

    <div class="glass-card animate-fade">
        <form action="{{ $guru->exists ? route('guru.update', $guru) : route('guru.store') }}" method="POST">
            @csrf
            @if($guru->exists)
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="nama_guru">Nama Lengkap Guru</label>
                <input type="text" name="nama_guru" id="nama_guru" value="{{ old('nama_guru', $guru->nama_guru) }}" placeholder="Contoh: Ustadz Ahmad" required>
                @error('nama_guru') <small style="color: #fca5a5;">{{ $message }}</small> @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" required>
                        <option value="" disabled {{ !$guru->jenis_kelamin ? 'selected' : '' }}>Pilih Jenis Kelamin</option>
                        <option value="L" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin') <small style="color: #fca5a5;">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label for="no_hp">Nomor HP</label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $guru->no_hp) }}" placeholder="08123456789" required>
                    @error('no_hp') <small style="color: #fca5a5;">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat Lengkap</label>
                <textarea name="alamat" id="alamat" rows="3" style="width: 100%; padding: 0.75rem 1rem; background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; color: white; outline: none; transition: all 0.3s ease;" required>{{ old('alamat', $guru->alamat) }}</textarea>
                @error('alamat') <small style="color: #fca5a5;">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1.5rem;">
                <i class="fas fa-save"></i> {{ $guru->exists ? 'Simpan Perubahan' : 'Tambah Guru' }}
            </button>
        </form>
    </div>
</div>

<style>
    textarea:focus {
        border-color: var(--accent);
        background: rgba(255, 255, 255, 0.07);
    }
</style>
@endsection
