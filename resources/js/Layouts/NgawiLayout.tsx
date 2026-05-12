import React from 'react';
import { Link, usePage } from '@inertiajs/react';

interface Props {
    children: React.ReactNode;
    title?: string;
}

export default function NgawiLayout({ children, title }: Props) {
    const { auth }: any = usePage().props;
    const user = auth.user;

    return (
        <div className="min-vh-100 d-flex flex-column">
            {/* Navbar */}
            <nav className="navbar navbar-expand-lg navbar-dark sticky-top shadow-sm py-3" style={{ background: 'rgba(74, 20, 140, 0.95)', borderBottom: '3px solid #ffd600' }}>
                <div className="container">
                    <Link className="navbar-brand fw-black" href="/">
                        <span className="text-warning">NGAWI</span> PERPUS
                    </Link>
                    <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span className="navbar-toggler-icon"></span>
                    </button>
                    <div className="collapse navbar-collapse" id="navbarNav">
                        <ul className="navbar-nav me-auto">
                            <li className="nav-item">
                                <Link className="nav-link fw-bold px-3" href={route('dashboard')}>DASHBOARD</Link>
                            </li>
                            <li className="nav-item">
                                <Link className="nav-link px-3" href={route('books.browse')}>JELAJAH BUKU</Link>
                            </li>
                            <li className="nav-item">
                                <Link className="nav-link px-3" href={route('chat.index')}>KONSULTASI (CHAT)</Link>
                            </li>
                        </ul>
                        <div className="d-flex align-items-center">
                            <div className="dropdown">
                                <button className="btn btn-outline-warning dropdown-toggle rounded-pill px-4" type="button" data-bs-toggle="dropdown">
                                    <i className="bi bi-person-circle me-2"></i> {user.name}
                                </button>
                                <ul className="dropdown-menu dropdown-menu-end glass-card border-0 shadow mt-2">
                                    <li><Link className="dropdown-item py-2" href={route('profile.edit')}>Profil Saya</Link></li>
                                    <li><hr className="dropdown-divider opacity-50" /></li>
                                    <li>
                                        <Link href={route('logout')} method="post" as="button" className="dropdown-item py-2 text-danger">
                                            Keluar Sistem
                                        </Link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            {/* Main Content */}
            <main className="container py-5 flex-grow-1">
                {children}
            </main>

            {/* Footer */}
            <footer className="bg-dark text-white py-4 mt-auto border-top border-secondary border-opacity-25">
                <div className="container text-center">
                    <p className="mb-0 small opacity-50">&copy; 2026 SMA Jomok 69 Jakarta. All Rights Reserved.</p>
                </div>
            </footer>
        </div>
    );
}
