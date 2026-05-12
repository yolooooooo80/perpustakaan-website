import React from 'react';
import NgawiLayout from '@/Layouts/NgawiLayout';
import { Head, Link } from '@inertiajs/react';

interface Props {
    stats: {
        totalBooks: number;
        activeLoans: number;
        pendingReturns: number;
    };
}

export default function Dashboard({ stats }: Props) {
    return (
        <NgawiLayout>
            <Head title="Staff Dashboard" />
            
            <div className="fade-in">
                <div className="d-flex justify-content-between align-items-center mb-4">
                    <h3 className="fw-bold text-primary-custom mb-0"><i className="bi bi-briefcase me-2"></i> Dashboard Pegawai</h3>
                    <div className="text-muted small">Kelola koleksi & sirkulasi buku</div>
                </div>

                <div className="row g-4 mb-5">
                    <div className="col-md-4">
                        <div className="card glass-card border-0 shadow-lg p-4 bg-primary text-white">
                            <h6 className="small text-uppercase opacity-75 fw-bold">Total Koleksi</h6>
                            <h1 className="fw-black mb-0 display-4">{stats.totalBooks}</h1>
                            <Link href={route('staff.books.index')} className="btn btn-sm btn-light rounded-pill px-4 mt-3 fw-bold">KELOLA BUKU</Link>
                        </div>
                    </div>
                    <div className="col-md-4">
                        <div className="card glass-card border-0 shadow-lg p-4 bg-warning">
                            <h6 className="small text-uppercase opacity-75 fw-bold text-dark">Pinjaman Berjalan</h6>
                            <h1 className="fw-black mb-0 display-4 text-dark">{stats.activeLoans}</h1>
                            <Link href={route('staff.loans.index')} className="btn btn-sm btn-dark rounded-pill px-4 mt-3 fw-bold">CEK STATUS</Link>
                        </div>
                    </div>
                    <div className="col-md-4">
                        <div className="card glass-card border-0 shadow-lg p-4 bg-danger text-white">
                            <h6 className="small text-uppercase opacity-75 fw-bold">Terlambat Kembali</h6>
                            <h1 className="fw-black mb-0 display-4">{stats.pendingReturns}</h1>
                            <Link href={route('staff.loans.index')} className="btn btn-sm btn-light rounded-pill px-4 mt-3 fw-bold">LIHAT DETAIL</Link>
                        </div>
                    </div>
                </div>

                <div className="row g-4">
                    <div className="col-md-6">
                        <div className="card glass-card border-0 shadow-sm p-4 h-100">
                            <div className="d-flex align-items-center mb-4">
                                <div className="bg-info bg-opacity-10 p-3 rounded-4 me-3">
                                    <i className="bi bi-people-fill text-info fs-3"></i>
                                </div>
                                <div>
                                    <h5 className="fw-bold mb-0">Manajemen Anggota</h5>
                                    <p className="small text-muted mb-0">Lihat data siswa dan staf terdaftar.</p>
                                </div>
                            </div>
                            <div className="d-grid">
                                <Link href="#" className="btn btn-outline-info rounded-pill py-2">Buka Data Anggota</Link>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-6">
                        <div className="card glass-card border-0 shadow-sm p-4 h-100">
                            <div className="d-flex align-items-center mb-4">
                                <div className="bg-success bg-opacity-10 p-3 rounded-4 me-3">
                                    <i className="bi bi-chat-dots-fill text-success fs-3"></i>
                                </div>
                                <div>
                                    <h5 className="fw-bold mb-0">Konsultasi Siswa</h5>
                                    <p className="small text-muted mb-0">Balas pertanyaan chat dari pengunjung.</p>
                                </div>
                            </div>
                            <div className="d-grid">
                                <Link href={route('chat.index')} className="btn btn-outline-success rounded-pill py-2">Masuk Ruang Chat</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </NgawiLayout>
    );
}
