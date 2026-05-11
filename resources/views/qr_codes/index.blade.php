<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="page-title">
                <i class="bi bi-clock-history text-success me-2"></i>History QR Code
            </h1>
            <a href="{{ route('qr_codes.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle me-1"></i>Buat QR Baru
            </a>
        </div>
    </x-slot>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
        <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Total -->
    <p class="text-muted small mb-3">
        Total: <strong>{{ $qrCodes->count() }}</strong> QR Code
    </p>

    @forelse($qrCodes as $qr)
    @php
        $icons = ['url'=>'link-45deg','instagram'=>'instagram','whatsapp'=>'whatsapp','email'=>'envelope','wifi'=>'wifi','payment'=>'credit-card','text'=>'chat-text','phone'=>'telephone'];
        $icon = $icons[$qr->qr_type] ?? 'qr-code';
    @endphp

    <div class="card mb-2">
        <div class="card-body py-3">
            <div class="row align-items-center g-2">
                <!-- Icon -->
                <div class="col-auto">
                    <i class="bi bi-{{ $icon }} text-success" style="font-size: 1.5rem"></i>
                </div>

                <!-- Info -->
                <div class="col">
                    <div class="fw-semibold text-capitalize">{{ $qr->qr_type }}</div>
                    <div class="text-muted small text-truncate" style="max-width: 400px">{{ $qr->qr_content }}</div>
                    <div class="text-muted" style="font-size: 0.75rem">
                        <i class="bi bi-clock me-1"></i>{{ $qr->created_at->format('d M Y, H:i') }}
                    </div>
                </div>

                <!-- Tombol -->
                <div class="col-auto d-flex gap-2">
                    <a href="{{ route('qr_codes.show', $qr->id) }}" class="btn btn-sm btn-outline-success">
                        <i class="bi bi-eye me-1"></i>Lihat
                    </a>
                    <form action="{{ route('qr_codes.destroy', $qr->id) }}" method="POST"
                          onsubmit="return confirm('Hapus QR Code ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash me-1"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @empty
    <div class="card p-5 text-center">
        <i class="bi bi-qr-code text-muted" style="font-size: 3rem"></i>
        <h6 class="mt-3 text-muted">Belum Ada QR Code</h6>
        <p class="text-muted small">Kamu belum membuat QR Code apapun.</p>
        <div>
            <a href="{{ route('qr_codes.create') }}" class="btn btn-success btn-sm">
                <i class="bi bi-plus-circle me-1"></i>Buat QR Code Pertama
            </a>
        </div>
    </div>
    @endforelse

</x-app-layout>
