<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfferController;

Route::get('/', function () {
    return response()->json(['message' => 'Jobs API', 'status' => 'Connected']);;
});

//Get all offers by cpf and save in database and return all offers
Route::post('/offers/cpf', [OfferController::class, 'offersByCpf']);

Route::post('/offers/details', [OfferController::class, 'offersByCpf']);


Route::post('/offers/taxes', [OfferController::class, 'getLowestTaxes']);



//Renders bests offers from database for a given cpf by categories top 3
Route::post('/offers', [OfferController::class, 'getOffers']);