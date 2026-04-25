<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - TPA Management System</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="app-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <i class="fas fa-mosque"></i> Sistem TPA
            </div>

            <div class="sidebar-nav">
                <div class="nav-group">
                    <span class="nav-label">Main Menu</span>
                    <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-th-large"></i> Dashboard
                    </a>
                </div>

                <div class="nav-group">
                    <span class="nav-label">Data & Laporan</span>
                    <a href="{{ route('santri.progress') }}" class="nav-item {{ request()->routeIs('santri.progress') ? 'active' : '' }}">
                        <i class="fas fa-book"></i> Progress Bacaan
                    </a>
                    @if(auth()->user()->role === \App\Models\User::ROLE_ADMIN)
                        <a href="{{ route('guru.index') }}" class="nav-item {{ request()->routeIs('guru.*') ? 'active' : '' }}">
                            <i class="fas fa-chalkboard-teacher"></i> Data Guru
                        </a>
                    @endif
                </div>
            </div>

            <div class="sidebar-footer">
                <div class="user-profile">
                    <div style="background: var(--accent); width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff;">
                        <i class="fas fa-user"></i>
                    </div>
                    <div style="flex: 1; min-width: 0;">
                        <div style="font-weight: 600; font-size: 0.9rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ Auth::user()->username }}</div>
                        <div style="font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase;">{{ Auth::user()->role }}</div>
                    </div>
                </div>
                <button type="button" class="btn btn-danger" style="width: 100%; border-radius: 10px;" onclick="confirmLogout()">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </button>
            </div>
        </aside>

        <!-- Main Wrapper -->
        <div class="main-wrapper">
            <main class="main-content animate-fade">
                @if(session('success'))
                    <div style="background: rgba(16, 185, 129, 0.1); color: #6ee7b7; padding: 1rem; border-radius: 12px; margin-bottom: 2rem; border: 1px solid rgba(16, 185, 129, 0.2);">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div style="background: rgba(239, 68, 68, 0.1); color: #fca5a5; padding: 1rem; border-radius: 12px; margin-bottom: 2rem; border: 1px solid rgba(239, 68, 68, 0.2);">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>

            <footer style="text-align: center; padding: 2rem; color: var(--text-muted); font-size: 0.85rem;">
                &copy; 2026 TPA Management System &bull; By Wahyoe
            </footer>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmModal" class="modal-overlay">
        <div class="modal-card glass-card">
            <div class="modal-icon">
                <i id="confirmIcon" class="fas fa-exclamation-circle"></i>
            </div>
            <div id="confirmTitle" class="modal-title">Konfirmasi</div>
            <div id="confirmText" class="modal-text"></div>
            <div class="modal-actions">
                <button type="button" class="btn" style="background: rgba(255, 255, 255, 0.05); color: #fff;" onclick="closeConfirmModal()">Batal</button>
                <form id="globalConfirmForm" method="POST" style="display: inline;">
                    @csrf
                    <div id="methodContainer"></div>
                    <button type="submit" id="confirmBtn" class="btn btn-danger">Ya, Lanjutkan</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showConfirm(options) {
            const modal = document.getElementById('confirmModal');
            const form = document.getElementById('globalConfirmForm');
            const title = document.getElementById('confirmTitle');
            const text = document.getElementById('confirmText');
            const icon = document.getElementById('confirmIcon');
            const btn = document.getElementById('confirmBtn');
            const methodContainer = document.getElementById('methodContainer');
            
            form.action = options.url;
            title.innerText = options.title || 'Konfirmasi';
            text.innerHTML = options.text || '';
            icon.className = options.icon || 'fas fa-exclamation-circle';
            btn.innerText = options.btnText || 'Ya, Lanjutkan';
            btn.className = 'btn ' + (options.btnClass || 'btn-danger');
            
            // Set method (PUT/DELETE/POST)
            methodContainer.innerHTML = '';
            if (options.method && options.method !== 'POST') {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = '_method';
                input.value = options.method;
                methodContainer.appendChild(input);
            }

            modal.classList.add('active');
        }

        function closeConfirmModal() {
            document.getElementById('confirmModal').classList.remove('active');
        }

        // Specific wrappers for easier use
        function confirmDelete(url, santriName) {
            showConfirm({
                url: url,
                method: 'DELETE',
                title: 'Hapus Data?',
                text: `Apakah Anda yakin ingin menghapus data <span style="color: #fff; font-weight: 600;">${santriName}</span>? Tindakan ini tidak dapat dibatalkan.`,
                icon: 'fas fa-trash-alt',
                btnText: 'Ya, Hapus',
                btnClass: 'btn-danger'
            });
        }

        function confirmLogout() {
            showConfirm({
                url: "{{ route('logout') }}",
                method: 'POST',
                title: 'Keluar Aplikasi?',
                text: 'Apakah Anda yakin ingin mengakhiri sesi ini?',
                icon: 'fas fa-sign-out-alt',
                btnText: 'Ya, Keluar',
                btnClass: 'btn-danger'
            });
        }

        // Close on escape
        window.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeConfirmModal();
            }
        });
    </script>
</body>
</html>
