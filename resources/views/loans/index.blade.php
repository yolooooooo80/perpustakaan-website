@extends('layouts.app')

@section('content')
<div class="fade-in">
    <div class="text-center mb-5">
        <h2 class="fw-black text-primary-ngawi display-5 mb-2">MONITOR <span class="text-accent-ngawi">SIRKULASI</span></h2>
        <p class="text-muted">Pantau status peminjaman, pengembalian, dan denda buku secara real-time.</p>
        <div class="mx-auto bg-warning rounded-pill" style="width: 80px; height: 6px;"></div>
    </div>

    <div class="card glass-card border-0 shadow-sm overflow-hidden">
        <div class="card-header bg-primary text-white p-4 border-0">
            <h5 class="fw-bold mb-0"><i class="bi bi-journal-check me-2"></i> Daftar Peminjaman Aktif & Selesai</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3">Peminjam</th>
                        <th class="py-3">Buku</th>
                        <th class="py-3">Tgl Pinjam / Tempo</th>
                        <th class="py-3 text-center">Status</th>
                        <th class="py-3">Denda & Kerusakan</th>
                        <th class="py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($loans as $loan)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="fw-bold text-dark">{{ $loan->user->name }}</div>
                            <div class="x-small text-muted">{{ $loan->user->email }}</div>
                        </td>
                        <td class="py-3">
                            <div class="fw-bold small">{{ $loan->book->title }}</div>
                            <span class="badge bg-light text-primary x-small">{{ $loan->book->category->name }}</span>
                        </td>
                        <td class="py-3 small">
                            <div>Pinjam: <span class="fw-bold">{{ \Carbon\Carbon::parse($loan->borrowed_at)->format('d/m/y') }}</span></div>
                            <div class="text-danger">Tempo: <span class="fw-bold">{{ \Carbon\Carbon::parse($loan->due_at)->format('d/m/y') }}</span></div>
                        </td>
                        <td class="py-3 text-center">
                            <span class="badge rounded-pill px-3 py-2 {{ $loan->status === 'kembali' ? 'bg-success' : ($loan->status === 'rusak' ? 'bg-danger' : 'bg-warning') }}">
                                {{ strtoupper($loan->status) }}
                            </span>
                        </td>
                        <td class="py-3 small">
                            <div class="fw-bold text-danger">Denda: Rp {{ number_format($loan->fine_amount) }}</div>
                            <div class="text-muted">Rusak: Rp {{ number_format($loan->damage_fee) }}</div>
                        </td>
                        <td class="py-3 text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#editFineModal{{ $loan->id }}">
                                    UPDATE
                                </button>
                                
                                @if(!$loan->returned_at)
                                    <form action="{{ route('staff.loans.return', $loan->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 fw-bold">
                                            KEMBALI
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Update Fine -->
                    <div class="modal fade" id="editFineModal{{ $loan->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 glass-card">
                                <div class="modal-header bg-primary text-white border-0">
                                    <h5 class="modal-title fw-bold">Update Status & Denda</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('staff.loans.update-fine', $loan->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-body p-4">
                                        <div class="mb-3">
                                            <label class="small fw-bold mb-1">Denda Keterlambatan (Rp)</label>
                                            <input type="number" name="fine_amount" class="form-control border-0 bg-light" value="{{ $loan->fine_amount }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="small fw-bold mb-1">Biaya Kerusakan (Rp)</label>
                                            <input type="number" name="damage_fee" class="form-control border-0 bg-light" value="{{ $loan->damage_fee }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="small fw-bold mb-1">Status Peminjaman</label>
                                            <select name="status" class="form-select border-0 bg-light" required>
                                                <option value="aktif" {{ $loan->status == 'aktif' ? 'selected' : '' }}>AKTIF</option>
                                                <option value="kembali" {{ $loan->status == 'kembali' ? 'selected' : '' }}>KEMBALI</option>
                                                <option value="rusak" {{ $loan->status == 'rusak' ? 'selected' : '' }}>RUSAK</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="small fw-bold mb-1">Catatan</label>
                                            <textarea name="notes" class="form-control border-0 bg-light" rows="2">{{ $loan->notes }}</textarea>
                                        </div>
                                        <div class="form-check form-switch mb-0">
                                            <input class="form-check-input" type="checkbox" name="notify" value="1" checked id="notify{{ $loan->id }}">
                                            <label class="form-check-label small fw-bold" for="notify{{ $loan->id }}">Kirim Notifikasi Chat ke Siswa</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0 p-4 pt-0">
                                        <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold py-2 shadow">SIMPAN PERUBAHAN</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted opacity-50">
                            <i class="bi bi-journal-x display-1 mb-3 d-block"></i>
                            Belum ada data peminjaman yang tercatat.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 bg-light border-top">
            {{ $loans->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
