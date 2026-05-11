<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QR Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f9fa; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-qr-code me-2"></i>QR Generator
            </a>
            <div class="ms-auto d-flex gap-2">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-light btn-sm">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-light btn-sm">Daftar</a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <div class="bg-success text-white py-5">
        <div class="container text-center">
            <i class="bi bi-qr-code-scan" style="font-size: 4rem"></i>
            <h1 class="fw-bold mt-3">QR Code Generator</h1>
            <p class="lead mb-4">Buat QR Code untuk URL, WhatsApp, WiFi, Payment, dan banyak lagi.<br>Gratis dan bisa di-scan langsung dari kamera HP!</p>
            @auth
                <a href="{{ route('qr_codes.create') }}" class="btn btn-light btn-lg me-2">
                    <i class="bi bi-plus-circle me-1"></i>Buat QR Sekarang
                </a>
            @else
                <a href="{{ route('register') }}" class="btn btn-light btn-lg me-2">
                    <i class="bi bi-person-plus me-1"></i>Daftar Gratis
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                    Login
                </a>
            @endauth
        </div>
    </div>

    <!-- Fitur -->
    <div class="container py-5">
        <h4 class="text-center fw-bold mb-4">Tipe QR yang Tersedia</h4>
        <div class="row g-3 justify-content-center">
            <div class="col-md-3 col-6">
                <div class="card text-center p-3">
                    <img src="{{ asset('images/web_logo.png') }}" alt="URL" class="mx-auto mb-2" style="width:48px;height:48px;object-fit:contain">
                    <div class="fw-semibold">Website URL</div>
                    <small class="text-muted">Link website apapun</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card text-center p-3">
                    <img src="{{ asset('images/whatsapp_logo.jpg') }}" alt="WhatsApp" class="mx-auto mb-2" style="width:48px;height:48px;object-fit:contain;border-radius:8px">
                    <div class="fw-semibold">WhatsApp</div>
                    <small class="text-muted">Buka chat langsung</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card text-center p-3">
                    <img src="{{ asset('images/wifi_logo.png') }}" alt="WiFi" class="mx-auto mb-2" style="width:48px;height:48px;object-fit:contain">
                    <div class="fw-semibold">WiFi</div>
                    <small class="text-muted">Konek WiFi otomatis</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card text-center p-3">
                    <img src="{{ asset('images/wallet_logo.avif') }}" alt="Payment" class="mx-auto mb-2" style="width:48px;height:48px;object-fit:contain">
                    <div class="fw-semibold">Payment</div>
                    <small class="text-muted">DANA, GoPay, QRIS</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card text-center p-3">
                    <img src="{{ asset('images/instagram_logo.svg') }}" alt="Instagram" class="mx-auto mb-2" style="width:48px;height:48px;object-fit:contain">
                    <div class="fw-semibold">Instagram</div>
                    <small class="text-muted">Profil Instagram</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card text-center p-3">
                    <img src="{{ asset('images/email_logo.png') }}" alt="Email" class="mx-auto mb-2" style="width:48px;height:48px;object-fit:contain">
                    <div class="fw-semibold">Email</div>
                    <small class="text-muted">Buka email otomatis</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card text-center p-3">
                    <img src="{{ asset('images/teks_logo.png') }}" alt="Teks" class="mx-auto mb-2" style="width:48px;height:48px;object-fit:contain">
                    <div class="fw-semibold">Teks Bebas</div>
                    <small class="text-muted">Teks apapun</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card text-center p-3">
                    <img src="{{ asset('images/telephone_logo.jpg') }}" alt="Telepon" class="mx-auto mb-2" style="width:48px;height:48px;object-fit:contain;border-radius:8px">
                    <div class="fw-semibold">Telepon</div>
                    <small class="text-muted">Nomor telepon</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-top text-center py-3">
        <small class="text-muted">
            <i class="bi bi-qr-code text-success me-1"></i>
            QR Generator &copy; {{ date('Y') }}
        </small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
