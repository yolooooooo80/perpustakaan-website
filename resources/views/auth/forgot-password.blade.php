<x-guest-layout>
    <div class="mb-4 text-sm text-muted">
        Lupa kata sandi? Jangan khawatir. Beritahu kami alamat email Anda dan kami akan mengirimkan tautan reset kata sandi agar Anda dapat memilih yang baru.
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success mb-4" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label small fw-bold text-muted">Email</label>
            <input id="email" class="form-control bg-light border-0 py-2" type="email" name="email" :value="old('email')" required autofocus />
            @if($errors->has('email'))
                <div class="text-danger small mt-1">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-primary fw-bold py-2 shadow">
                KIRIM LINK RESET SANDI
            </button>
        </div>
        
        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="text-decoration-none small fw-bold">Kembali ke Login</a>
        </div>
    </form>
</x-guest-layout>
