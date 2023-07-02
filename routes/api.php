<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfferController;

Route::get('/', function () {
    return response()->json(['message' => 'Jobs API', 'status' => 'Connected']);;
});

//Get all offers by cpf and save in database and return all offers
Route::post('/offers/cpf', [OfferController::class, 'offersByCpf']);

//Get the details of a given offer
Route::post('/offer/details', [OfferController::class, 'offerDetails']);

//Get the 3 best offers order by taxes
Route::post('/offers/taxes', [OfferController::class, 'getLowestTaxes']);


//Get the 3 best offers order by Biggest Credit
Route::post('/offers/credit', [OfferController::class, 'getBiggestCredit']);

//Get the 3 best offers order by Lowest Parcel
Route::post('/offers/parcel', [OfferController::class, 'getLowestParcel']);




//Renders bests offers from database for a given cpf by categories top 3
Route::post('/offers', [OfferController::class, 'getOffers']);