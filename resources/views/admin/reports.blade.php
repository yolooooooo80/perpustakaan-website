@extends('layouts.app')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-black text-primary-custom mb-1"><i class="bi bi-file-earmark-bar-graph-fill me-2"></i> Laporan Bulanan</h3>
            <p class="text-muted small">Ringkasan statistik transaksi dan pendapatan denda Ngawi Perpustakaan.</p>
        </div>
        <button onclick="window.print()" class="btn btn-outline-primary rounded-pill px-4 fw-bold shadow-sm d-print-none">
            <i class="bi bi-printer-fill me-2"></i> CETAK LAPORAN
        </button>
    </div>

    <div class="card glass-card border-0 shadow-sm p-4 mb-5">
        <h5 class="fw-bold mb-4 text-primary-custom">Statistik Pertumbuhan</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="px-4 py-3">Bulan</th>
                        <th class="text-center">Total Peminjaman</th>
                        <th class="text-center">Total Denda Terkumpul</th>
                        <th class="text-center">Status Laporan</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach($monthlyStats as $stat)
                    <tr>
                        <td class="px-4 fw-bold">
                            {{ \Carbon\Carbon::parse($stat->month)->format('F Y') }}
                        </td>
                        <td class="text-center fw-bold text-primary">{{ $stat->total_loans }} Transaksi</td>
                        <td class="text-center fw-black text-success">Rp {{ number_format($stat->total_fines) }}</td>
                        <td class="text-center">
                            <span class="badge bg-success-subtle text-success rounded-pill px-3">VERIFIED</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Informasi Tambahan -->
    <div class="row g-4 d-print-none">
        <div class="col-md-6">
            <div class="card glass-card border-0 shadow-sm p-4 h-100">
                <h6 class="fw-bold mb-3 text-primary-custom">Buku Paling Populer</h6>
                @foreach(\App\Models\Loan::select('book_id')->selectRaw('count(*) as count')->groupBy('book_id')->orderBy('count', 'desc')->take(3)->get() as $pop)
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-light p-2 rounded-3 me-3 text-primary">
                            <i class="bi bi-award-fill"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-bold small">{{ $pop->book->title }}</div>
                            <div class="x-small text-muted">{{ $pop->count }} Kali Dipinjam</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-6">
            <div class="card glass-card border-0 shadow-sm p-4 h-100">
                <h6 class="fw-bold mb-3 text-primary-custom">Kategori Teraktif</h6>
                @foreach(\App\Models\Category::withCount('books')->orderBy('books_count', 'desc')->take(3)->get() as $cat)
                    <div class="mb-2">
                        <div class="d-flex justify-content-between small mb-1">
                            <span>{{ $cat->name }}</span>
                            <span class="fw-bold">{{ $cat->books_count }} Buku</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-primary" style="width: {{ ($cat->books_count / (\App\Models\Book::count() ?: 1)) * 100 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .navbar, .footer, .btn-print, .d-print-none { display: none !important; }
    .glass-card { box-shadow: none !important; border: 1px solid #ddd !important; }
    body { background: white !important; }
}
</style>
@endsection
