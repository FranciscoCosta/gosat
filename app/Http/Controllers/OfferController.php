<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OfferController extends Controller
{
    public function offersByCpf(Request $request)
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

    public function offerDetails(Request $request)
    {
        $cpf = $request->input('cpf');
        $institutionId = $request->input('instituicao_id');

        $cod = $request->input('codModalidade');
        if (empty($cpf)) {
            return response()->json(['message' => 'CPF not found.'], 422);
        }
        if (empty($institutionId)) {
            return response()->json(['message' => 'Institution ID not found.'], 422);
        }
        if (empty($cod)) {
            return response()->json(['message' => 'Cod not found.'], 422);
        }

        $detailsOffer = Http::post('https://dev.gosat.org/api/v1/simulacao/oferta', [
            'cpf' => $cpf,
            'instituicao_id' => $institutionId,
            'codModalidade' => $cod
        ]);

        

        $details = $detailsOffer->json();

        $PMedium = ($details["QntParcelaMin"] + $details["QntParcelaMax"]) / 2;
        $ValueAsked = ($details["valorMin"] + $details["valorMax"]) / 2;
        $ValueToPay = $ValueAsked * (0.05 * $PMedium);

        $existingOffer = Offer::where([
            'cpf' => $cpf,
            'institution_id' => $institutionId,
            'cod' => $cod,
        ])->first();

        if ($existingOffer) {

            $existingOffer->update([
                'cpf' => $cpf,
                'instituicao_id' => $institutionId,
                'codModalidade' => $cod,
                'PMin' => $details["QntParcelaMin"],
                'PMax' => $details["QntParcelaMax"],
                'PMedium' => $PMedium,
                'VMin' => $details["valorMin"],
                'VMax' => $details["valorMax"],
                'VMedium' => $ValueAsked,
                'TaxesMonth' => $details["jurosMes"],
                'ValueToPay' => $ValueToPay
            ]);

            return response()->json(['details' => $existingOffer], 200);
        } else {

            $response = Http::post('https://dev.gosat.org/api/v1/simulacao/credito', [
                'cpf' => $cpf
            ]);
            $institutions = $response->json()['instituicoes'];

            foreach ($institutions as $institution) {
                if ($institution['id'] == $institutionId) {
                    $institutionName = $institution['nome'];
                    $modalities = $institution['modalidades'];
                    
                    foreach ($modalities as $modality) {
                        if ($modality['cod'] == $cod) {
                            $nameModal = $modality['nome'];

                            $newOffer = Offer::create([
                                'cpf' => $cpf,
                                'institution' => $institutionName,
                                'institution_id' => $institutionId,
                                'name_modal' => $nameModal,
                                'cod' => $cod,
                                'PMin' => $details["QntParcelaMin"],
                                'PMax' => $details["QntParcelaMax"],
                                'PMedium' => $PMedium,
                                'VMin' => $details["valorMin"],
                                'VMax' => $details["valorMax"],
                                'VMedium' => $ValueAsked,
                                'TaxesMonth' => $details["jurosMes"],
                                'ValueToPay' => $ValueToPay
                            ]);

                            return response()->json(['details' => $newOffer], 200);
                        }
                    }
                }
            }
        }
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

                $detailsOffer = Http::post('https://dev.gosat.org/api/v1/simulacao/oferta', [
                    'cpf' => $cpf,
                    'instituicao_id' => $institutionId,
                    'codModalidade' => $cod
                ]);

                $details = $detailsOffer->json();

                // check if the offer already exists
                $existingOffer = Offer::where([
                    'cpf' => $cpf,
                    'institution_id' => $institutionId,
                    'name_modal' => $nameModal,
                    'cod' => $cod,
                ])->first();

                // if it doesn't exist, create a new one
                if (!$existingOffer) {

                    $PMedium = ($details["QntParcelaMin"] + $details["QntParcelaMax"]) / 2;
                    $ValueAsked = ($details["valorMin"] + $details["valorMax"]) / 2;
                    $ValueToPay = $ValueAsked * (0.05 * $PMedium);

                    Offer::create([
                        'cpf' => $cpf,
                        'institution' => $institutionName,
                        'institution_id' => $institutionId,
                        'name_modal' => $nameModal,
                        'cod' => $cod,
                        'PMin' => $details["QntParcelaMin"],
                        'PMax' => $details["QntParcelaMax"],
                        'PMedium' => $PMedium,
                        'VMin' => $details["valorMin"],
                        'VMax' => $details["valorMax"],
                        'VMedium' => $ValueAsked,
                        'TaxesMonth' => $details["jurosMes"],
                        'ValueToPay' => $ValueToPay
                    ]);
                }
            }
        }

        $offers = Offer::where('cpf', $cpf)->get();

        return view('welcome', compact('offers'));
    }
}
