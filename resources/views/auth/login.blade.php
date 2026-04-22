<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TPA Management System</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card glass-card animate-fade">
            <div class="auth-header">
                <h1>Sistem TPA</h1>
                <p>Silakan login untuk mengelola data santri</p>
            </div>

            @if (session('success'))
                <div style="background: rgba(16, 185, 129, 0.1); color: #6ee7b7; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; font-size: 0.9rem; border: 1px solid rgba(16, 185, 129, 0.2);">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div style="background: rgba(239, 68, 68, 0.1); color: #fca5a5; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; font-size: 0.9rem;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Masukkan username" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">
                    Masuk ke Sistem
                </button>
            </form>

            <div style="margin-top: 2rem; font-size: 0.8rem; color: var(--text-muted);">
                &copy; 2026 Management System TPA. All rights reserved.
            </div>
        </div>
    </div>
</body>
</html>
