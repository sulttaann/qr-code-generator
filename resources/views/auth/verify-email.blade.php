<x-guest-layout>

    <div class="text-center mb-3">
        <i class="bi bi-envelope-check text-success" style="font-size: 2.5rem"></i>
    </div>

    <h5 class="fw-bold mb-1 text-center">Verifikasi Email</h5>
    <p class="text-muted small mb-4 text-center">
        Cek email kamu dan klik link verifikasi yang sudah kami kirim.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success small">
            Link verifikasi baru sudah dikirim ke email kamu.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}" class="d-grid mb-2">
        @csrf
        <button type="submit" class="btn btn-success">
            <i class="bi bi-send me-1"></i>Kirim Ulang Email Verifikasi
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="d-grid">
        @csrf
        <button type="submit" class="btn btn-outline-secondary">
            <i class="bi bi-box-arrow-right me-1"></i>Logout
        </button>
    </form>

</x-guest-layout>
