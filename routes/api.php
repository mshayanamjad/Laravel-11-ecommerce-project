<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\ChatController;
use App\Http\Controllers\AIRecommendationController;
use App\Http\Controllers\ProductGenerater;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/recommend-products', [AIRecommendationController::class, 'recommend']);
Route::get('/generate-products', [ProductGenerater::class, 'generateAndSaveProducts']);
