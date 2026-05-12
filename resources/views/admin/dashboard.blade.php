@extends('layouts.app')

@section('page_title', 'Dashboard Administrator')

@section('content')
<div class="fade-in">
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card glass-card p-4 border-0 h-100 shadow-sm" style="border-left: 5px solid var(--p-purple) !important;">
                <h6 class="fw-bold text-muted small">TOTAL BUKU</h6>
                <h2 class="fw-black text-primary mb-0" style="color: var(--p-purple) !important;">{{ $stats['totalBooks'] }}</h2>
                <i class="bi bi-journals position-absolute top-50 end-0 translate-middle opacity-10 display-4"></i>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card glass-card p-4 border-0 h-100 shadow-sm" style="border-left: 5px solid var(--s-gold) !important;">
                <h6 class="fw-bold text-muted small">ANGGOTA AKTIF</h6>
                <h2 class="fw-black text-dark mb-0">{{ $stats['totalUsers'] }}</h2>
                <i class="bi bi-people-fill position-absolute top-50 end-0 translate-middle opacity-10 display-4"></i>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card glass-card p-4 border-0 h-100 shadow-sm" style="border-left: 5px solid #198754 !important;">
                <h6 class="fw-bold text-muted small">PINJAMAN AKTIF</h6>
                <h2 class="fw-black text-success mb-0">{{ $stats['activeLoans'] }}</h2>
                <i class="bi bi-arrow-repeat position-absolute top-50 end-0 translate-middle opacity-10 display-4"></i>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card glass-card p-4 border-0 h-100 shadow-sm" style="border-left: 5px solid #dc3545 !important;">
                <h6 class="fw-bold text-muted small">PENDAPATAN DENDA</h6>
                <h2 class="fw-black text-danger mb-0">Rp {{ number_format($stats['monthlyRevenue']) }}</h2>
                <i class="bi bi-cash-stack position-absolute top-50 end-0 translate-middle opacity-10 display-4"></i>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Monitoring Peminjam -->
        <div class="col-md-8">
            <div class="card glass-card border-0 shadow-sm overflow-hidden mb-4">
                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0 text-primary-ngawi"><i class="bi bi-eye-fill me-2"></i> Peminjam Terkini</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr class="bg-light">
                                <th class="px-4">Siswa</th>
                                <th>Judul Buku</th>
                                <th>Jatuh Tempo</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($currentBorrowers as $loan)
                            <tr>
                                <td class="px-4">
                                    <div class="fw-bold small text-dark">{{ $loan->user->name }}</div>
                                    <div class="x-small text-muted">{{ $loan->user->email }}</div>
                                </td>
                                <td class="small">{{ $loan->book->title }}</td>
                                <td class="small">{{ \Carbon\Carbon::parse($loan->due_at)->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    <span class="badge rounded-pill {{ $loan->status == 'aktif' ? 'bg-primary' : ($loan->status == 'rusak' ? 'bg-danger' : 'bg-success') }}">
                                        {{ strtoupper($loan->status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Inventaris Singkat -->
            <div class="card glass-card border-0 shadow-sm p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0 text-primary-ngawi"><i class="bi bi-box-seam-fill me-2"></i> Log Inventaris Terbaru</h5>
                    <a href="{{ route('admin.inventory') }}" class="btn btn-sm btn-p">KELOLA SEMUA</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr class="text-muted small">
                                <th>WAKTU</th>
                                <th>BUKU</th>
                                <th>AKSI</th>
                                <th>QTY</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentInventory as $log)
                            <tr>
                                <td class="small">{{ $log->created_at->format('d/m H:i') }}</td>
                                <td class="small fw-bold">{{ $log->book->title }}</td>
                                <td>
                                    <span class="badge {{ $log->type == 'in' ? 'bg-success' : 'bg-danger' }} x-small">{{ strtoupper($log->type) }}</span>
                                </td>
                                <td class="fw-bold">{{ $log->quantity }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Pendaftaran Terbaru -->
            <div class="card glass-card border-0 shadow-sm p-4 mb-4">
                <h5 class="fw-bold mb-4 text-primary-ngawi"><i class="bi bi-person-plus-fill me-2"></i> Anggota Baru</h5>
                @foreach($registeredUsers as $regUser)
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-light p-2 rounded-circle me-3">
                        <i class="bi bi-person text-primary"></i>
                    </div>
                    <div>
                        <div class="fw-bold small">{{ $regUser->name }}</div>
                        <div class="x-small text-muted">{{ $regUser->created_at->diffForHumans() }}</div>
                    </div>
                    <span class="ms-auto badge bg-light text-dark x-small">{{ $regUser->role }}</span>
                </div>
                @endforeach
                <a href="{{ route('admin.users') }}" class="btn btn-sm btn-outline-primary w-100 mt-3 rounded-pill">Lihat Semua</a>
            </div>

            <!-- Link Laporan -->
            <div class="card border-0 shadow-sm p-4 text-white" style="background: var(--p-purple); border-radius: 20px;">
                <h5 class="fw-bold mb-3">Laporan Bulanan</h5>
                <p class="small opacity-75">Statistik transaksi sirkulasi dan denda per periode.</p>
                <a href="{{ route('admin.reports') }}" class="btn btn-s w-100 mt-2 shadow">BUKA LAPORAN <i class="bi bi-arrow-right ms-2"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection
