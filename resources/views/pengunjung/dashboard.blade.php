@extends('layouts.app')

@section('page_title', 'Selamat Datang di Ngawi Perpus')

@section('content')
<div class="fade-in">
    <!-- Quick Actions -->
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 text-white h-100" style="background: linear-gradient(135deg, var(--p-purple), #7b1fa2); border-radius: 25px;">
                <h3 class="fw-black mb-2">Halo, {{ Auth::user()->name }}!</h3>
                <p class="opacity-75 mb-4">Mau baca apa hari ini? Ribuan koleksi buku digital sudah menunggu Anda.</p>
                <div class="d-flex gap-2">
                    <a href="{{ route('books.browse') }}" class="btn btn-s shadow px-4">PINJAM BUKU</a>
                    <a href="{{ route('chat.index') }}" class="btn btn-outline-light rounded-pill px-4">TANYA PETUGAS</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card glass-card border-0 shadow-sm p-4 h-100 d-flex flex-row align-items-center">
                <div class="bg-primary-subtle p-4 rounded-4 me-4" style="background: rgba(74, 20, 140, 0.1);">
                    <i class="bi bi-clock-history fs-1" style="color: var(--p-purple);"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-1">Riwayat & Status</h5>
                    <p class="text-muted small mb-0">Pantau buku yang sedang Anda pinjam dan riwayat pengembalian.</p>
                    <a href="{{ route('loans.mine') }}" class="fw-bold text-decoration-none small mt-2 d-inline-block" style="color: var(--p-purple);">LIHAT DETAIL <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Pinjaman Aktif -->
        <div class="col-md-4">
            <div class="card glass-card border-0 shadow-sm p-4 h-100">
                <h5 class="fw-bold mb-4 text-primary-ngawi"><i class="bi bi-journal-bookmark-fill me-2"></i> Buku Saya</h5>
                @forelse($myActiveLoans as $loan)
                <div class="card bg-light border-0 p-3 mb-3 rounded-4">
                    <div class="d-flex align-items-center mb-2">
                        <div class="bg-white p-2 rounded-3 me-3 shadow-sm">
                            <i class="bi bi-journal-text fs-5 text-primary"></i>
                        </div>
                        <div class="overflow-hidden">
                            <h6 class="mb-0 fw-bold text-truncate small text-dark">{{ $loan->book->title }}</h6>
                            <span class="x-small text-muted">Batas Kembali: {{ \Carbon\Carbon::parse($loan->due_at)->format('d M Y') }}</span>
                        </div>
                    </div>
                    @if(\Carbon\Carbon::parse($loan->due_at)->isPast())
                        <div class="alert alert-danger x-small py-1 mb-0 mt-2 fw-bold rounded-pill text-center">
                            SUDAH TERLAMBAT!
                        </div>
                    @endif
                </div>
                @empty
                <div class="text-center py-5 opacity-25">
                    <i class="bi bi-journals display-4 d-block mb-2"></i>
                    <p class="small">Kosong.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Rekomendasi -->
        <div class="col-md-8">
            <div class="card glass-card border-0 shadow-sm p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0 text-primary-ngawi"><i class="bi bi-stars me-2"></i> Rekomendasi Buku</h5>
                    <a href="{{ route('books.browse') }}" class="small fw-bold text-decoration-none" style="color: var(--p-purple);">Lihat Semua</a>
                </div>
                <div class="row g-3">
                    @foreach($recommendations as $book)
                    <div class="col-md-4">
                        <div class="card border-0 bg-white shadow-sm h-100 rounded-4 overflow-hidden border">
                            <div style="height: 150px; overflow: hidden;">
                                @if($book->cover_image)
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $book->title }}">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center h-100">
                                        <i class="bi bi-book opacity-10"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body p-3">
                                <h6 class="fw-bold mb-1 text-truncate small text-dark">{{ $book->title }}</h6>
                                <p class="x-small text-muted mb-2">{{ $book->author->name }}</p>
                                <form action="{{ route('books.borrow', $book->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-p w-100 x-small rounded-pill {{ $book->stock <= 0 ? 'disabled' : '' }}">PINJAM</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Denda -->
    @if($myFineTotal > 0)
    <div class="alert mt-4 border-0 p-4 d-flex align-items-center" style="background: #fff5f5; border-radius: 25px; border-left: 8px solid #dc3545 !important;">
        <i class="bi bi-exclamation-octagon-fill fs-1 text-danger me-4"></i>
        <div>
            <h5 class="fw-black text-danger mb-1">PEMBERITAHUAN DENDA</h5>
            <p class="mb-0 text-dark">Anda memiliki total denda <strong class="fs-4">Rp {{ number_format($myFineTotal) }}</strong>. Silakan selesaikan administrasi di perpustakaan.</p>
        </div>
        <a href="{{ route('chat.index') }}" class="btn btn-danger ms-auto fw-bold rounded-pill px-4">KONFIRMASI VIA CHAT</a>
    </div>
    @endif
</div>
@endsection
