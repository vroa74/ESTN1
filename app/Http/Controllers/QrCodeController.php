<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;

class QrCodeController extends Controller
{
    public function index()
    {
        return view('pages/qr');
    }

    public function generate(Request $request)
    {
        $data = $request->input('data', 'https://laravel.com');
        
        // Crear el código QR con todos los parámetros en el constructor
        $qrCode = new QrCode(
            data: $data,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            size: 300,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin
        );

        // Crear el writer y generar la imagen
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // Retornar la imagen como base64
        return response()->json([
            'qr' => base64_encode($result->getString())
        ]);
    }
}
