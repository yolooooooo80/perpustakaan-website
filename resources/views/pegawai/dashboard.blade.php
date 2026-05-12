@extends('layouts.app')

@section('page_title', 'Dashboard Petugas Perpustakaan')

@section('content')
<div class="fade-in">
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card glass-card p-4 border-0 h-100 shadow-sm" style="border-left: 5px solid #0dcaf0 !important;">
                <h6 class="fw-bold text-muted small">TOTAL KOLEKSI</h6>
                <h2 class="fw-black text-dark mb-0">{{ $stats['totalBooks'] }}</h2>
                <i class="bi bi-book position-absolute top-50 end-0 translate-middle opacity-10 display-4"></i>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card glass-card p-4 border-0 h-100 shadow-sm" style="border-left: 5px solid var(--p-purple) !important;">
                <h6 class="fw-bold text-muted small">PINJAMAN AKTIF</h6>
                <h2 class="fw-black text-primary mb-0" style="color: var(--p-purple) !important;">{{ $stats['activeLoans'] }}</h2>
                <i class="bi bi-journal-check position-absolute top-50 end-0 translate-middle opacity-10 display-4"></i>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card glass-card p-4 border-0 h-100 shadow-sm" style="border-left: 5px solid #dc3545 !important;">
                <h6 class="fw-bold text-muted small">OVERDUE (TELAT)</h6>
                <h2 class="fw-black text-danger mb-0">{{ $stats['overdueLoans'] }}</h2>
                <i class="bi bi-exclamation-triangle position-absolute top-50 end-0 translate-middle opacity-10 display-4"></i>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Kelola Peminjaman & Denda -->
        <div class="col-md-8">
            <div class="card glass-card border-0 shadow-sm p-4 mb-4">
                <h5 class="fw-bold mb-4 text-primary-ngawi"><i class="bi bi-pencil-square me-2"></i> Update Pengembalian & Denda</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr class="bg-light">
                                <th class="px-3">Siswa</th>
                                <th>Buku</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingActions as $loan)
                            <tr>
                                <td class="px-3">
                                    <div class="fw-bold small text-dark">{{ $loan->user->name }}</div>
                                    <div class="x-small {{ \Carbon\Carbon::parse($loan->due_at)->isPast() ? 'text-danger fw-bold' : 'text-muted' }}">
                                        Batas: {{ \Carbon\Carbon::parse($loan->due_at)->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td class="small">{{ $loan->book->title }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-p rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalReturn{{ $loan->id }}">
                                        PROSES
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Return & Fine (Light Style) -->
                            <div class="modal fade" id="modalReturn{{ $loan->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg" style="border-radius: 25px;">
                                        <div class="modal-header border-0 bg-primary text-white py-3 px-4" style="background-color: var(--p-purple) !important;">
                                            <h5 class="modal-title fw-bold">Pembaruan Peminjaman</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('staff.loans.update-fine', $loan->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body p-4">
                                                <div class="mb-3">
                                                    <label class="small fw-bold mb-1">Pilih Status Baru</label>
                                                    <select name="status" class="form-select border-0 bg-light" required>
                                                        <option value="kembali">KEMBALI (NORMAL)</option>
                                                        <option value="rusak">RUSAK / HILANG</option>
                                                        <option value="aktif">TETAP PINJAM</option>
                                                    </select>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-6">
                                                        <label class="small fw-bold mb-1">Denda Telat (Rp)</label>
                                                        <input type="number" name="fine_amount" class="form-control border-0 bg-light" value="{{ $loan->fine_amount ?? 0 }}">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="small fw-bold mb-1">Denda Rusak (Rp)</label>
                                                        <input type="number" name="damage_fee" class="form-control border-0 bg-light" placeholder="0">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="small fw-bold mb-1">Catatan</label>
                                                    <textarea name="notes" class="form-control border-0 bg-light" rows="2" placeholder="Keterangan tambahan..."></textarea>
                                                </div>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input" type="checkbox" name="notify" value="1" checked id="notify{{ $loan->id }}">
                                                    <label class="form-check-label small fw-bold" for="notify{{ $loan->id }}">Kirim Notifikasi Otomatis via Chat</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0 p-4 pt-0">
                                                <button type="submit" class="btn btn-p w-100 py-2 shadow">SIMPAN & BERITAHU SISWA</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Aturan Kategori -->
        <div class="col-md-4">
            <div class="card glass-card border-0 shadow-sm p-4 mb-4">
                <h5 class="fw-bold mb-4 text-primary-ngawi"><i class="bi bi-gear-fill me-2"></i> Konfigurasi Pinjaman</h5>
                @foreach($categories as $cat)
                <div class="mb-4 pb-3 border-bottom">
                    <form action="{{ route('staff.categories.update', $cat->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="name" value="{{ $cat->name }}">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-bold text-dark small text-uppercase">{{ $cat->name }}</span>
                            <button type="submit" class="btn btn-sm btn-link text-primary p-0 fw-bold x-small">UPDATE</button>
                        </div>
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="input-group input-group-sm">
                                    <input type="number" name="loan_duration_days" class="form-control border-0 bg-light" value="{{ $cat->loan_duration_days }}">
                                    <span class="input-group-text border-0 bg-light x-small">Hr</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text border-0 bg-light x-small">Rp</span>
                                    <input type="number" name="fine_per_day" class="form-control border-0 bg-light" value="{{ $cat->fine_per_day }}">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @endforeach
            </div>

            <div class="card border-0 shadow-sm p-4 text-white" style="background: var(--p-purple); border-radius: 20px;">
                <h5 class="fw-bold mb-3"><i class="bi bi-chat-dots-fill me-2"></i> Q&A Siswa</h5>
                <p class="small opacity-75">Respon pertanyaan atau kendala dari siswa seputar perpustakaan.</p>
                <a href="{{ route('chat.index') }}" class="btn btn-s w-100 mt-2 shadow">BUKA CHAT</a>
            </div>
        </div>
    </div>
</div>
@endsection
