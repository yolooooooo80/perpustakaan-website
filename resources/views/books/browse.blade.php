@extends('layouts.app')

@section('page_title', 'Katalog Buku Digital')

@section('content')
<div class="fade-in">
    <!-- Filter & Pencarian -->
    <div class="card glass-card border-0 shadow-sm p-4 mb-5">
        <form action="{{ route('books.browse') }}" method="GET" class="row g-3">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 ps-3"><i class="bi bi-search text-primary"></i></span>
                    <input type="text" name="search" class="form-control border-0 bg-light" placeholder="Cari judul buku atau penulis..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-4">
                <select name="category" class="form-select border-0 bg-light">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-p w-100 shadow">CARI SEKARANG</button>
            </div>
        </form>
    </div>

    <!-- Grid Buku -->
    <div class="row g-4">
        @forelse($books as $book)
        <div class="col-md-3 col-sm-6">
            <div class="card glass-card border-0 h-100 overflow-hidden shadow-sm">
                <div class="position-relative" style="height: 350px;">
                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $book->title }}">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center h-100 text-primary">
                            <i class="bi bi-book display-1 opacity-10"></i>
                        </div>
                    @endif
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-primary rounded-pill px-3 py-2 shadow-sm" style="background-color: var(--p-purple) !important;">{{ $book->category->name }}</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <h6 class="fw-bold text-dark mb-1 text-truncate" title="{{ $book->title }}">{{ $book->title }}</h6>
                    <p class="small text-muted mb-3">Oleh: <span class="fw-bold">{{ $book->author->name }}</span></p>
                    
                    <div class="d-flex justify-content-between align-items-center mt-auto">
                        <div>
                            <span class="badge {{ $book->stock > 0 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} rounded-pill px-3">
                                {{ $book->stock > 0 ? 'Tersedia: ' . $book->stock : 'Stok Habis' }}
                            </span>
                        </div>
                        @auth
                        <form action="{{ route('books.borrow', $book->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-s fw-black {{ $book->stock <= 0 ? 'disabled' : '' }}">
                                PINJAM
                            </button>
                        </form>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="bi bi-search display-1 text-muted opacity-25"></i>
            <h4 class="mt-4 text-muted">Buku yang kamu cari tidak ditemukan.</h4>
            <a href="{{ route('books.browse') }}" class="btn btn-outline-primary mt-3 rounded-pill">Reset Pencarian</a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
