<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentProfile;
use App\Models\QrCodeGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PaymentProfileController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'platform' => 'required|string',
            'nomor'    => 'required|string|max:50',
            'nama'     => 'required|string|max:100',
            'nominal'  => 'nullable|integer|min:0',
            'qr_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload gambar QR resmi dari user
        $path = $request->file('qr_image')->store('payment-qr', 'public');

        // Buat slug unik
        $slug = Str::slug($request->nama) . '-' . Str::lower($request->platform) . '-' . Str::random(5);

        // Simpan profil payment
        $profile = PaymentProfile::create([
            'user_id'  => Auth::id(),
            'slug'     => $slug,
            'platform' => $request->platform,
            'nomor'    => $request->nomor,
            'nama'     => $request->nama,
            'nominal'  => $request->nominal ?: null,
            'qr_image' => $path,
        ]);

        // Simpan juga ke history qr_code_generators
        QrCodeGenerator::create([
            'user_id'    => Auth::id(),
            'qr_type'    => 'payment',
            'qr_content' => $request->platform . ' - ' . $request->nomor . ' (' . $request->nama . ')',
            'qr_image'   => null,
        ]);

        // Tampilkan halaman kartu payment
        return view('payment.result', compact('profile'));
    }
}
