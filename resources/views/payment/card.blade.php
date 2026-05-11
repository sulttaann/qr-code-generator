<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kartu Payment - {{ $profile->nama }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background: #f5f5f5; font-family: Arial, sans-serif; }
        .navbar { background: #111; }
        .navbar-brand { color: #fff !important; font-weight: bold; }

        /* Kartu */
        #payment-card {
            background: white;
            border: 2px solid #111;
            border-radius: 10px;
            overflow: hidden;
            max-width: 400px;
            margin: 0 auto;
        }
        .card-top {
            background: #111;
            color: white;
            padding: 16px;
            text-align: center;
        }
        .card-top h5 { margin: 0; font-size: 1.1rem; }
        .card-top p  { margin: 4px 0 0; font-size: 0.8rem; opacity: 0.8; }
        .platform-badge {
            display: inline-block;
            background: #111;
            color: white;
            padding: 4px 20px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.95rem;
        }
        .info-table td { padding: 7px 0; font-size: 0.9rem; }
        .info-table td:first-child { color: #666; width: 40%; }
        .info-table td:last-child { font-weight: bold; }
        .qr-box {
            border: 2px solid #111;
            border-radius: 6px;
            padding: 8px;
            display: inline-block;
            background: white;
        }
        .qr-box img { width: 220px; height: 220px; object-fit: contain; display: block; }
        .card-footer-custom {
            background: #f5f5f5;
            border-top: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-size: 0.75rem;
            color: #888;
        }

        @media print {
            body * { visibility: hidden; }
            #payment-card, #payment-card * { visibility: visible; }
            #payment-card {
                position: fixed;
                top: 50%; left: 50%;
                transform: translate(-50%, -50%);
            }
            .no-print { display: none !important; }
            img { print-color-adjust: exact; -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body>

<nav class="navbar no-print">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="bi bi-arrow-left me-2"></i>Kembali ke Generator
        </a>
    </div>
</nav>

<div class="container py-4">
    <div class="row g-4 justify-content-center">

        <!-- Kartu -->
        <div class="col-md-5">
            <div id="payment-card">
                <div class="card-top">
                    <h5>PROFIL PEMBAYARAN</h5>
                    <p>Scan QR di bawah untuk melakukan pembayaran</p>
                </div>

                <div class="text-center py-2" style="background:#f9f9f9; border-bottom:1px solid #eee">
                    <span class="platform-badge">{{ $profile->platform }}</span>
                </div>

                <div class="px-4 py-3">
                    <table class="info-table w-100" style="border-collapse:collapse">
                        <tr style="border-bottom:1px solid #eee">
                            <td>Nama Pemilik</td>
                            <td>{{ $profile->nama }}</td>
                        </tr>
                        <tr style="border-bottom:1px solid #eee">
                            <td>Nomor / Rek</td>
                            <td>{{ $profile->nomor }}</td>
                        </tr>
                        @if($profile->nominal)
                        <tr style="border-bottom:1px solid #eee">
                            <td>Nominal</td>
                            <td>Rp {{ number_format($profile->nominal, 0, ',', '.') }}</td>
                        </tr>
                        @endif
                    </table>
                </div>

                <div class="text-center px-4 pb-3">
                    <p class="fw-semibold small mb-2">Scan QR Berikut untuk Bayar</p>
                    <div class="qr-box">
                        <img src="{{ asset('storage/' . $profile->qr_image) }}" alt="QR {{ $profile->platform }}">
                    </div>
                    <p class="text-muted small mt-2 mb-0">Buka kamera HP → arahkan ke QR → bayar</p>
                </div>

                <div class="card-footer-custom">
                    Dibuat dengan QR Generator &bull; {{ now()->format('d M Y') }}
                </div>
            </div>

            <!-- Tombol -->
            <div class="mt-3 d-grid gap-2 no-print" style="max-width:400px; margin:0 auto">
                <button onclick="window.print()" class="btn btn-dark">
                    <i class="bi bi-printer me-1"></i>Print / Simpan sebagai PDF
                </button>
                <a href="{{ route('home') }}" class="btn btn-outline-dark">
                    <i class="bi bi-plus-circle me-1"></i>Buat QR Lagi
                </a>
            </div>
        </div>

        <!-- Panduan -->
        <div class="col-md-4 no-print">
            <div class="card p-3 mb-3">
                <h6 class="fw-bold mb-2">Cara Pakai Kartu Ini</h6>
                <ol class="small text-muted ps-3 mb-0">
                    <li class="mb-1">Klik <strong>Print</strong> → pilih <strong>Save as PDF</strong></li>
                    <li class="mb-1">Atau screenshot kartu ini</li>
                    <li class="mb-1">Share ke WhatsApp / media sosial</li>
                    <li>Orang scan QR di kartu → langsung bayar</li>
                </ol>
            </div>
            <div class="card p-3">
                <h6 class="fw-bold mb-2">Info Kartu</h6>
                <table class="table table-sm table-bordered mb-0">
                    <tr><td class="fw-semibold">Platform</td><td>{{ $profile->platform }}</td></tr>
                    <tr><td class="fw-semibold">Nomor</td><td>{{ $profile->nomor }}</td></tr>
                    <tr><td class="fw-semibold">Nama</td><td>{{ $profile->nama }}</td></tr>
                    @if($profile->nominal)
                    <tr><td class="fw-semibold">Nominal</td><td>Rp {{ number_format($profile->nominal, 0, ',', '.') }}</td></tr>
                    @endif
                </table>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
