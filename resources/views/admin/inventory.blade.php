@extends('layouts.app')

@section('content')
<div class="fade-in">
    <div class="text-center mb-5">
        <h2 class="fw-black text-primary-ngawi display-5 mb-2">MANAJEMEN <span class="text-accent-ngawi">INVENTARIS</span></h2>
        <p class="text-muted">Pencatatan riwayat buku masuk dan keluar Ngawi Perpustakaan.</p>
        <div class="mx-auto bg-warning rounded-pill" style="width: 80px; height: 6px;"></div>
    </div>

    <div class="row g-4">
        <!-- Form Input -->
        <div class="col-md-4">
            <div class="card glass-card border-0 shadow-sm p-4 sticky-top" style="top: 100px;">
                <h5 class="fw-bold mb-4 text-primary-ngawi"><i class="bi bi-plus-circle-fill me-2"></i> Catat Log Baru</h5>
                <form action="{{ route('admin.inventory.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Pilih Buku</label>
                        <select name="book_id" class="form-select border-0 bg-light" required>
                            @foreach($books as $book)
                                <option value="{{ $book->id }}">{{ $book->title }} (Stok: {{ $book->stock }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Jenis Transaksi</label>
                        <select name="type" class="form-select border-0 bg-light" required>
                            <option value="in">BUKU MASUK (+)</option>
                            <option value="out">BUKU KELUAR (-)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Jumlah</label>
                        <input type="number" name="quantity" class="form-control border-0 bg-light" required min="1">
                    </div>
                    <div class="mb-4">
                        <label class="small fw-bold mb-1">Catatan</label>
                        <textarea name="note" class="form-control border-0 bg-light" rows="3" placeholder="Contoh: Pengadaan baru, Buku rusak, dll"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold py-2 shadow">SIMPAN LOG</button>
                </form>
            </div>
        </div>

        <!-- Tabel Log -->
        <div class="col-md-8">
            <div class="card glass-card border-0 shadow-sm overflow-hidden">
                <div class="card-header bg-primary text-white p-4 border-0">
                    <h5 class="fw-bold mb-0">Riwayat Transaksi Inventaris</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4">Waktu</th>
                                <th>Buku</th>
                                <th class="text-center">Aksi</th>
                                <th class="text-center">Qty</th>
                                <th>Admin/Staff</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                            <tr>
                                <td class="px-4 small">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="fw-bold small">{{ $log->book->title }}</div>
                                    <div class="x-small text-muted">{{ $log->note ?? '-' }}</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $log->type == 'in' ? 'bg-success' : 'bg-danger' }} rounded-pill px-3">
                                        {{ $log->type == 'in' ? 'MASUK' : 'KELUAR' }}
                                    </span>
                                </td>
                                <td class="text-center fw-black {{ $log->type == 'in' ? 'text-success' : 'text-danger' }}">
                                    {{ $log->type == 'in' ? '+' : '-' }}{{ $log->quantity }}
                                </td>
                                <td class="small fw-bold">{{ $log->user->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4 bg-light border-top">
                    {{ $logs->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
