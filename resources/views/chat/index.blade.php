@extends('layouts.app')

@section('page_title', 'Konsultasi Pustakawan (Q&A)')

@section('content')
<div class="fade-in">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card glass-card border-0 shadow-lg overflow-hidden" style="border-radius: 30px;">
                <div class="card-header text-white p-4 border-0" style="background: var(--p-purple);">
                    <div class="d-flex align-items-center">
                        <div class="bg-white text-primary p-2 rounded-circle me-3 shadow">
                            <i class="bi bi-chat-dots-fill fs-4" style="color: var(--p-purple);"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">Chat Layanan Siswa</h5>
                            <p class="small mb-0 opacity-75">Tanyakan ketersediaan buku atau masalah denda di sini.</p>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    <div id="chat-box" class="p-4" style="height: 450px; overflow-y: auto; background: #fdfbff; display: flex; flex-direction: column;">
                        @forelse($messages as $msg)
                            <div class="mb-3 d-flex {{ $msg->sender_id == Auth::id() ? 'justify-content-end' : 'justify-content-start' }}">
                                <div class="p-3 rounded-4 shadow-sm" style="max-width: 75%; background: {{ $msg->sender_id == Auth::id() ? 'var(--p-purple)' : 'white' }}; color: {{ $msg->sender_id == Auth::id() ? 'white' : '#333' }}; border: {{ $msg->sender_id == Auth::id() ? 'none' : '1px solid #eee' }};">
                                    <div class="x-small fw-bold mb-1 {{ $msg->sender_id == Auth::id() ? 'text-warning' : 'text-primary' }}">
                                        {{ $msg->sender->name }}
                                    </div>
                                    <div class="small">{{ $msg->message }}</div>
                                    <div class="text-end x-small opacity-50 mt-1">{{ $msg->created_at->format('H:i') }}</div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5 opacity-25 mt-5">
                                <i class="bi bi-chat-left-dots display-1 mb-3 d-block"></i>
                                <p>Mulai percakapan dengan petugas perpustakaan.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="card-footer bg-white border-0 p-4">
                    <form action="{{ route('chat.send') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <select name="receiver_id" class="form-select border-0 bg-light fw-bold small" style="max-width: 150px; border-radius: 20px 0 0 20px;" required>
                                <option value="" disabled selected>Pilih Petugas</option>
                                @foreach($staff as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="message" class="form-control border-0 bg-light px-3" placeholder="Tulis pesan Anda..." required>
                            <button type="submit" class="btn btn-p px-4 fw-bold shadow-sm ms-2" style="border-radius: 20px !important;">KIRIM <i class="bi bi-send ms-1"></i></button>
                        </div>
                    </form>
                </div>
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
