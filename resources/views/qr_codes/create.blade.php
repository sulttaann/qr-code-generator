<x-app-layout>
    <x-slot name="header">
        <h1 class="page-title">
            <i class="bi bi-plus-circle text-success me-2"></i>Buat QR Code
        </h1>
    </x-slot>

    <div class="row g-4 justify-content-center">

        <!-- Form Card -->
        <div class="col-md-6">
            <div class="card p-4">
                <h6 class="fw-bold mb-1">Form Generate QR</h6>
                <p class="text-muted small mb-3">Pilih tipe lalu isi konten QR Code kamu</p>

                <!-- Pilih Tipe -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tipe QR Code</label>
                    <select id="qr_type" class="form-select">
                        <option value="">-- Pilih Tipe QR --</option>
                        <option value="url">Website / URL</option>
                        <option value="instagram">Instagram</option>
                        <option value="whatsapp">WhatsApp</option>
                        <option value="email">Email</option>
                        <option value="wifi">WiFi</option>
                        <option value="payment">Payment (Profil Rekening)</option>
                        <option value="text">Teks Bebas</option>
                        <option value="phone">Nomor Telepon</option>
                    </select>
                </div>

                <!-- Helper Box -->
                <div id="helper-box" class="alert alert-info small mb-3" style="display:none">
                    <div id="helper-text"></div>
                </div>

                {{-- ============================================================
                     FORM 1: Untuk semua tipe KECUALI payment
                     ============================================================ --}}
                <form action="{{ route('qr_codes.store') }}" method="POST" id="qrForm">
                    @csrf
                    <input type="hidden" name="qr_type"    id="hidden_qr_type">
                    <input type="hidden" name="qr_content" id="qr_content">

                    <div id="dynamic-fields" style="display:none">

                        <!-- URL -->
                        <div id="field-url" class="field-group" style="display:none">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">URL Website</label>
                                <input type="url" class="form-control" id="input-url" placeholder="https://contoh.com">
                            </div>
                        </div>

                        <!-- Instagram -->
                        <div id="field-instagram" class="field-group" style="display:none">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Username Instagram</label>
                                <div class="input-group">
                                    <span class="input-group-text">instagram.com/</span>
                                    <input type="text" class="form-control" id="input-instagram" placeholder="username_kamu">
                                </div>
                            </div>
                        </div>

                        <!-- WhatsApp -->
                        <div id="field-whatsapp" class="field-group" style="display:none">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nomor WhatsApp</label>
                                <input type="text" class="form-control" id="input-whatsapp" placeholder="628123456789">
                                <div class="form-text">Format internasional tanpa + (contoh: 628123456789)</div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div id="field-email" class="field-group" style="display:none">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Alamat Email</label>
                                <input type="email" class="form-control" id="input-email" placeholder="contoh@gmail.com">
                            </div>
                        </div>

                        <!-- WiFi -->
                        <div id="field-wifi" class="field-group" style="display:none">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama WiFi (SSID)</label>
                                <input type="text" class="form-control" id="input-wifi-ssid" placeholder="Nama WiFi kamu">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Password WiFi</label>
                                <input type="text" class="form-control" id="input-wifi-pass" placeholder="Password WiFi">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Enkripsi</label>
                                <select class="form-select" id="input-wifi-enc">
                                    <option value="WPA">WPA/WPA2</option>
                                    <option value="WEP">WEP</option>
                                    <option value="nopass">Tanpa Password</option>
                                </select>
                            </div>
                        </div>

                        <!-- Text -->
                        <div id="field-text" class="field-group" style="display:none">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Teks</label>
                                <textarea class="form-control" id="input-text" rows="4" placeholder="Masukkan teks bebas di sini..."></textarea>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div id="field-phone" class="field-group" style="display:none">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nomor Telepon</label>
                                <input type="tel" class="form-control" id="input-phone" placeholder="+628123456789">
                            </div>
                        </div>

                    </div>

                    <div class="d-grid" id="btn-submit-wrapper" style="display:none !important">
                        <button type="submit" class="btn btn-success" id="submitBtn">
                            <i class="bi bi-qr-code me-1"></i>Generate QR Code
                        </button>
                    </div>
                </form>

                {{-- ============================================================
                     FORM 2: Khusus Payment — pakai enctype multipart (untuk upload file)
                     ============================================================ --}}
                <form action="{{ route('payment.store') }}" method="POST"
                      id="paymentForm" enctype="multipart/form-data" style="display:none">
                    @csrf

                    <div class="alert alert-info small py-2 mb-3">
                        <i class="bi bi-info-circle me-1"></i>
                        QR ini akan membuka <strong>halaman profil pembayaran</strong> kamu.
                        Orang scan QR → lihat info rekening + QR resmi kamu → bisa langsung bayar.
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Platform / Bank</label>
                        <select class="form-select" name="platform">
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

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nomor HP / Rekening</label>
                        <input type="text" class="form-control @error('nomor') is-invalid @enderror"
                               name="nomor" value="{{ old('nomor') }}" placeholder="08123456789" required>
                        @error('nomor') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Pemilik</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                               name="nama" value="{{ old('nama') }}" placeholder="Nama lengkap kamu" required>
                        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Nominal <span class="text-muted fw-normal">(opsional)</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" name="nominal"
                                   value="{{ old('nominal') }}" placeholder="50000">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Upload QR dari App Wallet
                            <span class="badge bg-success ms-1">Wajib</span>
                        </label>
                        <input type="file" class="form-control @error('qr_image') is-invalid @enderror"
                               name="qr_image" accept="image/jpg,image/jpeg,image/png" required>
                        <div class="form-text">Screenshot QR dari DANA/GoPay/OVO. Format JPG/PNG, maks 2MB.</div>
                        @error('qr_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-qr-code me-1"></i>Generate QR Payment
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <!-- Tips & Preview -->
        <div class="col-md-4">
            <div class="card p-3 text-center mb-3">
                <h6 class="fw-bold mb-3">Preview Tipe QR</h6>
                <div id="preview-placeholder">
                    <i class="bi bi-qr-code text-muted" style="font-size: 4rem"></i>
                    <p class="text-muted small mt-2">Pilih tipe QR untuk melihat info</p>
                </div>
                <div id="preview-info" style="display:none">
                    <div class="p-3 bg-light rounded mb-2">
                        <div id="preview-type-icon" style="font-size: 2.5rem"></div>
                        <div id="preview-type-name" class="fw-bold text-success mt-1"></div>
                        <div id="preview-content-preview" class="text-muted small text-truncate mt-1"></div>
                    </div>
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>Bisa di-scan dengan kamera HP
                    </small>
                </div>
            </div>

            <div class="card p-3">
                <h6 class="fw-bold mb-2">
                    <i class="bi bi-lightbulb text-warning me-1"></i>Tips
                </h6>

                <!-- Tips umum -->
                <ul class="list-unstyled small text-muted mb-0" id="tips-general">
                    <li class="mb-1"><i class="bi bi-check-circle text-success me-1"></i>QR bisa di-scan kamera HP langsung</li>
                    <li class="mb-1"><i class="bi bi-check-circle text-success me-1"></i>Download QR untuk disimpan/dicetak</li>
                    <li class="mb-1"><i class="bi bi-check-circle text-success me-1"></i>QR WiFi untuk berbagi password WiFi</li>
                    <li><i class="bi bi-check-circle text-success me-1"></i>QR Payment untuk terima pembayaran</li>
                </ul>

                <!-- Tips khusus payment -->
                <div id="tips-payment" style="display:none">
                    <p class="fw-semibold small mb-2">
                        <i class="bi bi-camera text-success me-1"></i>Cara ambil QR dari app wallet:
                    </p>
                    <div class="mb-2">
                        <p class="small fw-semibold mb-1">📱 DANA:</p>
                        <ol class="small text-muted ps-3 mb-0">
                            <li>Buka DANA → Minta Uang</li>
                            <li>Tap <strong>QRIS</strong></li>
                            <li>Screenshot gambar QR</li>
                            <li>Upload di form ini</li>
                        </ol>
                    </div>
                    <div class="mb-2">
                        <p class="small fw-semibold mb-1">📱 GoPay:</p>
                        <ol class="small text-muted ps-3 mb-0">
                            <li>Buka Gojek → GoPay</li>
                            <li>Tap <strong>Terima</strong></li>
                            <li>Screenshot QR yang muncul</li>
                            <li>Upload di form ini</li>
                        </ol>
                    </div>
                    <div class="mb-2">
                        <p class="small fw-semibold mb-1">📱 OVO:</p>
                        <ol class="small text-muted ps-3 mb-0">
                            <li>Buka OVO → Minta</li>
                            <li>Pilih <strong>QR Code</strong></li>
                            <li>Screenshot QR</li>
                            <li>Upload di form ini</li>
                        </ol>
                    </div>
                    <div class="alert alert-warning small py-2 mb-0 mt-2">
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        Pastikan QR terlihat jelas dan tidak terpotong!
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const qrTypeSelect   = document.getElementById('qr_type');
        const dynamicFields  = document.getElementById('dynamic-fields');
        const helperBox      = document.getElementById('helper-box');
        const helperText     = document.getElementById('helper-text');
        const qrForm         = document.getElementById('qrForm');
        const paymentForm    = document.getElementById('paymentForm');
        const submitWrapper  = document.getElementById('btn-submit-wrapper');
        const qrContentInput = document.getElementById('qr_content');
        const hiddenQrType   = document.getElementById('hidden_qr_type');

        const previewPlaceholder   = document.getElementById('preview-placeholder');
        const previewInfo          = document.getElementById('preview-info');
        const previewTypeIcon      = document.getElementById('preview-type-icon');
        const previewTypeName      = document.getElementById('preview-type-name');
        const previewContentPreview = document.getElementById('preview-content-preview');

        const helpers = {
            url:       '<b>Website URL</b><br>Masukkan URL lengkap. Contoh: https://google.com',
            instagram: '<b>Instagram</b><br>Masukkan username Instagram kamu.',
            whatsapp:  '<b>WhatsApp</b><br>Nomor format internasional tanpa +. Contoh: 628123456789',
            email:     '<b>Email</b><br>Masukkan alamat email tujuan.',
            wifi:      '<b>WiFi</b><br>Isi nama WiFi dan password. Scan QR untuk konek otomatis!',
            payment:   '<b>💳 Payment</b><br>Isi info rekening + upload QR dari app wallet kamu. Scan QR → buka halaman profil → orang bisa langsung bayar.',
            text:      '<b>Teks Bebas</b><br>Masukkan teks apapun.',
            phone:     '<b>Telepon</b><br>Masukkan nomor telepon lengkap. Contoh: +628123456789',
        };

        const typeIcons = { url:'🌐', instagram:'📸', whatsapp:'💬', email:'📧', wifi:'📶', payment:'💳', text:'📝', phone:'📞' };
        const typeNames = { url:'Website URL', instagram:'Instagram', whatsapp:'WhatsApp', email:'Email', wifi:'WiFi', payment:'Payment', text:'Teks', phone:'Telepon' };

        qrTypeSelect.addEventListener('change', function () {
            const val = this.value;

            // Sembunyikan semua field
            document.querySelectorAll('.field-group').forEach(f => f.style.display = 'none');
            dynamicFields.style.display  = 'none';
            qrForm.style.display         = 'none';
            paymentForm.style.display    = 'none';
            submitWrapper.style.display  = 'none';
            helperBox.style.display      = 'none';
            previewPlaceholder.style.display = 'block';
            previewInfo.style.display        = 'none';

            // Toggle tips
            document.getElementById('tips-general').style.display = val === 'payment' ? 'none' : 'block';
            document.getElementById('tips-payment').style.display = val === 'payment' ? 'block' : 'none';

            if (!val) return;

            // Tampilkan helper
            helperBox.style.display = 'block';
            helperText.innerHTML    = helpers[val] || '';

            // Update preview
            previewPlaceholder.style.display = 'none';
            previewInfo.style.display        = 'block';
            previewTypeIcon.textContent      = typeIcons[val] || '📱';
            previewTypeName.textContent      = typeNames[val] || val;
            previewContentPreview.textContent = 'Isi form untuk preview...';

            if (val === 'payment') {
                // Tampilkan form payment terpisah
                paymentForm.style.display = 'block';
            } else {
                // Tampilkan form biasa
                qrForm.style.display     = 'block';
                dynamicFields.style.display = 'block';
                submitWrapper.style.display = 'block';
                const field = document.getElementById('field-' + val);
                if (field) field.style.display = 'block';
                hiddenQrType.value = val;
            }
        });

        // Submit form biasa — build qr_content sebelum kirim
        qrForm.addEventListener('submit', function (e) {
            const type = qrTypeSelect.value;
            let content = '';

            if (type === 'url') {
                content = document.getElementById('input-url').value;
            } else if (type === 'instagram') {
                content = 'https://instagram.com/' + document.getElementById('input-instagram').value;
            } else if (type === 'whatsapp') {
                content = 'https://wa.me/' + document.getElementById('input-whatsapp').value;
            } else if (type === 'email') {
                content = 'mailto:' + document.getElementById('input-email').value;
            } else if (type === 'wifi') {
                const ssid = document.getElementById('input-wifi-ssid').value;
                const pass = document.getElementById('input-wifi-pass').value;
                const enc  = document.getElementById('input-wifi-enc').value;
                content = `WIFI:T:${enc};S:${ssid};P:${pass};;`;
            } else if (type === 'text') {
                content = document.getElementById('input-text').value;
            } else if (type === 'phone') {
                content = 'tel:' + document.getElementById('input-phone').value;
            }

            if (!content.trim()) {
                e.preventDefault();
                alert('Harap isi konten QR Code terlebih dahulu!');
                return;
            }
            qrContentInput.value = content;
        });

        // Live preview
        document.addEventListener('input', function () {
            const type = qrTypeSelect.value;
            if (!type) return;
            let preview = '';
            if (type === 'url')            preview = document.getElementById('input-url')?.value;
            else if (type === 'instagram') preview = 'instagram.com/' + (document.getElementById('input-instagram')?.value || '');
            else if (type === 'whatsapp')  preview = 'wa.me/' + (document.getElementById('input-whatsapp')?.value || '');
            else if (type === 'email')     preview = document.getElementById('input-email')?.value;
            else if (type === 'wifi')      preview = (document.getElementById('input-wifi-ssid')?.value || '') + ' (WiFi)';
            else if (type === 'text')      preview = document.getElementById('input-text')?.value;
            else if (type === 'phone')     preview = document.getElementById('input-phone')?.value;
            if (preview) previewContentPreview.textContent = preview;
        });
    </script>
</x-app-layout>
