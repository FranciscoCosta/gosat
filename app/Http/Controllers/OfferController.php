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
        if (empty($cpf)) {
            return response()->json(['message' => 'CPF not found.'], 422);
        }
        
        $response = Http::post('https://dev.gosat.org/api/v1/simulacao/credito', [
            'cpf' => $cpf
        ]);
        $institutions = $response->json()['instituicoes'];


        // iterate over the institutions and modalities so we can save a new offer for each one
        foreach ($institutions as $institution) {
            $institutionId = $institution['id'];
            $institutionName = $institution['nome'];
            $modalities = $institution['modalidades'];

            foreach ($modalities as $modality) {
                $nameModal = $modality['nome'];
                $cod = $modality['cod'];
                
                // check if the offer already exists
                $existingOffer = Offer::where([
                    'cpf' => $cpf,
                    'institution_id' => $institutionId,
                    'name_modal' => $nameModal,
                    'cod' => $cod,
                ])->first();
                
                // if it doesn't exist, create a new one
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

    public function getOffers(Request $request)
    {
        $cpf = $request->input('cpf');
        if (empty($cpf)) {
            return response()->json(['message' => 'CPF not found.'], 422);
        }
        
        $response = Http::post('https://dev.gosat.org/api/v1/simulacao/credito', [
            'cpf' => $cpf
        ]);
        $institutions = $response->json()['instituicoes'];


        // iterate over the institutions and modalities so we can save a new offer for each one
        foreach ($institutions as $institution) {
            $institutionId = $institution['id'];
            $institutionName = $institution['nome'];
            $modalities = $institution['modalidades'];

            foreach ($modalities as $modality) {
                $nameModal = $modality['nome'];
                $cod = $modality['cod'];

                echo($institutionId);
                echo($cod);
                $detailsOffer = Http::post('https://dev.gosat.org/api/v1/simulacao/oferta', [
                    'cpf' => $cpf,
                    'instituicao' => $institutionId,
                    'modalidade' => $cod
                ]);

                $details = $detailsOffer->json();
                return dd($details);
                
                // check if the offer already exists
                $existingOffer = Offer::where([
                    'cpf' => $cpf,
                    'institution_id' => $institutionId,
                    'name_modal' => $nameModal,
                    'cod' => $cod,
                ])->first();
                
                // if it doesn't exist, create a new one
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

        $offers = Offer::where('cpf', $cpf)->get();

        return view('welcome', compact('offers'));
    }
}
