@extends('layouts.app')

@section('content')
<div class="fade-in">
    <div class="row g-4">
        <!-- Sidebar Daftar Chat -->
        <div class="col-md-4">
            <div class="card glass-card border-0 shadow-sm h-100">
                <div class="card-header bg-primary text-white p-4 border-0">
                    <h5 class="fw-bold mb-0"><i class="bi bi-people-fill me-2"></i> Percakapan Aktif</h5>
                </div>
                <div class="list-group list-group-flush p-3">
                    @forelse($users as $user)
                    <a href="{{ route('chat.index', ['user_id' => $user->id]) }}" class="list-group-item list-group-item-action border-0 rounded-4 mb-2 p-3 {{ isset($activeUser) && $activeUser->id == $user->id ? 'bg-primary text-white' : 'bg-light' }}">
                        <div class="d-flex align-items-center">
                            <div class="bg-white text-primary p-2 rounded-circle me-3 shadow-sm">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div class="overflow-hidden">
                                <h6 class="mb-0 fw-bold small text-truncate">{{ $user->name }}</h6>
                                <span class="x-small opacity-75">{{ $user->role }}</span>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="text-center py-5 opacity-50">
                        <p class="small">Belum ada pesan masuk.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Area Chat -->
        <div class="col-md-8">
            <div class="card glass-card border-0 shadow-sm h-100 overflow-hidden d-flex flex-column" style="min-height: 600px;">
                @if($activeUser)
                    <div class="card-header bg-white border-bottom p-4 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary text-white p-2 rounded-circle me-3">
                                <i class="bi bi-person-check-fill"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">{{ $activeUser->name }}</h6>
                                <span class="x-small text-success fw-bold">ONLINE (Q&A)</span>
                            </div>
                        </div>
                    </div>

                    <div id="chat-box" class="card-body p-4 bg-light flex-grow-1" style="overflow-y: auto;">
                        @foreach($messages as $msg)
                            <div class="mb-3 d-flex {{ $msg->sender_id == Auth::id() ? 'justify-content-end' : 'justify-content-start' }}">
                                <div class="p-3 rounded-4 shadow-sm" style="max-width: 75%; background-color: {{ $msg->sender_id == Auth::id() ? '#4a148c' : 'white' }}; color: {{ $msg->sender_id == Auth::id() ? 'white' : '#333' }};">
                                    <div class="small">{{ $msg->message }}</div>
                                    <div class="text-end x-small opacity-50 mt-1">{{ $msg->created_at->format('H:i') }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="card-footer bg-white border-0 p-4">
                        <form action="{{ route('chat.send') }}" method="POST">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $activeUser->id }}">
                            <div class="input-group">
                                <input type="text" name="message" class="form-control border-0 bg-light px-3" placeholder="Tulis jawaban Anda di sini..." required>
                                <button type="submit" class="btn btn-primary px-4 fw-bold rounded-pill ms-2">BALAS <i class="bi bi-reply-fill ms-2"></i></button>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="flex-grow-1 d-flex flex-column align-items-center justify-content-center opacity-25 p-5 text-center">
                        <i class="bi bi-chat-left-text display-1 mb-4"></i>
                        <h5>Pilih percakapan di sebelah kiri untuk mulai membalas pesan pengunjung.</h5>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = function() {
        var chatBox = document.getElementById('chat-box');
        if(chatBox) chatBox.scrollTop = chatBox.scrollHeight;
    }
</script>
@endsection
