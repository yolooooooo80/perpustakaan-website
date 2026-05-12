import React from 'react';
import { Link, Head } from '@inertiajs/react';

interface Props {
    auth: {
        user: any;
    };
}

export default function Welcome({ auth }: Props) {
    return (
        <div className="bg-light min-vh-100 font-outfit">
            <Head title="Ngawi Perpustakaan - SMA Jomok 69 Jakarta" />
            
            {/* Navbar Landing */}
            <nav className="navbar navbar-expand-lg navbar-dark sticky-top py-3" style={{ background: 'rgba(74, 20, 140, 0.95)', borderBottom: '3px solid #ffd600' }}>
                <div className="container">
                    <Link className="navbar-brand fw-black fs-3" href="/">
                        <span className="text-warning">NGAWI</span> PERPUS
                    </Link>
                    <div className="d-flex gap-2">
                        {auth.user ? (
                            <Link href={route('dashboard')} className="btn btn-warning rounded-pill px-4 fw-bold">DASHBOARD</Link>
                        ) : (
                            <>
                                <Link href={route('login')} className="btn btn-outline-light rounded-pill px-4 fw-bold">MASUK</Link>
                                <Link href={route('register')} className="btn btn-warning rounded-pill px-4 fw-bold shadow">DAFTAR</Link>
                            </>
                        )}
                    </div>
                </div>
            </nav>

            {/* Hero Section */}
            <header className="position-relative overflow-hidden" style={{ 
                background: 'linear-gradient(rgba(74, 20, 140, 0.8), rgba(74, 20, 140, 0.8)), url("https://images.unsplash.com/photo-1521587760476-6c12a4b040da?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80")',
                backgroundSize: 'cover',
                backgroundPosition: 'center',
                padding: '120px 0',
                borderRadius: '0 0 100px 100px'
            }}>
                <div className="container text-center text-white fade-in position-relative z-1">
                    <h1 className="fw-black display-1 mb-3 tracking-tighter shadow-text">LITERASI UNTUK <span className="text-warning">MASA DEPAN</span></h1>
                    <p className="lead fs-4 opacity-75 mb-5 mx-auto" style={{ maxWidth: '700px' }}>
                        Platform Perpustakaan Digital Resmi SMA Jomok 69 Jakarta. Akses ribuan koleksi buku, jurnal, dan karya ilmiah dalam genggaman.
                    </p>
                    <div className="d-flex justify-content-center gap-3">
                        <Link href={route('books.browse')} className="btn btn-warning btn-lg rounded-pill px-5 fw-bold shadow-lg transform-hover">JELAJAH KOLEKSI</Link>
                        <a href="#about" className="btn btn-outline-light btn-lg rounded-pill px-5 fw-bold">TENTANG KAMI</a>
                    </div>
                </div>
            </header>

            {/* Features Section */}
            <section className="container py-5 mt-5">
                <div className="row g-4 text-center">
                    <div className="col-md-4">
                        <div className="card glass-card p-4 border-0 shadow-sm h-100 transform-hover">
                            <i className="bi bi-lightning-charge-fill display-4 text-warning mb-3"></i>
                            <h4 className="fw-bold">Akses Cepat</h4>
                            <p className="text-muted small">Pinjam buku favoritmu hanya dengan satu kali klik tanpa antre.</p>
                        </div>
                    </div>
                    <div className="col-md-4">
                        <div className="card glass-card p-4 border-0 shadow-sm h-100 transform-hover">
                            <i className="bi bi-shield-check display-4 text-primary mb-3"></i>
                            <h4 className="fw-bold">Sistem Aman</h4>
                            <p className="text-muted small">Keamanan data anggota dan riwayat peminjaman terjamin terenkripsi.</p>
                        </div>
                    </div>
                    <div className="col-md-4">
                        <div className="card glass-card p-4 border-0 shadow-sm h-100 transform-hover">
                            <i className="bi bi-chat-heart-fill display-4 text-danger mb-3"></i>
                            <h4 className="fw-bold">Bantuan 24/7</h4>
                            <p className="text-muted small">Butuh bantuan? Tim pustakawan kami siap membantu via fitur chat Q&A.</p>
                        </div>
                    </div>
                </div>
            </section>

            {/* Footer */}
            <footer className="bg-dark text-white py-5 mt-5">
                <div className="container text-center">
                    <h3 className="fw-black text-warning mb-3">NGAWI PERPUS</h3>
                    <p className="opacity-50 small mb-0">&copy; 2026 SMA Jomok 69 Jakarta. Dibuat dengan dedikasi untuk pendidikan Indonesia.</p>
                </div>
            </footer>
        </div>
    );
}
