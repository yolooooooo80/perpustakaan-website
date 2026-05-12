@extends('layouts.app')

@section('content')
<div class="fade-in">
    <div class="text-center mb-5">
        <h2 class="fw-black text-primary-ngawi display-5 mb-2">MANAJEMEN <span class="text-accent-ngawi">ANGGOTA</span></h2>
        <p class="text-muted">Kelola seluruh pengguna terdaftar di Ngawi Perpustakaan.</p>
        <div class="mx-auto bg-warning rounded-pill" style="width: 80px; height: 6px;"></div>
    </div>

    <div class="card glass-card border-0 shadow-sm overflow-hidden">
        <div class="card-header bg-primary text-white p-4 border-0">
            <h5 class="fw-bold mb-0"><i class="bi bi-people-fill me-2"></i> Daftar Seluruh Pengguna</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3">Informasi Pengguna</th>
                        <th class="py-3">Email</th>
                        <th class="py-3 text-center">Peran (Role)</th>
                        <th class="py-3 text-center">Tanggal Bergabung</th>
                        <th class="py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-white p-2 rounded-circle me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div class="fw-bold text-dark">{{ $user->name }}</div>
                            </div>
                        </td>
                        <td class="py-3">{{ $user->email }}</td>
                        <td class="py-3 text-center">
                            <span class="badge rounded-pill px-3 py-2 {{ $user->role == 'admin' ? 'bg-danger' : ($user->role == 'pegawai' ? 'bg-primary' : 'bg-success') }}">
                                {{ strtoupper($user->role) }}
                            </span>
                        </td>
                        <td class="py-3 text-center small text-muted">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="py-3 text-center">
                            <button class="btn btn-sm btn-outline-primary rounded-pill px-3">EDIT</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 bg-light border-top">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
