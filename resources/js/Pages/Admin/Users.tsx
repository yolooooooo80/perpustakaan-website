import React from 'react';
import NgawiLayout from '@/Layouts/NgawiLayout';
import { Head } from '@inertiajs/react';

interface Props {
    users: {
        data: any[];
        links: any[];
    };
}

export default function Users({ users }: Props) {
    return (
        <NgawiLayout>
            <Head title="Manajemen User" />
            
            <div className="fade-in">
                <div className="d-flex justify-content-between align-items-center mb-4">
                    <h3 className="fw-bold text-primary-custom mb-0"><i className="bi bi-people me-2"></i> Manajemen Pengguna</h3>
                </div>

                <div className="card glass-card border-0 shadow-lg overflow-hidden">
                    <div className="table-responsive">
                        <table className="table table-hover align-middle mb-0">
                            <thead className="bg-dark text-white">
                                <tr>
                                    <th className="px-4 py-3">Nama</th>
                                    <th className="px-4 py-3">Email</th>
                                    <th className="px-4 py-3">Role</th>
                                    <th className="px-4 py-3">Tgl Bergabung</th>
                                </tr>
                            </thead>
                            <tbody className="bg-white">
                                {users.data.map((user) => (
                                    <tr key={user.id}>
                                        <td className="px-4 py-3 fw-bold">{user.name}</td>
                                        <td className="px-4 py-3 small">{user.email}</td>
                                        <td className="px-4 py-3">
                                            <span className={`badge rounded-pill px-3 ${user.role === 'admin' ? 'bg-danger' : (user.role === 'pegawai' ? 'bg-warning' : 'bg-primary')}`}>
                                                {user.role}
                                            </span>
                                        </td>
                                        <td className="px-4 py-3 small text-muted">
                                            {new Date(user.created_at).toLocaleDateString('id-ID')}
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </NgawiLayout>
    );
}
