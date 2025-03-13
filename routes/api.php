<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductGenerater;
use App\Http\Controllers\front\ChatController;
use App\Http\Controllers\GeminiChatbotController;
use App\Http\Controllers\AIRecommendationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/generate-products', [ProductGenerater::class, 'generateAndSaveProducts']);
