import { Link } from '@inertiajs/react';
import { PropsWithChildren } from 'react';

export default function Guest({ children }: PropsWithChildren) {
    return (
        <div className="min-vh-100 d-flex align-items-center justify-content-center" style={{ 
            background: 'linear-gradient(rgba(74, 20, 140, 0.8), rgba(74, 20, 140, 0.8)), url("https://images.unsplash.com/photo-1521587760476-6c12a4b040da?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80")',
            backgroundSize: 'cover',
            backgroundPosition: 'center',
            backgroundAttachment: 'fixed',
            fontFamily: "'Outfit', sans-serif"
        }}>
            <div className="card glass-card border-0 shadow-lg p-4 w-100" style={{ maxWidth: '450px', borderRadius: '24px', backgroundColor: 'rgba(255, 255, 255, 0.9)', backdropFilter: 'blur(15px)' }}>
                <div className="text-center mb-4">
                    <Link href="/" className="text-decoration-none">
                        <h2 className="fw-black text-primary mb-0">NGAWI</h2>
                        <p className="text-muted small fw-bold">SMA JOMOK 69 JAKARTA</p>
                    </Link>
                </div>

                {children}

                <div className="text-center mt-4 pt-3 border-top opacity-50">
                    <p className="small mb-0">&copy; 2026 Ngawi Perpustakaan</p>
                </div>
            </div>
        </div>
    );
}
