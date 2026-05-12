import React from 'react';
import NgawiLayout from '@/Layouts/NgawiLayout';
import { Head, Link } from '@inertiajs/react';

interface Props {
    stats: {
        totalBooks: number;
        totalAuthors: number;
        totalCategories: number;
        activeLoans: number;
        totalUsers: number;
    };
    recentUsers: any[];
}

export default function Dashboard({ stats, recentUsers }: Props) {
    return (
        <NgawiLayout>
            <Head title="Admin Dashboard" />
            
            <div className="fade-in">
                <div className="d-flex justify-content-between align-items-center mb-4">
                    <h3 className="fw-bold text-primary-custom mb-0"><i className="bi bi-speedometer2 me-2"></i> Panel Utama Admin</h3>
                    <div className="text-muted small">Ngawi Perpustakaan v2.0 (React + TS)</div>
                </div>

                <div className="row g-4 mb-5">
                    {[
                        { label: 'Total Buku', value: stats.totalBooks, icon: 'bi-journal-bookmark', color: 'primary' },
                        { label: 'Penulis', value: stats.totalAuthors, icon: 'bi-person-badge', color: 'success' },
                        { label: 'Kategori', value: stats.totalCategories, icon: 'bi-tags', color: 'info' },
                        { label: 'Pinjaman Aktif', value: stats.activeLoans, icon: 'bi-arrow-repeat', color: 'warning' },
                        { label: 'Total User', value: stats.totalUsers, icon: 'bi-people', color: 'danger' },
                    ].map((stat, i) => (
                        <div className="col" key={i}>
                            <div className="card glass-card border-0 shadow-sm h-100 text-center p-3">
                                <div className={`display-6 text-${stat.color} mb-2`}><i className={`bi ${stat.icon}`}></i></div>
                                <h2 className="fw-black mb-0">{stat.value}</h2>
                                <div className="small text-muted fw-bold text-uppercase">{stat.label}</div>
                            </div>
                        </div>
                    ))}
                </div>

                <div className="row">
                    <div className="col-lg-8">
                        <div className="card glass-card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div className="card-header bg-dark text-white p-4 d-flex justify-content-between align-items-center">
                                <h5 className="mb-0 fw-bold">Pengguna Baru Bergabung</h5>
                                <Link href={route('admin.users')} className="btn btn-sm btn-outline-light rounded-pill">Lihat Semua</Link>
                            </div>
                            <div className="card-body p-0">
                                <table className="table table-hover align-middle mb-0">
                                    <thead className="bg-light">
                                        <tr>
                                            <th className="px-4 py-3">Nama</th>
                                            <th className="px-4 py-3">Email</th>
                                            <th className="px-4 py-3">Role</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {recentUsers.map((user) => (
                                            <tr key={user.id}>
                                                <td className="px-4 py-3 fw-bold">{user.name}</td>
                                                <td className="px-4 py-3 small">{user.email}</td>
                                                <td className="px-4 py-3">
                                                    <span className={`badge rounded-pill px-3 ${user.role === 'admin' ? 'bg-danger' : (user.role === 'pegawai' ? 'bg-warning' : 'bg-primary')}`}>
                                                        {user.role}
                                                    </span>
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div className="col-lg-4">
                        <div className="card glass-card border-0 shadow-sm rounded-4 bg-primary text-white p-4 h-100 d-flex flex-column justify-content-center align-items-center text-center">
                            <i className="bi bi-graph-up-arrow display-1 mb-4 opacity-25"></i>
                            <h4 className="fw-black">LAPORAN BULANAN</h4>
                            <p className="small opacity-75 mb-4">Pantau performa peminjaman dan pendapatan denda bulan ini.</p>
                            <Link href={route('admin.reports')} className="btn btn-warning btn-lg rounded-pill px-5 fw-bold shadow">BUKA LAPORAN</Link>
                        </div>
                    </div>
                </div>
            </div>
        </NgawiLayout>
    );
}
