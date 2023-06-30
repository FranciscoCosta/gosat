<?php

namespace App\Http\Controllers;

use App\Models\Offer;
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
        $institutions = $response->json()['instituicoes'];

        foreach ($institutions as $institution) {
            $institutionId = $institution['id'];
            $institutionName = $institution['nome'];
            $modalities = $institution['modalidades'];

            foreach ($modalities as $modality) {
                $nameModal = $modality['nome'];
                $cod = $modality['cod'];

                $existingOffer = Offer::where([
                    'cpf' => $cpf,
                    'institution_id' => $institutionId,
                    'name_modal' => $nameModal,
                    'cod' => $cod,
                ])->first();

                if (!$existingOffer) {
                    Offer::create([
                        'cpf' => $cpf,
                        'institution' => $institutionName,
                        'institution_id' => $institutionId,
                        'name_modal' => $nameModal,
                        'cod' => $cod,
                    ]);
                }
            }
        }

        return response()->json(['offers' => $institutions], 200);
    }
}
