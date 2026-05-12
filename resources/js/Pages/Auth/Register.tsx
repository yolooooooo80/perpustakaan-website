import { useForm, Head, Link } from '@inertiajs/react';
import { FormEventHandler } from 'react';
import GuestLayout from '@/Layouts/GuestLayout';

export default function Register() {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route('register'), {
            onFinish: () => reset('password', 'password_confirmation'),
        });
    };

    return (
        <GuestLayout>
            <Head title="Daftar Anggota" />

            <form onSubmit={submit}>
                <h4 className="fw-black text-center mb-4">DAFTAR ANGGOTA</h4>

                <div className="mb-3">
                    <label className="form-label small fw-bold text-muted">Nama Lengkap</label>
                    <input
                        type="text"
                        className={`form-control bg-light border-0 py-2 ${errors.name ? 'is-invalid' : ''}`}
                        value={data.name}
                        onChange={(e) => setData('name', e.target.value)}
                        required
                        autoFocus
                    />
                    {errors.name && <div className="invalid-feedback d-block">{errors.name}</div>}
                </div>

                <div className="mb-3">
                    <label className="form-label small fw-bold text-muted">Email Sekolah</label>
                    <input
                        type="email"
                        className={`form-control bg-light border-0 py-2 ${errors.email ? 'is-invalid' : ''}`}
                        value={data.email}
                        onChange={(e) => setData('email', e.target.value)}
                        required
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

                <div className="mb-3">
                    <label className="form-label small fw-bold text-muted">Konfirmasi Kata Sandi</label>
                    <input
                        type="password"
                        className={`form-control bg-light border-0 py-2 ${errors.password_confirmation ? 'is-invalid' : ''}`}
                        value={data.password_confirmation}
                        onChange={(e) => setData('password_confirmation', e.target.value)}
                        required
                    />
                    {errors.password_confirmation && <div className="invalid-feedback d-block">{errors.password_confirmation}</div>}
                </div>

                <div className="d-grid gap-2">
                    <button type="submit" className="btn btn-primary fw-bold py-2 shadow" disabled={processing}>
                        {processing ? 'MENDAFTAR...' : 'DAFTAR SEKARANG'}
                    </button>
                </div>

                <div className="mt-4 text-center">
                    <Link href={route('login')} className="text-decoration-none small fw-bold text-warning">Sudah punya akun? Login di sini</Link>
                </div>
            </form>
        </GuestLayout>
    );
}
