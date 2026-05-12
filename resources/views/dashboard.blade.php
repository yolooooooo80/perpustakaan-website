@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="fade-in">
    <div class="row mb-5">
        <div class="col-md-12">
            <h3 class="widget-title">Statistik Perpustakaan</h3>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 text-center h-100 py-3">
                <div class="card-body">
                    <div class="display-4 text-primary-custom mb-2"><i class="bi bi-bookshelf"></i></div>
                    <h5 class="text-muted small text-uppercase fw-bold mb-1">Total Buku</h5>
                    <h2 class="fw-bold mb-0">{{ $totalBooks }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 text-center h-100 py-3">
                <div class="card-body">
                    <div class="display-4 text-success mb-2"><i class="bi bi-people"></i></div>
                    <h5 class="text-muted small text-uppercase fw-bold mb-1">Total Penulis</h5>
                    <h2 class="fw-bold mb-0">{{ $totalAuthors }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 text-center h-100 py-3">
                <div class="card-body">
                    <div class="display-4 text-warning mb-2"><i class="bi bi-tags"></i></div>
                    <h5 class="text-muted small text-uppercase fw-bold mb-1">Total Kategori</h5>
                    <h2 class="fw-bold mb-0">{{ $totalCategories }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 text-center h-100 py-3">
                <div class="card-body">
                    <div class="display-4 text-danger mb-2"><i class="bi bi-journal-check"></i></div>
                    <h5 class="text-muted small text-uppercase fw-bold mb-1">Sedang Dipinjam</h5>
                    <h2 class="fw-bold mb-0">{{ $activeLoans }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mb-4">
            <h3 class="widget-title">Layanan & Informasi</h3>
            <div class="card p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-start mb-4">
                            <div class="bg-primary-custom text-white p-3 rounded-3 me-3">
                                <i class="bi bi-search fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold">Pencarian Koleksi</h5>
                                <p class="text-muted small">Cari buku favoritmu di koleksi OPAC kami yang lengkap.</p>
                                <a href="{{ route('staff.books.index') }}" class="btn btn-sm btn-primary">Cari Sekarang</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start mb-4">
                            <div class="bg-success text-white p-3 rounded-3 me-3">
                                <i class="bi bi-clock-history fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold">Riwayat Pinjam</h5>
                                <p class="text-muted small">Pantau status pengembalian buku yang kamu pinjam.</p>
                                <a href="{{ route('staff.loans.index') }}" class="btn btn-sm btn-success text-white">Lihat Riwayat</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <h3 class="widget-title">Tentang Kami</h3>
            <div class="card p-4 bg-primary-custom text-white border-0 shadow-lg">
                <p class="small mb-3">Nelas Library merupakan Perpustakaan yang berada dibawah naungan SMA Negeri 11 Kota Tangerang Selatan.</p>
                <p class="small mb-4">Perpustakaan ini melakukan pelayanan untuk seluruh civitas SMA Negeri 11 Kota Tangerang Selatan.</p>
                <div class="d-grid">
                    <button class="btn btn-light text-primary fw-bold">Hubungi Kami</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
