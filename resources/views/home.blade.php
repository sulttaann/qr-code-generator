<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QR Code Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- intl-tel-input untuk input nomor telepon internasional -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
    <style>
        body { background: #fff; font-family: Arial, sans-serif; color: #111; }

        .navbar { background: #111; }
        .navbar-brand { color: #fff !important; font-weight: bold; font-size: 1.2rem; }

        .visit-bar {
            background: #111; color: #fff;
            text-align: center; padding: 6px;
            font-size: 0.9rem; font-weight: bold;
        }

        .card { border: 1px solid #ddd; border-radius: 6px; }
        .card-header-custom {
            background: #111; color: #fff;
            padding: 12px 16px; font-weight: bold;
            border-radius: 6px 6px 0 0;
        }

        .btn-dark  { background: #111; border-color: #111; }
        .btn-dark:hover { background: #333; border-color: #333; }
        .btn-outline-dark:hover { background: #111; color: #fff; }

        /* Grid pilih tipe */
        .type-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
            margin-bottom: 16px;
        }
        .type-btn {
            border: 1px solid #ddd; border-radius: 6px;
            padding: 8px 4px; text-align: center;
            cursor: pointer; background: #fff;
            transition: all 0.2s; font-size: 0.75rem;
            user-select: none;
        }
        .type-btn:hover { border-color: #111; background: #f5f5f5; }
        /* AKTIF: border hitam tebal, background abu muda — icon TETAP TERLIHAT */
        .type-btn.active {
            border: 2px solid #111;
            background: #f0f0f0;
            font-weight: bold;
        }
        .type-btn img {
            width: 28px; height: 28px;
            object-fit: contain;
            display: block; margin: 0 auto 4px;
        }
        /* Icon TIDAK diinvert saat aktif supaya tetap kelihatan */

        /* Keterangan helper */
        .helper-box {
            background: #f8f8f8; border: 1px solid #ddd;
            border-radius: 6px; padding: 10px 14px;
            font-size: 0.85rem; color: #444;
            margin-bottom: 14px; line-height: 1.6;
        }
        .helper-box b { color: #111; }

        /* QR result */
        #qr-result-area {
            min-height: 350px;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
        }
        #qr-svg-container svg { width: 280px !important; height: 280px !important; }

        .form-select:focus, .form-control:focus {
            border-color: #111;
            box-shadow: 0 0 0 2px rgba(0,0,0,0.12);
        }

        /* intl-tel-input override */
        .iti { width: 100%; }
        .iti__flag-container { z-index: 10; }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="bi bi-qr-code me-2"></i>QR Code Generator
        </a>
    </div>
</nav>

<div class="visit-bar">
    Halaman ini telah dikunjungi {{ $visitCount }} kali
</div>

<div class="container py-4">
    <div class="row g-4">

        {{-- ===== KIRI: FORM ===== --}}
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header-custom">
                    <i class="bi bi-pencil-square me-2"></i>Isi Form QR Code
                </div>
                <div class="card-body p-4">

                    <p class="fw-semibold mb-2">Pilih Jenis QR:</p>
                    <div class="type-grid" id="typeGrid">
                        <div class="type-btn" data-type="url">
                            <img src="{{ asset('images/web_logo.png') }}" alt="URL">URL
                        </div>
                        <div class="type-btn" data-type="instagram">
                            <img src="{{ asset('images/instagram_logo.svg') }}" alt="IG">Instagram
                        </div>
                        <div class="type-btn" data-type="whatsapp">
                            <img src="{{ asset('images/whatsapp_logo.jpg') }}" alt="WA">WhatsApp
                        </div>
                        <div class="type-btn" data-type="email">
                            <img src="{{ asset('images/email_logo.png') }}" alt="Email">Email
                        </div>
                        <div class="type-btn" data-type="wifi">
                            <img src="{{ asset('images/wifi_logo.png') }}" alt="WiFi">WiFi
                        </div>
                        <div class="type-btn" data-type="payment">
                            <img src="{{ asset('images/wallet_logo.avif') }}" alt="Payment">Payment
                        </div>
                        <div class="type-btn" data-type="text">
                            <img src="{{ asset('images/teks_logo.png') }}" alt="Teks">Teks
                        </div>
                        <div class="type-btn" data-type="phone">
                            <img src="{{ asset('images/telephone_logo.jpg') }}" alt="Telepon">Telepon
                        </div>
                    </div>

                    {{-- FORM BIASA --}}
                    <form action="{{ route('qr.generate') }}" method="POST" id="qrForm">
                        @csrf
                        <input type="hidden" name="qr_type" id="hidden_type">
                        <input type="hidden" name="qr_content" id="hidden_content">

                        <div id="fields-wrapper">

                            {{-- URL --}}
                            <div id="field-url" class="field-group" style="display:none">
                                <div class="helper-box">
                                    <b>Website / URL</b><br>
                                    Masukkan alamat website lengkap.<br>
                                    <b>Cara dapat:</b> Buka website → copy URL dari address bar browser.<br>
                                    <b>Contoh:</b> https://google.com
                                </div>
                                <label class="form-label fw-semibold">URL Website</label>
                                <input type="url" class="form-control" id="in-url" placeholder="https://contoh.com">
                            </div>

                            {{-- Instagram --}}
                            <div id="field-instagram" class="field-group" style="display:none">
                                <div class="helper-box">
                                    <b>Instagram</b><br>
                                    Masukkan username Instagram kamu (tanpa @).<br>
                                    <b>Cara dapat:</b> Buka Instagram → tap foto profil → lihat nama di bawah foto.<br>
                                    <b>Contoh:</b> username_kamu
                                </div>
                                <label class="form-label fw-semibold">Username Instagram</label>
                                <div class="input-group">
                                    <span class="input-group-text">instagram.com/</span>
                                    <input type="text" class="form-control" id="in-instagram" placeholder="username_kamu">
                                </div>
                            </div>

                            {{-- WhatsApp --}}
                            <div id="field-whatsapp" class="field-group" style="display:none">
                                <div class="helper-box">
                                    <b>WhatsApp</b><br>
                                    Masukkan nomor WhatsApp aktif.<br>
                                    <b>Cara dapat:</b> Buka WhatsApp → tap nama profil → lihat nomor.<br>
                                    <b>Format:</b> Nomor internasional tanpa + (contoh: 628123456789 untuk Indonesia)
                                </div>
                                <label class="form-label fw-semibold">Nomor WhatsApp</label>
                                <input type="text" class="form-control" id="in-whatsapp" placeholder="628123456789">
                                <div class="form-text">Format internasional tanpa + &mdash; contoh Indonesia: 628123456789</div>
                            </div>

                            {{-- Email --}}
                            <div id="field-email" class="field-group" style="display:none">
                                <div class="helper-box">
                                    <b>Email</b><br>
                                    Masukkan alamat email tujuan.<br>
                                    Saat di-scan, HP akan membuka aplikasi email otomatis.<br>
                                    <b>Contoh:</b> nama@gmail.com
                                </div>
                                <label class="form-label fw-semibold">Alamat Email</label>
                                <input type="email" class="form-control" id="in-email" placeholder="contoh@gmail.com">
                            </div>

                            {{-- WiFi --}}
                            <div id="field-wifi" class="field-group" style="display:none">
                                <div class="helper-box">
                                    <b>WiFi</b><br>
                                    Isi nama dan password WiFi. Saat di-scan, HP langsung konek otomatis.<br>
                                    <b>Cara dapat nama WiFi:</b> Lihat di router atau pengaturan WiFi HP.<br>
                                    <b>Cara dapat password:</b> Lihat di stiker router atau tanya admin jaringan.
                                </div>
                                <label class="form-label fw-semibold">Nama WiFi (SSID)</label>
                                <input type="text" class="form-control mb-2" id="in-wifi-ssid" placeholder="Nama WiFi">
                                <label class="form-label fw-semibold">Password WiFi</label>
                                <input type="text" class="form-control mb-2" id="in-wifi-pass" placeholder="Password WiFi">
                                <label class="form-label fw-semibold">Enkripsi</label>
                                <select class="form-select" id="in-wifi-enc">
                                    <option value="WPA">WPA/WPA2 (paling umum)</option>
                                    <option value="WEP">WEP</option>
                                    <option value="nopass">Tanpa Password</option>
                                </select>
                            </div>

                            {{-- Teks --}}
                            <div id="field-text" class="field-group" style="display:none">
                                <div class="helper-box">
                                    <b>Teks Bebas</b><br>
                                    Masukkan teks apapun yang ingin di-encode ke QR.<br>
                                    <b>Contoh:</b> Pesan, alamat, catatan, kode promo, dll.
                                </div>
                                <label class="form-label fw-semibold">Teks</label>
                                <textarea class="form-control" id="in-text" rows="4" placeholder="Masukkan teks bebas..."></textarea>
                            </div>

                            {{-- Telepon --}}
                            <div id="field-phone" class="field-group" style="display:none">
                                <div class="helper-box">
                                    <b>Nomor Telepon</b><br>
                                    Pilih kode negara lalu masukkan nomor telepon.<br>
                                    Saat di-scan, HP akan langsung membuka aplikasi telepon.<br>
                                    <b>Contoh Indonesia:</b> +62 812-3456-789
                                </div>
                                <label class="form-label fw-semibold">Nomor Telepon</label>
                                <input type="tel" class="form-control" id="in-phone" placeholder="812-3456-789">
                                <div class="form-text">Pilih kode negara (+62, +1, dll) lalu isi nomor.</div>
                            </div>

                        </div>

                        <div class="d-grid mt-3" id="btn-generate" style="display:none !important">
                            <button type="submit" class="btn btn-dark">
                                <i class="bi bi-qr-code me-1"></i>Generate QR Code
                            </button>
                        </div>
                    </form>

                    {{-- FORM PAYMENT --}}
                    <form action="{{ route('payment.store') }}" method="POST"
                          id="paymentForm" enctype="multipart/form-data" style="display:none">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Platform / Bank</label>
                            <select class="form-select" name="platform" id="payment-platform" onchange="updatePaymentHelper()">
                                <optgroup label="E-Wallet">
                                    <option value="DANA">DANA</option>
                                    <option value="GoPay">GoPay</option>
                                    <option value="OVO">OVO</option>
                                    <option value="ShopeePay">ShopeePay</option>
                                    <option value="LinkAja">LinkAja</option>
                                </optgroup>
                                <optgroup label="Bank">
                                    <option value="BCA">BCA</option>
                                    <option value="BRI">BRI</option>
                                    <option value="BNI">BNI</option>
                                    <option value="Mandiri">Mandiri</option>
                                    <option value="BSI">BSI</option>
                                </optgroup>
                            </select>
                        </div>

                        <!-- Helper payment per platform -->
                        <div class="helper-box mb-3" id="payment-helper">
                            <!-- diisi JS -->
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-semibold">Nomor HP / Rekening</label>
                            <input type="text" class="form-control @error('nomor') is-invalid @enderror"
                                   name="nomor" value="{{ old('nomor') }}" placeholder="08123456789" required>
                            @error('nomor')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-semibold">Nama Pemilik</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                   name="nama" value="{{ old('nama') }}" placeholder="Nama lengkap" required>
                            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-semibold">Nominal <span class="text-muted fw-normal">(opsional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" name="nominal" value="{{ old('nominal') }}" placeholder="50000">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Upload QR dari App <span class="badge bg-dark ms-1">Wajib</span>
                            </label>
                            <input type="file" class="form-control @error('qr_image') is-invalid @enderror"
                                   name="qr_image" accept="image/jpg,image/jpeg,image/png" required>
                            @error('qr_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark">
                                <i class="bi bi-credit-card me-1"></i>Buat Kartu Payment
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        {{-- ===== KANAN: HASIL QR ===== --}}
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header-custom">
                    <i class="bi bi-qr-code me-2"></i>Hasil QR Code
                </div>
                <div class="card-body p-4">
                    <div id="qr-result-area">

                        @if(isset($generatedQr))
                        <div class="text-center w-100">
                            <div class="d-inline-block p-3 border rounded mb-3" style="background:white">
                                <div id="qr-svg-container">{!! $generatedQr !!}</div>
                            </div>
                            <table class="table table-sm table-bordered text-start mb-3">
                                <tr>
                                    <td class="fw-semibold" style="width:35%">Jenis</td>
                                    <td class="text-capitalize">{{ $qr_type }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Konten</td>
                                    <td style="word-break:break-all; font-size:0.85rem">{{ $qr_content }}</td>
                                </tr>
                            </table>
                            <div class="d-grid gap-2">
                                <button onclick="downloadQR('{{ $qr_type }}')" class="btn btn-dark">
                                    <i class="bi bi-download me-1"></i>Download QR Code (PNG)
                                </button>
                                <a href="{{ route('home') }}" class="btn btn-outline-dark">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i>Buat QR Baru
                                </a>
                            </div>
                            <div class="mt-3 p-3 bg-light rounded text-start">
                                <p class="fw-semibold small mb-1">Cara Scan QR:</p>
                                <ol class="small text-muted mb-0 ps-3">
                                    <li>Buka kamera HP</li>
                                    <li>Arahkan ke QR Code</li>
                                    <li>Tap notifikasi yang muncul</li>
                                </ol>
                            </div>
                        </div>
                        @else
                        <div class="text-center text-muted">
                            <i class="bi bi-qr-code" style="font-size:5rem; color:#ddd"></i>
                            <p class="mt-3 mb-1 fw-semibold">QR Code akan muncul di sini</p>
                            <p class="small">Pilih jenis QR dan isi form di sebelah kiri,<br>lalu klik Generate.</p>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- intl-tel-input JS -->
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // ===== intl-tel-input untuk nomor telepon =====
    const phoneInput = document.getElementById('in-phone');
    const iti = window.intlTelInput(phoneInput, {
        initialCountry: 'id',
        separateDialCode: true,
        utilsScript: 'https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js',
    });

    // ===== Helper teks per tipe payment =====
    const paymentHelpers = {
        DANA: `<b>DANA</b><br>
            <b>Cara dapat nomor:</b> Buka DANA → tap foto profil → lihat nomor HP terdaftar.<br>
            <b>Cara upload QR:</b> DANA → Minta Uang → QRIS → Screenshot QR → Upload di sini.`,
        GoPay: `<b>GoPay</b><br>
            <b>Cara dapat nomor:</b> Buka Gojek → GoPay → tap foto profil → lihat nomor.<br>
            <b>Cara upload QR:</b> Gojek → GoPay → Terima → Screenshot QR → Upload di sini.`,
        OVO: `<b>OVO</b><br>
            <b>Cara dapat nomor:</b> Buka OVO → tap foto profil → lihat nomor HP.<br>
            <b>Cara upload QR:</b> OVO → Minta → QR Code → Screenshot → Upload di sini.`,
        ShopeePay: `<b>ShopeePay</b><br>
            <b>Cara dapat nomor:</b> Buka Shopee → ShopeePay → Profil → lihat nomor.<br>
            <b>Cara upload QR:</b> ShopeePay → Terima → QR Code → Screenshot → Upload di sini.`,
        LinkAja: `<b>LinkAja</b><br>
            <b>Cara dapat nomor:</b> Buka LinkAja → tap profil → lihat nomor HP terdaftar.<br>
            <b>Cara upload QR:</b> LinkAja → Terima → QR → Screenshot → Upload di sini.`,
        BCA: `<b>BCA</b><br>
            <b>Cara dapat nomor rekening:</b> Buka BCA mobile → tap profil → lihat nomor rekening.<br>
            <b>Cara upload QR:</b> BCA mobile → Transfer → QRIS → Tampilkan QR → Screenshot → Upload.`,
        BRI: `<b>BRI</b><br>
            <b>Cara dapat nomor rekening:</b> Buka BRImo → tap profil → lihat nomor rekening.<br>
            <b>Cara upload QR:</b> BRImo → Terima → QRIS → Screenshot → Upload di sini.`,
        BNI: `<b>BNI</b><br>
            <b>Cara dapat nomor rekening:</b> Buka BNI Mobile → tap profil → lihat nomor rekening.<br>
            <b>Cara upload QR:</b> BNI Mobile → Terima → QR Code → Screenshot → Upload.`,
        Mandiri: `<b>Mandiri</b><br>
            <b>Cara dapat nomor rekening:</b> Buka Livin by Mandiri → tap profil → lihat nomor rekening.<br>
            <b>Cara upload QR:</b> Livin → Terima → QRIS → Screenshot → Upload di sini.`,
        BSI: `<b>BSI</b><br>
            <b>Cara dapat nomor rekening:</b> Buka BSI Mobile → tap profil → lihat nomor rekening.<br>
            <b>Cara upload QR:</b> BSI Mobile → Terima → QR Code → Screenshot → Upload.`,
    };

    function updatePaymentHelper() {
        const platform = document.getElementById('payment-platform').value;
        document.getElementById('payment-helper').innerHTML =
            paymentHelpers[platform] || 'Pilih platform untuk melihat panduan.';
    }

    // ===== Aktivasi tipe QR =====
    const typeGrid    = document.getElementById('typeGrid');
    const qrForm      = document.getElementById('qrForm');
    const paymentForm = document.getElementById('paymentForm');
    const btnGenerate = document.getElementById('btn-generate');

    @if(isset($qr_type))
    activateType('{{ $qr_type }}');
    @endif

    typeGrid.querySelectorAll('.type-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            activateType(this.dataset.type);
        });
    });

    function activateType(type) {
        // Tandai tombol aktif — TIDAK hapus icon, hanya tambah border
        typeGrid.querySelectorAll('.type-btn').forEach(b => b.classList.remove('active'));
        const activeBtn = typeGrid.querySelector('[data-type="' + type + '"]');
        if (activeBtn) activeBtn.classList.add('active');

        // Sembunyikan semua field
        document.querySelectorAll('.field-group').forEach(f => f.style.display = 'none');

        if (type === 'payment') {
            qrForm.style.display      = 'none';
            paymentForm.style.display = 'block';
            btnGenerate.style.display = 'none';
            updatePaymentHelper(); // tampilkan helper DANA default
        } else {
            qrForm.style.display      = 'block';
            paymentForm.style.display = 'none';
            btnGenerate.style.display = 'block';
            const field = document.getElementById('field-' + type);
            if (field) field.style.display = 'block';
            document.getElementById('hidden_type').value = type;
        }
    }

    // ===== Submit form biasa =====
    qrForm.addEventListener('submit', function(e) {
        const type = document.getElementById('hidden_type').value;
        let content = '';

        if (type === 'url') {
            content = document.getElementById('in-url').value.trim();
        } else if (type === 'instagram') {
            content = 'https://instagram.com/' + document.getElementById('in-instagram').value.trim();
        } else if (type === 'whatsapp') {
            content = 'https://wa.me/' + document.getElementById('in-whatsapp').value.trim();
        } else if (type === 'email') {
            content = 'mailto:' + document.getElementById('in-email').value.trim();
        } else if (type === 'wifi') {
            const ssid = document.getElementById('in-wifi-ssid').value.trim();
            const pass = document.getElementById('in-wifi-pass').value.trim();
            const enc  = document.getElementById('in-wifi-enc').value;
            content = `WIFI:T:${enc};S:${ssid};P:${pass};;`;
        } else if (type === 'text') {
            content = document.getElementById('in-text').value.trim();
        } else if (type === 'phone') {
            // Ambil nomor lengkap dengan kode negara dari intl-tel-input
            content = 'tel:' + iti.getNumber();
        }

        if (!content || content === 'tel:') {
            e.preventDefault();
            alert('Harap isi konten QR Code terlebih dahulu!');
            return;
        }
        document.getElementById('hidden_content').value = content;
    });

    // ===== Download QR =====
    function downloadQR(type) {
        const svgEl = document.querySelector('#qr-svg-container svg');
        if (!svgEl) { alert('QR tidak ditemukan!'); return; }

        const clone = svgEl.cloneNode(true);
        clone.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
        const rect = document.createElementNS('http://www.w3.org/2000/svg', 'rect');
        rect.setAttribute('width', '100%');
        rect.setAttribute('height', '100%');
        rect.setAttribute('fill', 'white');
        clone.insertBefore(rect, clone.firstChild);

        const url = URL.createObjectURL(new Blob([new XMLSerializer().serializeToString(clone)], { type: 'image/svg+xml' }));
        const img = new Image();
        img.onload = function() {
            const canvas = document.createElement('canvas');
            canvas.width = 400; canvas.height = 400;
            const ctx = canvas.getContext('2d');
            ctx.fillStyle = 'white';
            ctx.fillRect(0, 0, 400, 400);
            ctx.drawImage(img, 0, 0, 400, 400);
            const link = document.createElement('a');
            link.download = 'qrcode-' + type + '.png';
            link.href = canvas.toDataURL('image/png');
            link.click();
            URL.revokeObjectURL(url);
        };
        img.src = url;
    }
</script>
</body>
</html>
