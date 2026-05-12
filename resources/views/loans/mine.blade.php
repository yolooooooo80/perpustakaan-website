@extends('layouts.app')

@section('title', 'Pinjaman Saya')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary-custom mb-0"><i class="bi bi-clock-history me-2"></i> Riwayat Pinjaman Saya</h3>
        <a href="{{ route('books.browse') }}" class="btn btn-primary shadow-sm rounded-pill px-4">Pinjam Buku Lagi</a>
    </div>

    <div class="row g-4">
        @forelse($loans as $loan)
            <div class="col-md-6 col-lg-4">
                <div class="card glass-card border-0 shadow-sm h-100 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge {{ $loan->status === 'aktif' ? 'bg-warning' : ($loan->status === 'kembali' ? 'bg-success' : 'bg-danger') }} rounded-pill px-3">
                                {{ strtoupper($loan->status) }}
                            </span>
                            <small class="text-muted fw-bold">#{{ $loan->id }}</small>
                        </div>
                        
                        <h5 class="fw-bold mb-1">{{ $loan->book->title }}</h5>
                        <p class="small text-muted mb-4">Penulis: {{ $loan->book->author->name }}</p>

                        <div class="bg-light rounded-3 p-3 mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small text-muted">Tanggal Pinjam:</span>
                                <span class="small fw-bold">{{ \Carbon\Carbon::parse($loan->borrowed_at)->format('d M Y') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small text-muted">Jatuh Tempo:</span>
                                <span class="small fw-bold text-danger">{{ \Carbon\Carbon::parse($loan->due_at)->format('d M Y') }}</span>
                            </div>
                            @if($loan->returned_at)
                                <div class="d-flex justify-content-between border-top pt-2 mt-2">
                                    <span class="small text-muted">Dikembalikan:</span>
                                    <span class="small fw-bold text-success">{{ \Carbon\Carbon::parse($loan->returned_at)->format('d M Y') }}</span>
                                </div>
                            @endif
                        </div>

                        @if($loan->fine_amount > 0 || $loan->damage_fee > 0)
                            <div class="alert bg-danger bg-opacity-10 border-0 mb-0">
                                <div class="d-flex justify-content-between small text-danger">
                                    <span>Total Denda & Biaya:</span>
                                    <span class="fw-bold">Rp {{ number_format($loan->fine_amount + $loan->damage_fee, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 opacity-50">
                <i class="bi bi-journal-x display-1"></i>
                <h4 class="mt-3">Kamu belum pernah meminjam buku.</h4>
                <p>Silakan jelajahi koleksi kami untuk mulai meminjam.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
