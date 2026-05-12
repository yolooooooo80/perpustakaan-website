@extends('layouts.app')

@section('title', 'Manajemen Q&A')

@section('content')
<div class="row g-4 fade-in">
    <div class="col-md-4">
        <div class="card glass-card border-0 shadow-lg h-100">
            <div class="card-header bg-dark text-white py-3">
                <h5 class="mb-0 fw-bold">Daftar Chat Siswa</h5>
            </div>
            <div class="list-group list-group-flush chat-list" style="max-height: 500px; overflow-y: auto;">
                @forelse($visitors as $visitor)
                    <a href="{{ route('chat.index', ['visitor_id' => $visitor->id]) }}" class="list-group-item list-group-item-action py-3 {{ $selectedVisitorId == $visitor->id ? 'bg-primary bg-opacity-10 border-start border-primary border-4' : '' }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fw-bold">{{ $visitor->name }}</h6>
                            <span class="badge bg-secondary rounded-pill small">Siswa</span>
                        </div>
                    </a>
                @empty
                    <div class="p-4 text-center text-muted opacity-50">Belum ada chat masuk.</div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-md-8">
        @if($selectedVisitorId)
            <div class="card glass-card border-0 shadow-lg h-100">
                <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-chat-dots me-2"></i> Chat dengan {{ $visitors->where('id', $selectedVisitorId)->first()->name }}</h5>
                </div>
                <div class="card-body p-0">
                    <div class="chat-container d-flex flex-column p-4" id="chatArea">
                        @foreach($messages as $msg)
                            <div class="bubble {{ $msg->sender_id == Auth::id() ? 'bubble-sent' : 'bubble-received' }}">
                                <div>{{ $msg->message }}</div>
                                <div class="text-end small opacity-50 mt-1" style="font-size: 0.7rem;">{{ $msg->created_at->format('H:i') }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer bg-light p-3 border-0">
                    <form action="{{ route('chat.send') }}" method="POST">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $selectedVisitorId }}">
                        <div class="input-group">
                            <input type="text" name="message" class="form-control border-0 shadow-sm" placeholder="Balas pesan siswa..." required>
                            <button class="btn btn-primary px-4" type="submit"><i class="bi bi-send"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="card glass-card border-0 shadow-lg h-100 d-flex align-items-center justify-content-center text-center p-5 opacity-50">
                <div>
                    <i class="bi bi-chat-left-text display-1"></i>
                    <h4 class="mt-3">Pilih percakapan untuk memulai</h4>
                </div>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    const chatArea = document.getElementById('chatArea');
    if (chatArea) chatArea.scrollTop = chatArea.scrollHeight;
</script>
@endpush
@endsection
