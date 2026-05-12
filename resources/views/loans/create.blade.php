@extends('layouts.app')

@section('title', 'Pinjam Buku')

@section('content')
<div class="row justify-content-center fade-in">
    <div class="col-md-6">
        <div class="card glass-card shadow-lg border-0">
            <div class="card-header bg-primary bg-gradient text-white">
                <h3 class="mb-0">Form Peminjaman</h3>
            </div>
            <div class="card-body p-4">
                <div class="mb-4 d-flex align-items-center">
                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover" class="me-3" style="height: 100px; border-radius: 8px;">
                    @endif
                    <div>
                        <h4 class="mb-1">{{ $book->title }}</h4>
                        <p class="text-muted mb-0">Penulis: {{ $book->author->name }}</p>
                        <p class="text-muted mb-0">Kategori: {{ $book->category->name }}</p>
                        <p class="mb-0"><span class="badge {{ $book->stock > 0 ? 'bg-success' : 'bg-danger' }}">Stok: {{ $book->stock }}</span></p>
                    </div>
                </div>

                @if($book->stock > 0)
                    <form action="{{ route('loans.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        
                        <div class="mb-4">
                            <label for="due_at" class="form-label">Tanggal Jatuh Tempo (Pengembalian)</label>
                            <input type="date" class="form-control bg-dark text-white border-secondary @error('due_at') is-invalid @enderror" id="due_at" name="due_at" value="{{ old('due_at', \Carbon\Carbon::today()->addDays(7)->toDateString()) }}" required min="{{ \Carbon\Carbon::tomorrow()->toDateString() }}">
                            <div class="form-text text-muted">Buku harus dikembalikan sebelum tanggal ini.</div>
                            @error('due_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('books.browse') }}" class="btn btn-outline-light">Batal</a>
                            <button type="submit" class="btn btn-primary px-5">Pinjam Sekarang</button>
                        </div>
                    </form>
                @else
                    <div class="text-center py-5">
                        <p class="text-warning">Maaf, buku ini tidak tersedia untuk dipinjam.</p>
                        <a href="{{ route('books.browse') }}" class="btn btn-outline-light">Kembali ke Daftar Buku</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
