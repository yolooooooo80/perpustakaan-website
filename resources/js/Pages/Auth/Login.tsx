import { useForm, Head, Link } from '@inertiajs/react';
import { FormEventHandler } from 'react';
import GuestLayout from '@/Layouts/GuestLayout';

export default function Login({ status, canResetPassword }: { status?: string, canResetPassword?: boolean }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route('login'), {
            onFinish: () => reset('password'),
        });
    };

    return (
        <GuestLayout>
            <Head title="Login Anggota" />

            {status && <div className="alert alert-success mb-4">{status}</div>}

            <form onSubmit={submit}>
                <h4 className="fw-black text-center mb-4">LOGIN ANGGOTA</h4>

                <div className="mb-3">
                    <label className="form-label small fw-bold text-muted">Email Sekolah</label>
                    <input
                        type="email"
                        className={`form-control bg-light border-0 py-2 ${errors.email ? 'is-invalid' : ''}`}
                        value={data.email}
                        onChange={(e) => setData('email', e.target.value)}
                        required
                        autoFocus
                    />
                    {errors.email && <div className="invalid-feedback d-block">{errors.email}</div>}
                </div>

                <div className="mb-3">
                    <label className="form-label small fw-bold text-muted">Kata Sandi</label>
                    <input
                        type="password"
                        className={`form-control bg-light border-0 py-2 ${errors.password ? 'is-invalid' : ''}`}
                        value={data.password}
                        onChange={(e) => setData('password', e.target.value)}
                        required
                    />
                    {errors.password && <div className="invalid-feedback d-block">{errors.password}</div>}
                </div>

                <div className="mb-3 form-check">
                    <input
                        type="checkbox"
                        className="form-check-input"
                        id="remember"
                        checked={data.remember}
                        onChange={(e) => setData('remember', e.target.checked)}
                    />
                    <label className="form-check-label small text-muted" htmlFor="remember">
                        Ingat saya di perangkat ini
                    </label>
                </div>

                <div className="d-grid gap-2">
                    <button type="submit" className="btn btn-primary fw-bold py-2 shadow" disabled={processing}>
                        {processing ? 'MEMPROSES...' : 'MASUK SEKARANG'}
                    </button>
                </div>

                <div className="mt-4 text-center">
                    {canResetPassword && (
                        <Link href={route('password.request')} className="text-decoration-none small fw-bold me-3">
                            Lupa sandi?
                        </Link>
                    )}
                    <Link href={route('register')} className="text-decoration-none small fw-bold text-warning">Daftar Akun Baru</Link>
                </div>
            </form>
        </GuestLayout>
    );
}
