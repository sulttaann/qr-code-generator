<x-guest-layout>

    <h5 class="fw-bold mb-1">Masuk</h5>
    <p class="text-muted small mb-4">Masuk ke akun QR Generator kamu</p>

    @if (session('status'))
        <div class="alert alert-success small">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="email@contoh.com" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Password</label>
            <input id="password" type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="••••••••" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 d-flex justify-content-between align-items-center">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                <label class="form-check-label small" for="remember_me">Ingat saya</label>
            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="small text-success">Lupa password?</a>
            @endif
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-box-arrow-in-right me-1"></i>Masuk
            </button>
        </div>

        <p class="text-center small mb-0">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-success fw-semibold">Daftar Gratis</a>
        </p>
    </form>

</x-guest-layout>
