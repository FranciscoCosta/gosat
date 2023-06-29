<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        $cpf = $request->input('cpf');
        $response = Http::post('https://dev.gosat.org/api/v1/simulacao/credito', [
            'cpf' => $cpf
        ]);
        return response()->json(['institution' => $response], 200);
    }
    // {
    // [
    //     'cpf' => $cpf,
    // ]);
    // return $response->json();
    //     dd($response->json());
    // }

}
