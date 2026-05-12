@extends('layouts.app')

@section('title', 'Manajemen Kategori')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary-custom mb-0"><i class="bi bi-tags-fill me-2"></i> Manajemen Kategori</h3>
        <a href="{{ route('staff.categories.create') }}" class="btn btn-primary shadow-sm"><i class="bi bi-plus-lg me-1"></i> Tambah Kategori</a>
    </div>

    <div class="card glass-card border-0 shadow-lg overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="px-4 py-3">Nama Kategori</th>
                        <th class="px-4 py-3">Jumlah Koleksi</th>
                        <th class="px-4 py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($categories as $category)
                        <tr>
                            <td class="px-4 py-3 fw-bold">{{ $category->name }}</td>
                            <td class="px-4 py-3 small text-muted">{{ $category->books_count ?? 0 }} Buku</td>
                            <td class="px-4 py-3 text-end">
                                <div class="btn-group">
                                    <a href="{{ route('staff.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('staff.categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted">Belum ada data kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
