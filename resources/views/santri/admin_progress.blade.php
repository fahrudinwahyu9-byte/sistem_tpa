@extends('layouts.app')

@section('title', 'Laporan Progress Bacaan')

@section('content')
<div style="margin-bottom: 2rem;">
    <h1 style="font-size: 2rem; margin-bottom: 0.25rem;">Laporan Progress Bacaan</h1>
    <p style="color: var(--text-muted);">Tinjauan statistik capaian jilid seluruh santri TPA.</p>
</div>

<!-- Summary Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
    <div class="glass-card" style="padding: 2rem; display: flex; align-items: center; gap: 1.5rem;">
        <div style="background: var(--accent); width: 60px; height: 60px; border-radius: 15px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: #fff;">
            <i class="fas fa-users"></i>
        </div>
        <div>
            <div style="font-size: 0.85rem; color: var(--text-muted); text-transform: uppercase;">Total Santri</div>
            <div style="font-size: 1.75rem; font-weight: 800; color: #fff;">{{ $totalSantri }}</div>
        </div>
    </div>

    @foreach($stats as $stat)
        <div class="glass-card" style="padding: 1.5rem; border-left: 4px solid var(--accent);">
            <div style="font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem;">Capaian {{ $stat->jilid_bacaan }}</div>
            <div style="display: flex; justify-content: space-between; align-items: baseline;">
                <span style="font-size: 1.5rem; font-weight: 700; color: #fff;">{{ $stat->total }} <span style="font-size: 0.9rem; font-weight: 400; color: var(--text-muted);">Santri</span></span>
                <span class="badge" style="background: rgba(16, 185, 129, 0.1); color: var(--accent);">{{ round(($stat->total / $totalSantri) * 100) }}%</span>
            </div>
        </div>
    @endforeach
</div>

<div style="display: grid; grid-template-columns: 1fr; gap: 2rem;">
    <div class="glass-card">
        <div style="padding: 1.5rem 2rem; border-bottom: 1px solid rgba(255, 255, 255, 0.1); display: flex; justify-content: space-between; align-items: center;">
            <h3 style="margin: 0; font-size: 1.2rem;"><i class="fas fa-history" style="color: var(--accent);"></i> Progress Terbaru</h3>
            <button class="btn" style="padding: 0.5rem 1rem; font-size: 0.8rem; background: rgba(255, 255, 255, 0.05); color: #fff;">
                <i class="fas fa-print"></i> Cetak Laporan
            </button>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Santri</th>
                        <th>Jilid Terakhir</th>
                        <th>Update Terakhir</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($santris as $index => $santri)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td style="font-weight: 600;">{{ $santri->nama_santri }}</td>
                            <td>
                                <span class="badge" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2);">
                                    {{ $santri->jilid_bacaan }}
                                </span>
                            </td>
                            <td style="color: var(--text-muted); font-size: 0.85rem;">
                                {{ $santri->updated_at->diffForHumans() }}
                            </td>
                            <td style="text-align: center;">
                                <a href="{{ route('santri.edit', $santri->id) }}" class="btn" style="padding: 0.3rem 0.6rem; font-size: 0.75rem; background: rgba(16, 185, 129, 0.1); color: var(--accent);">
                                    <i class="fas fa-edit"></i> Update
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" style="text-align: center;">Belum ada data progress.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
