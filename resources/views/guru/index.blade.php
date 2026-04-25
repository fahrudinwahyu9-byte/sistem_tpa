@extends('layouts.app')

@section('title', 'Data Guru')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 2rem; margin-bottom: 0.25rem;">Data Guru</h1>
        <p style="color: var(--text-muted);">Kelola daftar ustadz dan ustadzah pengajar TPA.</p>
    </div>
    @if(auth()->user()->role === \App\Models\User::ROLE_ADMIN)
        <a href="{{ route('guru.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Guru
        </a>
    @endif
</div>

<div class="glass-card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Guru</th>
                    <th>Jenis Kelamin</th>
                    <th>No. HP</th>
                    <th>Alamat</th>
                    @if(auth()->user()->role === \App\Models\User::ROLE_ADMIN)
                        <th style="text-align: center;">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($gurus as $index => $guru)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td style="font-weight: 600;">{{ $guru->nama_guru }}</td>
                        <td>
                            @if($guru->jenis_kelamin === 'L')
                                <span style="color: #60a5fa;"><i class="fas fa-mars"></i> Laki-laki</span>
                            @else
                                <span style="color: #f472b6;"><i class="fas fa-venus"></i> Perempuan</span>
                            @endif
                        </td>
                        <td>{{ $guru->no_hp }}</td>
                        <td>{{ $guru->alamat }}</td>
                        @if(auth()->user()->role === \App\Models\User::ROLE_ADMIN)
                            <td style="text-align: center; display: flex; gap: 0.5rem; justify-content: center;">
                                <a href="{{ route('guru.edit', $guru->id) }}" class="btn" style="background: rgba(255, 255, 255, 0.05); color: #fff; padding: 0.4rem 0.8rem; font-size: 0.8rem;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;" onclick="confirmDelete('{{ route('guru.destroy', $guru->id) }}', '{{ $guru->nama_guru }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 3rem; color: var(--text-muted);">
                            <i class="fas fa-folder-open" style="font-size: 2rem; display: block; margin-bottom: 1rem;"></i>
                            Belum ada data guru.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
