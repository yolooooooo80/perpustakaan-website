import React from 'react';
import NgawiLayout from '@/Layouts/NgawiLayout';
import { Head, Link } from '@inertiajs/react';

interface Props {
    books: any[];
    myLoans: any[];
}

export default function Dashboard({ books, myLoans }: Props) {
    return (
        <NgawiLayout>
            <Head title="Dashboard Siswa" />
            
            <div className="fade-in">
                {/* Hero / Welcome */}
                <div className="card border-0 shadow-lg mb-5 overflow-hidden rounded-4" style={{ 
                    background: 'linear-gradient(rgba(74, 20, 140, 0.8), rgba(74, 20, 140, 0.8)), url("https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80")',
                    backgroundSize: 'cover',
                    backgroundPosition: 'center',
                    padding: '80px 40px'
                }}>
                    <div className="position-relative z-1 text-white text-center">
                        <h1 className="fw-black display-3 mb-2 tracking-tighter">SELAMAT DATANG!</h1>
                        <p className="lead opacity-75 mb-4">Jelajahi ribuan koleksi buku di Ngawi Perpustakaan SMA Jomok 69 Jakarta.</p>
                        <Link href={route('books.browse')} className="btn btn-warning btn-lg rounded-pill px-5 fw-bold shadow-lg transform-hover">
                            <i className="bi bi-search me-2"></i> PINJAM BUKU SEKARANG
                        </Link>
                    </div>
                </div>

                <div className="row">
                    {/* Left Column: Recent Books */}
                    <div className="col-lg-8">
                        <h4 className="fw-bold mb-4"><i className="bi bi-stars text-warning me-2"></i> Rekomendasi Koleksi</h4>
                        <div className="row g-4">
                            {books.map((book) => (
                                <div className="col-md-4" key={book.id}>
                                    <div className="card glass-card border-0 shadow-sm h-100 overflow-hidden hover-scale">
                                        <div style={{ height: '200px', backgroundColor: '#f8f9fa' }} className="d-flex align-items-center justify-content-center border-bottom">
                                            {book.cover_image ? (
                                                <img src={`/storage/${book.cover_image}`} className="w-100 h-100 object-fit-cover" alt={book.title} />
                                            ) : (
                                                <i className="bi bi-book fs-1 opacity-25 text-primary"></i>
                                            )}
                                        </div>
                                        <div className="card-body p-3">
                                            <span className="badge bg-primary-subtle text-primary x-small mb-2 rounded-pill px-3">
                                                {book.category.name}
                                            </span>
                                            <h6 className="fw-bold mb-1 text-truncate" title={book.title}>{book.title}</h6>
                                            <p className="x-small text-muted mb-3">{book.author.name}</p>
                                            <div className="d-grid">
                                                <Link href={route('books.browse')} className="btn btn-sm btn-outline-primary rounded-pill">Detail</Link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>

                    {/* Right Column: Active Loans */}
                    <div className="col-lg-4">
                        <h4 className="fw-bold mb-4"><i className="bi bi-clock-history text-primary me-2"></i> Pinjaman Aktif</h4>
                        <div className="card glass-card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div className="card-body p-4">
                                {myLoans.length > 0 ? (
                                    <div className="list-group list-group-flush gap-3">
                                        {myLoans.map((loan) => (
                                            <div key={loan.id} className="list-group-item bg-transparent border-0 p-0">
                                                <div className="p-3 bg-light rounded-3">
                                                    <h6 className="fw-bold mb-1">{loan.book.title}</h6>
                                                    <div className="d-flex justify-content-between align-items-center mt-2">
                                                        <span className="x-small text-danger fw-bold">
                                                            Tempo: {new Date(loan.due_at).toLocaleDateString('id-ID')}
                                                        </span>
                                                        <span className="badge bg-warning text-dark x-small rounded-pill">AKTIF</span>
                                                    </div>
                                                </div>
                                            </div>
                                        ))}
                                    </div>
                                ) : (
                                    <div className="text-center py-4 opacity-50">
                                        <i className="bi bi-journal-check fs-1"></i>
                                        <p className="small mt-2 mb-0">Belum ada pinjaman aktif.</p>
                                    </div>
                                )}
                                <div className="d-grid mt-4">
                                    <Link href={route('loans.mine')} className="btn btn-dark rounded-pill py-2 small fw-bold">RIWAYAT PINJAMAN</Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </NgawiLayout>
    );
}
