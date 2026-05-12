@extends('layouts.app')

@section('page_title', 'Katalog Buku Digital')

@section('content')
<style>
    /* Cinematic Book Card Style for Browse */
    .book-cinematic-card {
        position: relative;
        height: 450px;
        border-radius: 25px;
        overflow: hidden;
        display: block;
        text-decoration: none;
        transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }

    .book-cinematic-card:hover {
        transform: scale(1.03) translateY(-10px);
        box-shadow: 0 25px 50px rgba(74, 20, 140, 0.2);
    }

    .book-card-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 0.8s;
    }

    .book-cinematic-card:hover .book-card-image {
        transform: scale(1.15);
    }

    .book-card-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 30px 20px;
        background: linear-gradient(transparent, rgba(0,0,0,0.95));
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }

    .book-card-category {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(74, 20, 140, 0.8);
        backdrop-filter: blur(5px);
        padding: 6px 15px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        color: white;
        border: 1px solid rgba(255,255,255,0.2);
    }

    .book-card-title { font-weight: 800; font-size: 1.2rem; margin-bottom: 5px; line-height: 1.2; color: #fff; }
    .book-card-author { font-size: 0.85rem; opacity: 0.8; margin-bottom: 15px; color: rgba(255,255,255,0.8); }
    
    .book-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid rgba(255,255,255,0.1);
        padding-top: 15px;
    }
</style>

<div class="fade-in">
    <!-- Filter & Pencarian -->
    <div class="card glass-card border-0 shadow-sm p-4 mb-5">
        <form action="{{ route('books.browse') }}" method="GET" class="row g-3">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 ps-3"><i class="bi bi-search text-primary"></i></span>
                    <input type="text" name="search" class="form-control border-0 bg-light" placeholder="Cari judul atau penulis..." value="{{ request('search') }}">
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

    <!-- Grid Buku (Cinematic Style) -->
    <div class="row g-4">
        @forelse($books as $book)
        <div class="col-lg-3 col-md-6">
            <div class="book-cinematic-card">
                @if($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}" class="book-card-image" alt="{{ $book->title }}">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center h-100">
                        <i class="bi bi-book display-1 opacity-10" style="color: var(--p-purple);"></i>
                    </div>
                @endif
                
                <div class="book-card-category">{{ $book->category->name }}</div>
                
                <div class="book-card-overlay">
                    <h5 class="book-card-title">{{ $book->title }}</h5>
                    <p class="book-card-author">{{ $book->author->name }}</p>
                    <div class="book-card-footer">
                        <span class="badge {{ $book->stock > 0 ? 'bg-success' : 'bg-danger' }} rounded-pill">
                            {{ $book->stock > 0 ? 'Tersedia' : 'Habis' }}
                        </span>
                        @auth
                        <form action="{{ route('books.borrow', $book->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-warning rounded-pill fw-black {{ $book->stock <= 0 ? 'disabled' : '' }}">
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
            <h4 class="mt-4 text-muted">Buku tidak ditemukan.</h4>
            <a href="{{ route('books.browse') }}" class="btn btn-outline-primary mt-3 rounded-pill">Reset</a>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
