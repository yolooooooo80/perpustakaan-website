<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Akses Ngawi Perpustakaan</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(rgba(74, 20, 140, 0.8), rgba(74, 20, 140, 0.8)), url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Outfit', sans-serif;
        }
        .auth-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 450px;
            padding: 40px;
        }
        .logo-text {
            font-weight: 900;
            color: #4a148c;
            letter-spacing: -1px;
        }
    </style>
</head>
<body>
    <div class="auth-card fade-in">
        <div class="text-center mb-4">
            <a href="/" class="text-decoration-none">
                <h2 class="logo-text mb-0">NGAWI</h2>
                <p class="text-muted small fw-bold">SMA JOMOK 69 JAKARTA</p>
            </a>
        </div>

        {{ $slot }}
        
        <div class="text-center mt-4 pt-3 border-top">
            <p class="small text-muted mb-0">&copy; 2026 Ngawi Perpustakaan</p>
        </div>
    </div>
</body>
</html>
