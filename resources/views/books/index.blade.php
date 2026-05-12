@extends('layouts.app')

@section('content')
<div class="fade-in">
    <div class="text-center mb-5">
        <h2 class="fw-black text-primary-ngawi display-5 mb-2">KELOLA <span class="text-accent-ngawi">BUKU</span></h2>
        <p class="text-muted">Manajemen database koleksi buku Ngawi Perpustakaan.</p>
        <div class="mx-auto bg-warning rounded-pill" style="width: 80px; height: 6px;"></div>
    </div>

    <div class="card glass-card border-0 shadow-sm overflow-hidden">
        <div class="card-header bg-primary text-white p-4 border-0 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0"><i class="bi bi-journal-text me-2"></i> Daftar Koleksi Buku</h5>
            <a href="{{ route('staff.books.create') }}" class="btn btn-warning fw-bold rounded-pill shadow-sm">
                <i class="bi bi-plus-lg me-2"></i> TAMBAH BUKU
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3">Buku</th>
                        <th class="py-3">Kategori</th>
                        <th class="py-3">Penulis</th>
                        <th class="py-3 text-center">Stok</th>
                        <th class="py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="d-flex align-items-center">
                                @if($book->cover_image)
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" class="rounded-3 me-3" style="width: 45px; height: 60px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded-3 me-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 60px;">
                                        <i class="bi bi-book opacity-25"></i>
                                    </div>
                                @endif
                                <div class="fw-bold text-dark">{{ $book->title }}</div>
                            </div>
                        </td>
                        <td class="py-3">
                            <span class="badge bg-primary-ngawi rounded-pill px-3">{{ $book->category->name }}</span>
                        </td>
                        <td class="py-3 small">{{ $book->author->name }}</td>
                        <td class="py-3 text-center">
                            <span class="fw-black {{ $book->stock < 5 ? 'text-danger' : 'text-primary' }}">{{ $book->stock }}</span>
                        </td>
                        <td class="py-3 text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('staff.books.edit', $book->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">EDIT</a>
                                <form action="{{ route('staff.books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Hapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">HAPUS</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 bg-light border-top">
            {{ $books->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
