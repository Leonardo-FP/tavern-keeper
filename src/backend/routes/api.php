<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\FaqController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function() {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResources([
        'boards' => BoardController::class,
    ]);

    Route::get('my-boards', [BoardController::class, 'myBoards']);
    Route::delete('/boards/{board_id}/users/{user_id}', [BoardController::class, 'removeUser']);
    Route::delete('/boards/{board_id}/leave', [BoardController::class, 'leave']);

    Route::apiResources([
        'campaigns' => CampaignController::class,
    ]);

    Route::post('/campaigns/{campaign}/join', [CampaignController::class, 'join']);
    Route::delete('/campaigns/{campaign_id}/leave', [CampaignController::class, 'leave']);
    
    Route::get('faqs', [FaqController::class, 'index']);
});