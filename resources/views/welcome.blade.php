<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        }
        
        body { font-family: 'Outfit', sans-serif; background: #fff; overflow-x: hidden; }

        .navbar-custom-solid {
            background-color: var(--p-purple) !important;
            padding: 15px 0;
            border-bottom: 4px solid var(--s-gold);
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .hero-carousel .carousel-item {
            height: 80vh;
            min-height: 600px;
            background-color: #000;
        }

        .carousel-item img { object-fit: cover; width: 100%; height: 100%; opacity: 0.6; }
        .carousel-caption { text-align: left; bottom: 25%; left: 10%; right: 10%; }
        .hero-title { font-size: 5rem; font-weight: 900; color: #fff; line-height: 1; margin-bottom: 20px; }
        .hero-subtitle { font-size: 1.4rem; color: rgba(255,255,255,0.8); margin-bottom: 40px; max-width: 700px; }

        .btn-premium-p { background: var(--p-purple); color: white; padding: 15px 40px; border-radius: 50px; font-weight: 700; border: none; transition: 0.4s; }
        .btn-premium-p:hover { background: #310d5e; transform: translateY(-5px); box-shadow: 0 15px 30px rgba(74, 20, 140, 0.3); color: white; }

        .feature-card { padding: 40px; border-radius: 30px; background: #fff; border: 1px solid #eee; transition: 0.4s; height: 100%; }
        .feature-card:hover { transform: translateY(-15px); border-color: var(--p-purple); box-shadow: 0 20px 40px rgba(0,0,0,0.05); }

        .section-title { font-weight: 900; color: var(--p-purple); position: relative; margin-bottom: 50px; display: inline-block; }
        .section-title::after { content: ''; position: absolute; bottom: -10px; left: 0; width: 60px; height: 5px; background: var(--s-gold); border-radius: 5px; }

        /* Cinematic Book Card Style */
        .book-cinematic-card {
            position: relative;
            height: 450px;
            border-radius: 25px;
            overflow: hidden;
            display: block;
            text-decoration: none;
            transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }

        .book-cinematic-card:hover {
            transform: scale(1.03) translateY(-10px);
            box-shadow: 0 25px 50px rgba(74, 20, 140, 0.2);
        }

        .book-card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.8s;
        }

        .book-cinematic-card:hover .book-card-image {
            transform: scale(1.15);
        }

        .book-card-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 30px 20px;
            background: linear-gradient(transparent, rgba(0,0,0,0.95));
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        .book-card-category {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(74, 20, 140, 0.8);
            backdrop-filter: blur(5px);
            padding: 6px 15px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            color: white;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .book-card-title { font-weight: 800; font-size: 1.2rem; margin-bottom: 5px; line-height: 1.2; }
        .book-card-author { font-size: 0.85rem; opacity: 0.8; margin-bottom: 15px; }
        
        .book-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 15px;
        }

        .footer-ngawi { background: #0f0f0f; color: #fff; padding: 80px 0 20px; position: relative; overflow: hidden; }
        .footer-ngawi::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 5px; background: linear-gradient(to right, var(--p-purple), var(--s-gold)); }
        .footer-link { color: rgba(255,255,255,0.6); text-decoration: none; transition: 0.3s; display: block; margin-bottom: 10px; }
        .contact-info { color: rgba(255,255,255,0.6); font-size: 0.9rem; margin-bottom: 15px; }
        .contact-info i { color: var(--s-gold); margin-right: 15px; font-size: 1.1rem; }
    </style>
</head>
<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-custom-solid sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <div class="bg-white p-2 rounded-3 me-2">
                    <i class="bi bi-book-half fs-4" style="color: var(--p-purple);"></i>
                </div>
                <span style="letter-spacing: -1px; color: #fff; font-weight: 900;">NGAWI <span style="color: var(--s-gold);">PERPUS</span></span>
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-4">
                    <li class="nav-item"><a class="nav-link text-white opacity-75 fw-bold" href="/">BERANDA</a></li>
                    <li class="nav-item"><a class="nav-link text-white opacity-75 fw-bold" href="{{ route('books.browse') }}">KATALOG</a></li>
                    <li class="nav-item">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-warning rounded-pill px-4 fw-black">DASHBOARD</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-light rounded-pill px-4 me-2 fw-bold">MASUK</a>
                            <a href="{{ route('register') }}" class="btn btn-warning rounded-pill px-4 fw-black">DAFTAR</a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Slider -->
    <div id="heroSlider" class="carousel slide hero-carousel" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/hero1.png') }}" alt="Library 1">
                <div class="carousel-caption text-start">
                    <span class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill fw-bold">SMA JOMOK 69 JAKARTA</span>
                    <h1 class="hero-title">Gerbang Ilmu <br><span style="color: var(--s-gold);">Masa Depan</span></h1>
                    <p class="hero-subtitle">Eksplorasi ribuan koleksi buku digital dan fisik dengan kemudahan akses satu pintu.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/hero2.png') }}" alt="Library 2">
                <div class="carousel-caption text-start">
                    <span class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill fw-bold">PROMAX READING EXPERIENCE</span>
                    <h1 class="hero-title">Inspirasi <br><span style="color: var(--s-gold);">Tiada Henti</span></h1>
                    <p class="hero-subtitle">Ruang baca modern yang dirancang untuk kenyamanan dan produktivitas belajar Anda.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/hero3.png') }}" alt="Library 3">
                <div class="carousel-caption text-start">
                    <span class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill fw-bold">SMART LIBRARY SYSTEM</span>
                    <h1 class="hero-title">Layanan <br><span style="color: var(--s-gold);">Serba Instan</span></h1>
                    <p class="hero-subtitle">Pinjam buku, cek denda, dan konsultasi pustakawan kini bisa dilakukan kapan saja.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroSlider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroSlider" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- Layanan Unggulan -->
    <section class="py-5 bg-light">
        <div class="container py-5 text-center">
            <h2 class="section-title">Layanan Unggulan</h2>
            <div class="row g-4 mt-2">
                <div class="col-md-4"><div class="feature-card"><i class="bi bi-lightning-charge fs-1 mb-3 d-block" style="color: var(--p-purple);"></i><h4 class="fw-bold">Akses Cepat</h4><p class="text-muted small">Peminjaman dan pengembalian buku tanpa antre dengan sistem digital.</p></div></div>
                <div class="col-md-4"><div class="feature-card"><i class="bi bi-chat-dots fs-1 mb-3 d-block" style="color: var(--p-purple);"></i><h4 class="fw-bold">Q&A Petugas</h4><p class="text-muted small">Konsultasi langsung dengan pustakawan profesional SMA Jomok 69.</p></div></div>
                <div class="col-md-4"><div class="feature-card"><i class="bi bi-journal-check fs-1 mb-3 d-block" style="color: var(--p-purple);"></i><h4 class="fw-bold">Info Terkini</h4><p class="text-muted small">Update koleksi terbaru dan info denda secara transparan.</p></div></div>
            </div>
        </div>
    </section>

    <!-- Buku Terbaru (Cinematic Style) -->
    <section class="py-5 bg-white">
        <div class="container py-5 text-center">
            <h2 class="section-title">Buku Terbaru</h2>
            <div class="row g-4 mt-2">
                @foreach($latestBooks as $book)
                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('login') }}" class="book-cinematic-card">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" class="book-card-image" alt="{{ $book->title }}">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center h-100">
                                <i class="bi bi-book display-1 opacity-10" style="color: var(--p-purple);"></i>
                            </div>
                        @endif
                        
                        <div class="book-card-category">{{ $book->category->name }}</div>
                        
                        <div class="book-card-overlay">
                            <h5 class="book-card-title">{{ $book->title }}</h5>
                            <p class="book-card-author">{{ $book->author->name }}</p>
                            <div class="book-card-footer">
                                <span class="badge {{ $book->stock > 0 ? 'bg-success' : 'bg-danger' }} rounded-pill">
                                    {{ $book->stock > 0 ? 'Tersedia' : 'Habis' }}
                                </span>
                                <span class="text-warning fw-black small">PINJAM <i class="bi bi-arrow-right"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Detailed Premium Footer -->
    <footer class="footer-ngawi">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4 text-start">
                    <h3 class="fw-black mb-4 text-white">NGAWI <span style="color: var(--s-gold);">PERPUS</span></h3>
                    <p class="small opacity-50 mb-4 lh-lg">Membangun ekosistem literasi digital yang modern dan inklusif bagi seluruh civitas akademika SMA Jomok 69 Jakarta. Akses ilmu pengetahuan kini dalam genggaman Anda.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 text-start">
                    <h5 class="fw-bold mb-4 text-white">Navigasi</h5>
                    <a href="/" class="footer-link small text-uppercase fw-bold">Beranda</a>
                    <a href="{{ route('books.browse') }}" class="footer-link small text-uppercase fw-bold">Katalog Buku</a>
                    <a href="{{ route('login') }}" class="footer-link small text-uppercase fw-bold">Masuk</a>
                    <a href="{{ route('register') }}" class="footer-link small text-uppercase fw-bold">Daftar</a>
                </div>
                <div class="col-lg-3 text-start">
                    <h5 class="fw-bold mb-4 text-white">Informasi Kontak</h5>
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
                    <h5 class="fw-bold mb-4 text-white">Jam Layanan</h5>
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
                    <p class="small opacity-25 mb-0 text-white">&copy; 2026 SMA Jomok 69 Jakarta. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="small opacity-25 mb-0 text-white">Designed for Educational Excellence</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
