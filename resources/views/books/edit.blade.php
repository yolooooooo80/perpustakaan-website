@extends('layouts.app')

@section('title', 'Edit Koleksi')

@section('content')
<div class="row justify-content-center fade-in">
    <div class="col-md-8">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header bg-primary text-white py-4 rounded-top-4">
                <h4 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i> Edit Informasi Buku</h4>
            </div>
            <div class="card-body p-4 p-lg-5 bg-white rounded-bottom-4">
                <form action="{{ route('staff.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="title" class="form-label text-muted small fw-bold">Judul Buku</label>
                        <input type="text" class="form-control bg-light border-0 py-2" id="title" name="title" value="{{ old('title', $book->title) }}" required placeholder="Masukkan judul buku lengkap">
                        @error('title')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="author_id" class="form-label text-muted small fw-bold">Penulis</label>
                            <select class="form-select bg-light border-0 py-2" id="author_id" name="author_id" required>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category_id" class="form-label text-muted small fw-bold">Kategori</label>
                            <select class="form-select bg-light border-0 py-2" id="category_id" name="category_id" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="isbn" class="form-label text-muted small fw-bold">ISBN</label>
                            <input type="text" class="form-control bg-light border-0 py-2" id="isbn" name="isbn" value="{{ old('isbn', $book->isbn) }}" placeholder="Contoh: 978-602-...">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="stock" class="form-label text-muted small fw-bold">Stok Tersedia</label>
                            <input type="number" class="form-control bg-light border-0 py-2" id="stock" name="stock" value="{{ old('stock', $book->stock) }}" required min="0">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="cover_image" class="form-label text-muted small fw-bold">Unggah Gambar Sampul Baru</label>
                        @if($book->cover_image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover" class="rounded shadow-sm" style="height: 120px; object-fit: cover;">
                                <div class="small text-muted mt-1">Sampul saat ini</div>
                            </div>
                        @endif
                        <input type="file" class="form-control bg-light border-0 py-2" id="cover_image" name="cover_image" accept="image/*">
                        <div class="form-text small">Biarkan kosong jika tidak ingin mengubah sampul.</div>
                    </div>

                    <hr class="my-4 opacity-50">

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('staff.books.index') }}" class="text-muted text-decoration-none small fw-bold"><i class="bi bi-arrow-left me-1"></i> Kembali ke Koleksi</a>
                        <button type="submit" class="btn btn-primary px-5 py-3 rounded-3 fw-bold shadow">
                            PERBARUI INFORMASI <i class="bi bi-check-circle ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
