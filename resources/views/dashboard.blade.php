<x-app-layout>
    <x-slot name="header">
        <h1 class="page-title">
            <i class="bi bi-house me-2 text-success"></i>Dashboard
        </h1>
    </x-slot>

    @php
        $totalQr = Auth::user()->qrCodeGenerators()->count();
        $todayQr = Auth::user()->qrCodeGenerators()->whereDate('created_at', today())->count();
        $latestQr = Auth::user()->qrCodeGenerators()->latest()->take(5)->get();
    @endphp

    <!-- Stats -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card text-center p-3">
                <i class="bi bi-qr-code-scan text-success mb-2" style="font-size: 2rem"></i>
                <h3 class="fw-bold text-success">{{ $totalQr }}</h3>
                <p class="text-muted mb-0 small">Total QR Dibuat</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center p-3">
                <i class="bi bi-calendar-check text-primary mb-2" style="font-size: 2rem"></i>
                <h3 class="fw-bold text-primary">{{ $todayQr }}</h3>
                <p class="text-muted mb-0 small">QR Hari Ini</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center p-3">
                <i class="bi bi-person-circle text-warning mb-2" style="font-size: 2rem"></i>
                <p class="fw-bold mb-0">{{ Auth::user()->name }}</p>
                <p class="text-muted mb-0 small">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <!-- Aksi Cepat -->
        <div class="col-md-4">
            <div class="card p-3">
                <h6 class="fw-bold mb-3">
                    <i class="bi bi-lightning-charge text-warning me-1"></i>Aksi Cepat
                </h6>
                <div class="d-grid gap-2">
                    <a href="{{ route('qr_codes.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle me-1"></i>Buat QR Code Baru
                    </a>
                    <a href="{{ route('qr_codes.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-clock-history me-1"></i>Lihat History
                    </a>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-person-gear me-1"></i>Edit Profil
                    </a>
                </div>
            </div>
        </div>

        <!-- QR Terbaru -->
        <div class="col-md-8">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0">
                        <i class="bi bi-clock-history text-success me-1"></i>QR Terbaru
                    </h6>
                    <a href="{{ route('qr_codes.index') }}" class="small text-success">Lihat semua →</a>
                </div>

                @forelse($latestQr as $qr)
                <div class="d-flex align-items-center border-bottom py-2 gap-3">
                    <div>
                        @php
                            $icons = ['url'=>'link-45deg','instagram'=>'instagram','whatsapp'=>'whatsapp','email'=>'envelope','wifi'=>'wifi','payment'=>'credit-card','text'=>'chat-text','phone'=>'telephone'];
                            $icon = $icons[$qr->qr_type] ?? 'qr-code';
                        @endphp
                        <i class="bi bi-{{ $icon }} text-success" style="font-size: 1.3rem"></i>
                    </div>
                    <div class="flex-grow-1 overflow-hidden">
                        <div class="fw-semibold text-capitalize small">{{ $qr->qr_type }}</div>
                        <div class="text-muted small text-truncate">{{ $qr->qr_content }}</div>
                    </div>
                    <div class="text-muted small">{{ $qr->created_at->diffForHumans() }}</div>
                </div>
                @empty
                <div class="text-center py-4">
                    <i class="bi bi-qr-code text-muted" style="font-size: 2.5rem"></i>
                    <p class="text-muted mt-2 small">Belum ada QR Code dibuat</p>
                    <a href="{{ route('qr_codes.create') }}" class="btn btn-success btn-sm">Buat Sekarang</a>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
