<x-app-layout>
    <x-slot name="header">
        <h1 class="page-title">
            <i class="bi bi-check-circle text-success me-2"></i>Kartu Payment Berhasil Dibuat!
        </h1>
    </x-slot>

    <div class="row g-4 justify-content-center">

        <!-- Kartu Payment -->
        <div class="col-md-5">

            {{-- Kartu yang bisa di-print / screenshot --}}
            <div id="payment-card" style="
                background: white;
                border: 2px solid #198754;
                border-radius: 12px;
                overflow: hidden;
                max-width: 400px;
                margin: 0 auto;
                font-family: Arial, sans-serif;
            ">
                {{-- Header --}}
                <div style="background: #198754; color: white; padding: 18px; text-align: center;">
                    <div style="font-size: 1.3rem; font-weight: bold; margin-bottom: 4px;">
                        PROFIL PEMBAYARAN
                    </div>
                    <div style="font-size: 0.8rem; opacity: 0.9;">
                        Scan QR di bawah untuk melakukan pembayaran
                    </div>
                </div>

                {{-- Badge Platform --}}
                <div style="background: #e8f5e9; text-align: center; padding: 10px;">
                    <span style="background: #198754; color: white; padding: 4px 20px; border-radius: 20px; font-weight: bold; font-size: 1rem;">
                        {{ $profile->platform }}
                    </span>
                </div>

                {{-- Info Rekening --}}
                <div style="padding: 16px 20px;">
                    <table style="width: 100%; border-collapse: collapse; font-size: 0.9rem;">
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 8px 0; color: #666; width: 40%;">Nama Pemilik</td>
                            <td style="padding: 8px 0; font-weight: bold; color: #111;">{{ $profile->nama }}</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 8px 0; color: #666;">Nomor / Rek</td>
                            <td style="padding: 8px 0; font-weight: bold; color: #111;">{{ $profile->nomor }}</td>
                        </tr>
                        @if($profile->nominal)
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 8px 0; color: #666;">Nominal</td>
                            <td style="padding: 8px 0; font-weight: bold; color: #198754;">
                                Rp {{ number_format($profile->nominal, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endif
                    </table>
                </div>

                {{-- QR Resmi --}}
                <div style="padding: 0 20px 16px; text-align: center;">
                    <div style="font-size: 0.85rem; color: #555; margin-bottom: 10px; font-weight: bold;">
                        ▼ Scan QR Berikut untuk Bayar ▼
                    </div>
                    {{-- Gambar QR asli — tidak di-resize, kualitas terjaga --}}
                    <div style="border: 2px solid #198754; border-radius: 8px; padding: 8px; display: inline-block; background: white;">
                        <img src="{{ asset('storage/' . $profile->qr_image) }}"
                             alt="QR {{ $profile->platform }}"
                             style="width: 220px; height: 220px; object-fit: contain; display: block;">
                    </div>
                    <div style="font-size: 0.75rem; color: #888; margin-top: 8px;">
                        Buka kamera HP → arahkan ke QR → bayar
                    </div>
                </div>

                {{-- Footer --}}
                <div style="background: #f8f9fa; border-top: 1px solid #dee2e6; padding: 10px; text-align: center;">
                    <span style="font-size: 0.75rem; color: #888;">
                        Dibuat dengan QR Generator • {{ now()->format('d M Y') }}
                    </span>
                </div>
            </div>

            {{-- Tombol aksi --}}
            <div class="mt-3 d-grid gap-2" style="max-width: 400px; margin: 0 auto;">
                <button onclick="printCard()" class="btn btn-success">
                    <i class="bi bi-printer me-1"></i>Print / Simpan sebagai PDF
                </button>
                <button onclick="screenshotInfo()" class="btn btn-outline-secondary">
                    <i class="bi bi-camera me-1"></i>Screenshot kartu ini
                </button>
            </div>

            <div class="mt-2 text-center" style="max-width: 400px; margin: 0 auto;">
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Gunakan Print → "Save as PDF" untuk simpan sebagai file
                </small>
            </div>
        </div>

        <!-- Info & Aksi -->
        <div class="col-md-4">
            <div class="card p-3 mb-3">
                <h6 class="fw-bold mb-2">
                    <i class="bi bi-share text-success me-1"></i>Cara Pakai Kartu Ini
                </h6>
                <ol class="small text-muted ps-3 mb-0">
                    <li class="mb-1"><strong>Print</strong> → tempel di meja/kasir</li>
                    <li class="mb-1"><strong>Screenshot</strong> → share ke WhatsApp/IG</li>
                    <li class="mb-1"><strong>Save PDF</strong> → simpan di HP</li>
                    <li>Orang scan QR di kartu → langsung bayar</li>
                </ol>
            </div>

            <div class="card p-3 mb-3">
                <h6 class="fw-bold mb-3">Aksi Lanjutan</h6>
                <div class="d-grid gap-2">
                    <a href="{{ route('qr_codes.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle me-1"></i>Buat QR Baru
                    </a>
                    <a href="{{ route('qr_codes.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-clock-history me-1"></i>Lihat History
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-house me-1"></i>Dashboard
                    </a>
                </div>
            </div>

            <div class="card p-3">
                <h6 class="fw-bold mb-2">Info Kartu</h6>
                <table class="table table-sm table-bordered mb-0">
                    <tr>
                        <td class="fw-semibold" style="width:40%">Platform</td>
                        <td>{{ $profile->platform }}</td>
                    </tr>
                    <tr>
                        <td class="fw-semibold">Nomor</td>
                        <td>{{ $profile->nomor }}</td>
                    </tr>
                    <tr>
                        <td class="fw-semibold">Nama</td>
                        <td>{{ $profile->nama }}</td>
                    </tr>
                    @if($profile->nominal)
                    <tr>
                        <td class="fw-semibold">Nominal</td>
                        <td>Rp {{ number_format($profile->nominal, 0, ',', '.') }}</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>

    {{-- CSS khusus print --}}
    <style>
        @media print {
            /* Sembunyikan semua kecuali kartu */
            body * { visibility: hidden; }
            #payment-card, #payment-card * { visibility: visible; }
            #payment-card {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                border: 2px solid #198754 !important;
                max-width: 380px !important;
            }
            /* Pastikan gambar QR muncul saat print */
            img { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>

    <script>
        function printCard() {
            window.print();
        }

        function screenshotInfo() {
            alert(
                'Cara screenshot kartu:\n\n' +
                '• Windows: tekan Win + Shift + S → pilih area kartu\n' +
                '• Mac: tekan Cmd + Shift + 4 → pilih area kartu\n' +
                '• HP: screenshot layar seperti biasa\n\n' +
                'Atau gunakan tombol Print → Save as PDF untuk simpan sebagai file.'
            );
        }
    </script>
</x-app-layout>
