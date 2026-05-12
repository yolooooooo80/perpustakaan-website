@extends('layouts.app')

@section('title', 'Manajemen Penulis')

@section('content')
<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary-custom mb-0"><i class="bi bi-person-lines-fill me-2"></i> Manajemen Penulis</h3>
        <a href="{{ route('staff.authors.create') }}" class="btn btn-primary shadow-sm"><i class="bi bi-plus-lg me-1"></i> Tambah Penulis</a>
    </div>

    <div class="card glass-card border-0 shadow-lg overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="px-4 py-3">Nama Penulis</th>
                        <th class="px-4 py-3">Total Karya</th>
                        <th class="px-4 py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($authors as $author)
                        <tr>
                            <td class="px-4 py-3 fw-bold">{{ $author->name }}</td>
                            <td class="px-4 py-3 small text-muted">{{ $author->books_count ?? 0 }} Koleksi</td>
                            <td class="px-4 py-3 text-end">
                                <div class="btn-group">
                                    <a href="{{ route('staff.authors.edit', $author->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('staff.authors.destroy', $author->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus penulis ini?')">
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
                            <td colspan="3" class="text-center py-5 text-muted">Belum ada data penulis.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">
        {{ $authors->links() }}
    </div>
</div>
@endsection
