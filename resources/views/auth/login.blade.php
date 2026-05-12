<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <h4 class="fw-black text-center mb-4">LOGIN ANGGOTA</h4>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label small fw-bold text-muted">Email Sekolah</label>
            <input id="email" class="form-control bg-light border-0 py-2" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            @if($errors->has('email'))
                <div class="text-danger small mt-1">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label small fw-bold text-muted">Kata Sandi</label>
            <input id="password" class="form-control bg-light border-0 py-2" type="password" name="password" required autocomplete="current-password" />
            @if($errors->has('password'))
                <div class="text-danger small mt-1">{{ $errors->first('password') }}</div>
            @endif
        </div>

        <!-- Remember Me -->
        <div class="mb-3 form-check">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label class="form-check-label small text-muted" for="remember_me">Ingat saya di perangkat ini</label>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary fw-bold py-2 shadow">
                MASUK SEKARANG
            </button>
        </div>

        <div class="mt-4 text-center">
            @if (Route::has('password.request'))
                <a class="text-decoration-none small fw-bold me-3" href="{{ route('password.request') }}">
                    Lupa sandi?
                </a>
            @endif
            <a href="{{ route('register') }}" class="text-decoration-none small fw-bold text-warning">Daftar Akun Baru</a>
        </div>
    </form>
</x-guest-layout>
