<section>
    <h6 class="fw-bold mb-1">Informasi Profil</h6>
    <p class="text-muted small mb-3">Update nama dan email akun kamu.</p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Nama</label>
            <input id="name" name="name" type="text"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $user->name) }}" required autofocus>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input id="email" name="email" type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning small mt-2 py-2">
                    Email belum diverifikasi.
                    <button form="send-verification" class="btn btn-sm btn-warning ms-2">
                        Kirim ulang verifikasi
                    </button>
                    @if (session('status') === 'verification-link-sent')
                        <span class="text-success ms-2">Link terkirim!</span>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save me-1"></i>Simpan
            </button>
            @if (session('status') === 'profile-updated')
                <span class="text-success small">
                    <i class="bi bi-check-circle me-1"></i>Tersimpan!
                </span>
            @endif
        </div>
    </form>
</section>
