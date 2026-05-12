<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <h4 class="fw-black text-center mb-4">DAFTAR ANGGOTA</h4>

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label small fw-bold text-muted">Nama Lengkap</label>
            <input id="name" class="form-control bg-light border-0 py-2" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
            @if($errors->has('name'))
                <div class="text-danger small mt-1">{{ $errors->first('name') }}</div>
            @endif
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label small fw-bold text-muted">Email Sekolah</label>
            <input id="email" class="form-control bg-light border-0 py-2" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
            @if($errors->has('email'))
                <div class="text-danger small mt-1">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label small fw-bold text-muted">Kata Sandi</label>
            <input id="password" class="form-control bg-light border-0 py-2" type="password" name="password" required autocomplete="new-password" />
            @if($errors->has('password'))
                <div class="text-danger small mt-1">{{ $errors->first('password') }}</div>
            @endif
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label small fw-bold text-muted">Konfirmasi Kata Sandi</label>
            <input id="password_confirmation" class="form-control bg-light border-0 py-2" type="password" name="password_confirmation" required autocomplete="new-password" />
            @if($errors->has('password_confirmation'))
                <div class="text-danger small mt-1">{{ $errors->first('password_confirmation') }}</div>
            @endif
        </div>

        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-primary fw-bold py-2 shadow">
                DAFTAR SEKARANG
            </button>
        </div>

        <div class="mt-3 text-center">
            <a href="{{ route('login') }}" class="text-decoration-none small fw-bold text-warning">Sudah punya akun? Login di sini</a>
        </div>
    </form>
</x-guest-layout>
