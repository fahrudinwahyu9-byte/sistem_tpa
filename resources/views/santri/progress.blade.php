@extends('layouts.app')

@section('title', 'Progress Bacaan')

@section('content')
<div style="margin-bottom: 2rem;">
    <h1 style="font-size: 2rem; margin-bottom: 0.25rem;">Kartu Progress Santri</h1>
    <p style="color: var(--text-muted);">Pantau perkembangan hafalan dan bacaan Al-Qur'an Anda.</p>
</div>

<div class="glass-card" style="padding: 0; overflow: hidden; max-width: 800px;">
    <!-- Profile Header -->
    <div style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(16, 185, 129, 0.05)); padding: 3rem; border-bottom: 1px solid rgba(255, 255, 255, 0.1); display: flex; align-items: center; gap: 2rem;">
        <div style="width: 100px; height: 100px; background: var(--accent); border-radius: 25px; display: flex; align-items: center; justify-content: center; font-size: 3rem; color: #fff; box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);">
            <i class="fas fa-user-graduate"></i>
        </div>
        <div>
            <h2 style="font-size: 1.75rem; margin-bottom: 0.5rem; color: #fff;">{{ $santri->nama_santri }}</h2>
            <div style="display: flex; gap: 1rem;">
                <span class="badge" style="background: rgba(255, 255, 255, 0.1);"><i class="fas fa-id-badge"></i> {{ auth()->user()->username }}</span>
                <span class="badge" style="background: rgba(255, 255, 255, 0.1);"><i class="fas fa-calendar-alt"></i> {{ $santri->umur }} Tahun</span>
            </div>
        </div>
    </div>

    <!-- Progress Body -->
    <div style="padding: 3rem;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
            <div style="background: rgba(255, 255, 255, 0.03); padding: 2rem; border-radius: 20px; border: 1px solid rgba(255, 255, 255, 0.05);">
                <div style="color: var(--text-muted); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 1rem;">Capaian Saat Ini</div>
                <div style="display: flex; align-items: baseline; gap: 0.5rem;">
                    <span style="font-size: 2.5rem; font-weight: 800; color: var(--accent);">{{ $santri->jilid_bacaan }}</span>
                </div>
            </div>
            
            <div style="background: rgba(255, 255, 255, 0.03); padding: 2rem; border-radius: 20px; border: 1px solid rgba(255, 255, 255, 0.05);">
                <div style="color: var(--text-muted); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 1rem;">Wali Santri</div>
                <div style="font-size: 1.25rem; font-weight: 600; color: #fff;">{{ $santri->nama_wali }}</div>
            </div>
        </div>

        <div style="margin-top: 3rem;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; align-items: center;">
                <span style="font-weight: 600; color: #fff;">Visualisasi Progress</span>
                <span style="font-size: 0.85rem; color: var(--accent);">Tetap Semangat!</span>
            </div>
            <div style="width: 100%; height: 12px; background: rgba(255, 255, 255, 0.05); border-radius: 6px; overflow: hidden;">
                <div style="width: 75%; height: 100%; background: linear-gradient(90deg, var(--accent), #34d399); border-radius: 6px; box-shadow: 0 0 15px rgba(16, 185, 129, 0.4);"></div>
            </div>
            <p style="margin-top: 1rem; font-size: 0.9rem; color: var(--text-muted); text-align: center; font-style: italic;">
                "Sebaik-baik kalian adalah orang yang belajar Al-Qur'an dan mengajarkannya." (HR. Bukhari)
            </p>
        </div>
    </div>
</div>
@endsection
