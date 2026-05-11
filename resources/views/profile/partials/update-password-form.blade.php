<section>
    <h6 class="fw-bold mb-1">Update Password</h6>
    <p class="text-muted small mb-3">Gunakan password yang kuat agar akun tetap aman.</p>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label fw-semibold">Password Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password"
                   class="form-control @if($errors->updatePassword->get('current_password')) is-invalid @endif"
                   placeholder="••••••••">
            @if($errors->updatePassword->get('current_password'))
                <div class="invalid-feedback">{{ $errors->updatePassword->first('current_password') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label fw-semibold">Password Baru</label>
            <input id="update_password_password" name="password" type="password"
                   class="form-control @if($errors->updatePassword->get('password')) is-invalid @endif"
                   placeholder="Min. 8 karakter">
            @if($errors->updatePassword->get('password'))
                <div class="invalid-feedback">{{ $errors->updatePassword->first('password') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label fw-semibold">Konfirmasi Password Baru</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                   class="form-control @if($errors->updatePassword->get('password_confirmation')) is-invalid @endif"
                   placeholder="Ulangi password baru">
            @if($errors->updatePassword->get('password_confirmation'))
                <div class="invalid-feedback">{{ $errors->updatePassword->first('password_confirmation') }}</div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save me-1"></i>Simpan Password
            </button>
            @if (session('status') === 'password-updated')
                <span class="text-success small">
                    <i class="bi bi-check-circle me-1"></i>Password diperbarui!
                </span>
            @endif
        </div>
    </form>
</section>
