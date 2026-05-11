<x-guest-layout>

    <h5 class="fw-bold mb-1">Konfirmasi Password</h5>
    <p class="text-muted small mb-4">Ini area aman. Konfirmasi password kamu sebelum melanjutkan.</p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-4">
            <label for="password" class="form-label fw-semibold">Password</label>
            <input id="password" type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="••••••••" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-shield-lock me-1"></i>Konfirmasi
            </button>
        </div>
    </form>

</x-guest-layout>
