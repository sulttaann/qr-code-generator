<section>
    <h6 class="fw-bold text-danger mb-1">Hapus Akun</h6>
    <p class="text-muted small mb-3">
        Setelah akun dihapus, semua data akan hilang permanen.
    </p>

    <button type="button" class="btn btn-outline-danger btn-sm"
            data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
        <i class="bi bi-trash me-1"></i>Hapus Akun
    </button>
</section>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold text-danger">
                    <i class="bi bi-exclamation-triangle me-1"></i>Hapus Akun?
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <p class="text-muted small mb-3">
                        Semua data dan QR Code kamu akan dihapus permanen. Masukkan password untuk konfirmasi.
                    </p>
                    <div>
                        <label for="delete_password" class="form-label fw-semibold">Password</label>
                        <input id="delete_password" name="password" type="password"
                               class="form-control @if($errors->userDeletion->get('password')) is-invalid @endif"
                               placeholder="Masukkan password kamu">
                        @if($errors->userDeletion->get('password'))
                            <div class="invalid-feedback">{{ $errors->userDeletion->first('password') }}</div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash me-1"></i>Ya, Hapus Akun
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
