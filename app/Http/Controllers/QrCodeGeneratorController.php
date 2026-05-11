<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QrCodeGenerator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;

class QrCodeGeneratorController extends Controller
{
    public function index()
    {
        $qrCodes = QrCodeGenerator::latest()->get();
        $visitCount = DB::table('page_visits')->value('count');
        return view('qr_codes.index', compact('qrCodes', 'visitCount'));
    }

    public function create()
    {
        // Tambah counter kunjungan
        DB::table('page_visits')->update(['count' => DB::raw('count + 1')]);
        $visitCount = DB::table('page_visits')->value('count');
        return view('qr_codes.create', compact('visitCount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'qr_type'    => 'required|string',
            'qr_content' => 'required|string|max:2000',
        ]);

        $qr = QrCodeGenerator::create([
            'qr_type'    => $request->qr_type,
            'qr_content' => $request->qr_content,
            'qr_image'   => null,
        ]);

        $generatedQr = QrCode::size(300)->generate($request->qr_content);

        return view('qr_codes.result', compact('generatedQr', 'qr'));
    }

    public function show($id)
    {
        $qr = QrCodeGenerator::findOrFail($id);
        $generatedQr = QrCode::size(300)->generate($qr->qr_content);
        return view('qr_codes.result', compact('generatedQr', 'qr'));
    }

    public function destroy($id)
    {
        QrCodeGenerator::findOrFail($id)->delete();
        return redirect()->route('qr_codes.index')->with('success', 'QR Code berhasil dihapus!');
    }
}
