<x-app-layout>
    <x-slot name="header">
        <h1 class="page-title">
            <i class="bi bi-check-circle text-success me-2"></i>QR Code Berhasil Dibuat!
        </h1>
    </x-slot>

    <div class="row g-4 justify-content-center">

        <!-- QR Result -->
        <div class="col-md-5">
            <div class="card p-4 text-center">
                <h6 class="fw-bold mb-3">QR Code Result</h6>

                <!-- QR Image -->
                <div class="d-inline-block p-3 border rounded mb-3" style="background: white">
                    <div id="qr-svg-container">
                        {!! $generatedQr !!}
                    </div>
                </div>

                <!-- Info -->
                <table class="table table-sm table-bordered text-start mb-3">
                    <tr>
                        <td class="fw-semibold" style="width:35%">Tipe</td>
                        <td class="text-capitalize">{{ $qr->qr_type }}</td>
                    </tr>
                    <tr>
                        <td class="fw-semibold">Konten</td>
                        <td style="word-break: break-all; font-size: 0.85rem">{{ $qr->qr_content }}</td>
                    </tr>
                    <tr>
                        <td class="fw-semibold">Dibuat</td>
                        <td>{{ $qr->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                </table>

                <!-- Download -->
                <div class="d-grid">
                    <button onclick="downloadQR()" class="btn btn-success">
                        <i class="bi bi-download me-1"></i>Download QR Code (PNG)
                    </button>
                </div>
            </div>
        </div>

        <!-- Aksi & Info -->
        <div class="col-md-4">
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
                <h6 class="fw-bold mb-2">
                    <i class="bi bi-phone text-success me-1"></i>Cara Scan QR
                </h6>
                <ol class="small mb-2 ps-3">
                    <li>Buka kamera HP kamu</li>
                    <li>Arahkan ke QR Code</li>
                    <li>Tunggu notifikasi muncul</li>
                    <li>Tap notifikasi untuk membuka</li>
                </ol>
                <p class="small text-muted mb-0">
                    <i class="bi bi-info-circle me-1"></i>
                    Kompatibel dengan semua smartphone (iOS & Android)
                </p>
            </div>
        </div>
    </div>

    <script>
        function downloadQR() {
            const svgEl = document.querySelector('#qr-svg-container svg');
            if (!svgEl) { alert('QR Code tidak ditemukan!'); return; }

            const svgClone = svgEl.cloneNode(true);
            svgClone.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
            const rect = document.createElementNS('http://www.w3.org/2000/svg', 'rect');
            rect.setAttribute('width', '100%');
            rect.setAttribute('height', '100%');
            rect.setAttribute('fill', 'white');
            svgClone.insertBefore(rect, svgClone.firstChild);

            const svgData = new XMLSerializer().serializeToString(svgClone);
            const url = URL.createObjectURL(new Blob([svgData], { type: 'image/svg+xml;charset=utf-8' }));

            const img = new Image();
            img.onload = function () {
                const canvas = document.createElement('canvas');
                canvas.width = 400; canvas.height = 400;
                const ctx = canvas.getContext('2d');
                ctx.fillStyle = 'white';
                ctx.fillRect(0, 0, 400, 400);
                ctx.drawImage(img, 0, 0, 400, 400);
                const link = document.createElement('a');
                link.download = 'qrcode-{{ $qr->qr_type }}-{{ $qr->id }}.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
                URL.revokeObjectURL(url);
            };
            img.src = url;
        }
    </script>
</x-app-layout>
