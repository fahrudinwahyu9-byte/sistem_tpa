@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 2rem; margin-bottom: 0.25rem;">Data Santri</h1>
        <p style="color: var(--text-muted);">Kelola seluruh informasi santri TPA dalam satu tempat.</p>
    </div>
    @if(auth()->user()->role === \App\Models\User::ROLE_ADMIN)
        <a href="{{ route('santri.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Santri
        </a>
    @endif
</div>

<div class="glass-card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Santri</th>
                    <th>Umur</th>
                    <th>Nama Wali</th>
                    <th>Jilid Bacaan</th>
                    @if(auth()->user()->role === \App\Models\User::ROLE_ADMIN)
                        <th style="text-align: center;">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($santris as $index => $santri)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td style="font-weight: 600;">{{ $santri->nama_santri }}</td>
                        <td>{{ $santri->umur }} Tahun</td>
                        <td>{{ $santri->nama_wali }}</td>
                        <td>
                            <span class="badge">
                                <i class="fas fa-book-open"></i> {{ $santri->jilid_bacaan }}
                            </span>
                        </td>
                        @if(auth()->user()->role === \App\Models\User::ROLE_ADMIN)
                            <td style="text-align: center; display: flex; gap: 0.5rem; justify-content: center;">
                                <a href="{{ route('santri.edit', $santri->id) }}" class="btn" style="background: rgba(255, 255, 255, 0.05); color: #fff; padding: 0.4rem 0.8rem; font-size: 0.8rem;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;" onclick="confirmDelete('{{ route('santri.destroy', $santri->id) }}', '{{ $santri->nama_santri }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 3rem; color: var(--text-muted);">
                            <i class="fas fa-folder-open" style="font-size: 2rem; display: block; margin-bottom: 1rem;"></i>
                            Belum ada data santri.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
