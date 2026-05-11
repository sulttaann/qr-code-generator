<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;

class QrCodeGeneratorController extends Controller
{
    public function index()
    {
        // Tambah counter kunjungan
        DB::table('page_visits')->update(['count' => DB::raw('count + 1')]);
        $visitCount = DB::table('page_visits')->value('count');

        return view('home', compact('visitCount'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'qr_type'    => 'required|string',
            'qr_content' => 'required|string|max:2000',
        ]);

        // Generate QR sebagai SVG string
        $generatedQr = QrCode::size(280)->generate($request->qr_content);

        DB::table('page_visits')->update(['count' => DB::raw('count + 1')]);
        $visitCount = DB::table('page_visits')->value('count');

        return view('home', [
            'visitCount'  => $visitCount,
            'generatedQr' => $generatedQr,
            'qr_type'     => $request->qr_type,
            'qr_content'  => $request->qr_content,
        ]);
    }
}
