<x-guest-layout>

    <h5 class="fw-bold mb-1">Lupa Password?</h5>
    <p class="text-muted small mb-4">Masukkan email kamu, kami akan kirim link reset password.</p>

    @if (session('status'))
        <div class="alert alert-success small">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
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

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-send me-1"></i>Kirim Link Reset
            </button>
        </div>

        <p class="text-center small mb-0">
            <a href="{{ route('login') }}" class="text-success">← Kembali ke Login</a>
        </p>
    </form>

</x-guest-layout>
