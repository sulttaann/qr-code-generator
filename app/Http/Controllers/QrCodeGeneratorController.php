<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QrCodeGenerator;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeGeneratorController extends Controller
{
    public function index()
    {
        $qrCodes = Auth::user()->qrCodeGenerators()->latest()->get();
        return view('qr_codes.index', compact('qrCodes'));
    }

    public function create()
    {
        return view('qr_codes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'qr_type'    => 'required|string',
            'qr_content' => 'required|string|max:2000',
        ]);

        $qr = QrCodeGenerator::create([
            'user_id'    => Auth::id(),
            'qr_type'    => $request->qr_type,
            'qr_content' => $request->qr_content,
            'qr_image'   => null,
        ]);

        $generatedQr = QrCode::size(300)->generate($request->qr_content);

        return view('qr_codes.result', compact('generatedQr', 'qr'));
    }

    public function show($id)
    {
        $qr = QrCodeGenerator::where('user_id', Auth::id())->findOrFail($id);
        $generatedQr = QrCode::size(300)->generate($qr->qr_content);
        return view('qr_codes.result', compact('generatedQr', 'qr'));
    }

    public function destroy($id)
    {
        $qr = QrCodeGenerator::where('user_id', Auth::id())->findOrFail($id);
        $qr->delete();
        return redirect()->route('qr_codes.index')->with('success', 'QR Code berhasil dihapus!');
    }
}
