<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentProfile;
use App\Models\QrCodeGenerator;
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

        $path = $request->file('qr_image')->store('payment-qr', 'public');
        $slug = Str::slug($request->nama) . '-' . Str::lower($request->platform) . '-' . Str::random(5);

        $profile = PaymentProfile::create([
            'slug'     => $slug,
            'platform' => $request->platform,
            'nomor'    => $request->nomor,
            'nama'     => $request->nama,
            'nominal'  => $request->nominal ?: null,
            'qr_image' => $path,
        ]);

        // Simpan ke history
        QrCodeGenerator::create([
            'qr_type'    => 'payment',
            'qr_content' => $request->platform . ' - ' . $request->nomor . ' (' . $request->nama . ')',
            'qr_image'   => null,
        ]);

        return view('payment.result', compact('profile'));
    }
}
