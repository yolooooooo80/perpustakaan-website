<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ngawi Perpustakaan - SMA Jomok 69 Jakarta</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <style>
        :root {
            --p-purple: #4a148c;
            --s-gold: #ffd600;
            --bg-light: #f8f9fa;
        }
        
        body { font-family: 'Outfit', sans-serif; background-color: var(--bg-light); color: #333; }

        .navbar-custom { background: white !important; border-bottom: 4px solid var(--p-purple); box-shadow: 0 4px 15px rgba(0,0,0,0.05); }

        .internal-banner {
            background: linear-gradient(rgba(74, 20, 140, 0.7), rgba(74, 20, 140, 0.8)), url('{{ asset('images/hero1.png') }}');
            background-size: cover;
            background-position: center;
            padding: 80px 0;
            color: white;
            margin-bottom: 40px;
            border-bottom: 5px solid var(--s-gold);
            text-shadow: 2px 2px 10px rgba(0,0,0,0.3);
        }

        .glass-card { background: white; border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: 0.4s; }
        .btn-p { background: var(--p-purple); color: white; border-radius: 50px; font-weight: 700; border: none; padding: 10px 25px; transition: 0.3s; }
        .btn-s { background: var(--s-gold); color: var(--p-purple); border-radius: 50px; font-weight: 900; border: none; padding: 10px 25px; }
        
        /* New Premium Footer */
        .footer-ngawi { background: #0f0f0f; color: #fff; padding: 80px 0 20px; position: relative; overflow: hidden; }
        .footer-ngawi::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 5px; background: linear-gradient(to right, var(--p-purple), var(--s-gold)); }
        .footer-link { color: rgba(255,255,255,0.6); text-decoration: none; transition: 0.3s; display: block; margin-bottom: 10px; }
        .footer-link:hover { color: var(--s-gold); transform: translateX(5px); }
        .contact-info { color: rgba(255,255,255,0.6); font-size: 0.9rem; margin-bottom: 15px; }
        .contact-info i { color: var(--s-gold); margin-right: 15px; font-size: 1.1rem; }
        
        .fade-in { animation: fadeIn 0.8s ease-in; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>
    @include('layouts.navigation')

    @if(!request()->is('/'))
    <div class="internal-banner">
        <div class="container text-center">
            <h1 class="fw-black text-uppercase tracking-wider mb-0 display-4">@yield('page_title', 'Ngawi Perpustakaan')</h1>
            <div class="mx-auto bg-warning mt-3" style="width: 80px; height: 6px; border-radius: 5px;"></div>
        </div>
    </div>
    @endif

    <main class="container py-4">
        @yield('content')
    </main>

    <!-- Detailed Footer -->
    <footer class="footer-ngawi mt-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <h3 class="fw-black mb-4">NGAWI <span style="color: var(--s-gold);">PERPUS</span></h3>
                    <p class="small opacity-50 mb-4 lh-lg">Membangun ekosistem literasi digital yang modern dan inklusif bagi seluruh civitas akademika SMA Jomok 69 Jakarta. Akses ilmu pengetahuan kini dalam genggaman Anda.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>
                <div class="col-lg-2">
                    <h5 class="fw-bold mb-4">Navigasi</h5>
                    <a href="/" class="footer-link small text-uppercase fw-bold">Beranda</a>
                    <a href="{{ route('books.browse') }}" class="footer-link small text-uppercase fw-bold">Katalog Buku</a>
                    <a href="{{ route('dashboard') }}" class="footer-link small text-uppercase fw-bold">Dashboard</a>
                    <a href="{{ route('chat.index') }}" class="footer-link small text-uppercase fw-bold">Pusat Bantuan</a>
                </div>
                <div class="col-lg-3">
                    <h5 class="fw-bold mb-4">Informasi Kontak</h5>
                    <div class="contact-info">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Jl. Jomok Raya No. 69, Blok J, Jakarta Selatan, 12345</span>
                    </div>
                    <div class="contact-info">
                        <i class="bi bi-telephone-fill"></i>
                        <span>+62 (21) 555-NGAWI</span>
                    </div>
                    <div class="contact-info">
                        <i class="bi bi-envelope-fill"></i>
                        <span>admin@ngawiperpus.sch.id</span>
                    </div>
                </div>
                <div class="col-lg-3 text-center text-lg-start">
                    <h5 class="fw-bold mb-4">Jam Layanan</h5>
                    <p class="small opacity-50 mb-1">Senin - Jumat: 07:00 - 16:00</p>
                    <p class="small opacity-50 mb-3">Sabtu: 08:00 - 12:00</p>
                    <div class="bg-primary p-3 rounded-4" style="background: rgba(74, 20, 140, 0.2) !important; border: 1px solid rgba(74, 20, 140, 0.3);">
                        <p class="x-small mb-0 text-warning fw-bold">Perpustakaan Digital: Aktif 24/7</p>
                    </div>
                </div>
            </div>
            <hr class="my-5 opacity-10">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="small opacity-25 mb-0">&copy; 2026 SMA Jomok 69 Jakarta. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="small opacity-25 mb-0">Designed for Educational Excellence</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
