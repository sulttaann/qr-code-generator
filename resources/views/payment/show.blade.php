<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Payment - {{ $profile->nama }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; font-family: Arial, sans-serif; }
        .profile-card { max-width: 420px; margin: 40px auto; }
        .qr-image { max-width: 280px; border: 2px solid #dee2e6; border-radius: 8px; }
        .platform-badge { font-size: 1rem; padding: 6px 16px; border-radius: 20px; }
    </style>
</head>
<body>

    <!-- Navbar simple -->
    <nav class="navbar navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="bi bi-qr-code me-2"></i>QR Generator
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="profile-card">

            <!-- Header -->
            <div class="card shadow-sm mb-3">
                <div class="card-body text-center p-4">

                    <!-- Icon platform -->
                    <div class="mb-3">
                        <i class="bi bi-credit-card text-success" style="font-size: 3rem"></i>
                    </div>

                    <h4 class="fw-bold mb-1">{{ $profile->nama }}</h4>

                    <span class="badge bg-success platform-badge mb-3">
                        {{ $profile->platform }}
                    </span>

                    <!-- Info rekening -->
                    <table class="table table-sm table-bordered text-start mb-3">
                        <tr>
                            <td class="fw-semibold" style="width:40%">Platform</td>
                            <td>{{ $profile->platform }}</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Nomor / Rek</td>
                            <td>
                                <span id="nomor-text">{{ $profile->nomor }}</span>
                                <button onclick="copyNomor()" class="btn btn-sm btn-outline-success ms-2 py-0">
                                    <i class="bi bi-copy"></i> Salin
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Nama</td>
                            <td>{{ $profile->nama }}</td>
                        </tr>
                        @if($profile->nominal)
                        <tr>
                            <td class="fw-semibold">Nominal</td>
                            <td class="text-success fw-bold">
                                Rp {{ number_format($profile->nominal, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endif
                    </table>

                </div>
            </div>

            <!-- QR Resmi -->
            <div class="card shadow-sm mb-3">
                <div class="card-body text-center p-4">
                    <h6 class="fw-bold mb-1">
                        <i class="bi bi-qr-code text-success me-1"></i>
                        QR Resmi {{ $profile->platform }}
                    </h6>
                    <p class="text-muted small mb-3">Scan QR ini langsung dari kamera HP kamu</p>

                    <img src="{{ asset('storage/' . $profile->qr_image) }}"
                         alt="QR {{ $profile->platform }}"
                         class="qr-image img-fluid mb-3">

                    <div class="alert alert-success small py-2 mb-0">
                        <i class="bi bi-phone me-1"></i>
                        <strong>Cara bayar:</strong> Buka kamera HP → arahkan ke QR di atas →
                        app {{ $profile->platform }} akan terbuka otomatis → konfirmasi pembayaran
                    </div>
                </div>
            </div>

            <!-- Tutorial Cara Scan -->
            <div class="card shadow-sm mb-3">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-question-circle text-warning me-1"></i>
                        Cara Scan QR untuk Bayar
                    </h6>

                    <div class="mb-3">
                        <p class="fw-semibold small mb-1">📱 Cara 1 — Kamera HP Langsung</p>
                        <ol class="small text-muted ps-3 mb-0">
                            <li>Buka aplikasi Kamera HP</li>
                            <li>Arahkan ke gambar QR di atas</li>
                            <li>Tap notifikasi yang muncul</li>
                            <li>App {{ $profile->platform }} terbuka → bayar</li>
                        </ol>
                    </div>

                    <div class="mb-3">
                        <p class="fw-semibold small mb-1">💳 Cara 2 — Lewat App E-Wallet</p>
                        <ol class="small text-muted ps-3 mb-0">
                            <li>Buka app DANA / GoPay / OVO kamu</li>
                            <li>Pilih menu <strong>Scan QR</strong> atau <strong>Bayar</strong></li>
                            <li>Arahkan ke gambar QR di atas</li>
                            <li>Konfirmasi pembayaran</li>
                        </ol>
                    </div>

                    <div>
                        <p class="fw-semibold small mb-1">📋 Cara 3 — Transfer Manual</p>
                        <ol class="small text-muted ps-3 mb-0">
                            <li>Salin nomor di atas (tombol Salin)</li>
                            <li>Buka app {{ $profile->platform }}</li>
                            <li>Pilih Transfer → masukkan nomor</li>
                            <li>Masukkan nominal → konfirmasi</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <p class="text-center text-muted small">
                Halaman ini dibuat dengan
                <a href="{{ url('/') }}" class="text-success">QR Generator</a>
            </p>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function copyNomor() {
            const nomor = document.getElementById('nomor-text').textContent.trim();
            navigator.clipboard.writeText(nomor).then(function() {
                alert('Nomor berhasil disalin: ' + nomor);
            });
        }
    </script>
</body>
</html>
