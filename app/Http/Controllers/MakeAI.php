<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use thiagoalessio\TesseractOCR\TesseractOCR;
use PhpOffice\PhpWord\IOFactory;
use Mews\Purifier\Facades\Purifier;
use SimpleSoftwareIO\QrCode;


class MakeAI extends Controller
{
    public function generate()
    {
        // AI to generate random person photo but ssl error
        /* $curl = 'https://thispersondoesnotexist.com/image';
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $response = Http::get($curl);
        $image = $response->body();

        return response($image)->header('Content-Type', 'image/jpeg'); */

        //read photo
        // Get the uploaded image file
        //$image = $request->file('image');

    }
    public function GetTexte()
    {
        //$imagePath = public_path('img/testar.jpg');
        $imagePath = public_path('img/tstcode.jpg');


        $text = (new TesseractOCR($imagePath))
                ->lang('eng')
                ->run();

                //$string = "Ignorance is bliss-You're better-off not knowing";
                $token = "PSD-";

                $result = "";
                $index = strpos($text, $token);
                if ($index !== false) {
                    $result = substr($text, $index + strlen($token));
                }
                $extractedChars = substr($result, 0, 18);

        return response()->json([
            /* 'text' => $text, */
            'code' => $extractedChars
        ]);
    }

    public function ReadCode()
    {
        // Load the image file
       $image = file_get_contents('img/qrcode.png');

       $result = QrCode::scan('barcode.jpg');


       dd($result);

    }

}
