<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\MatchController;
use App\Http\Controllers\Api\StandingsController;

Route::get('/test', function () {
    return response()->json(['message' => 'API funcionando correctamente']);
});


Route::get('/teams', [TeamController::class, 'index']);
Route::get('/matches', [MatchController::class,'index']);
Route::post('/teams', [TeamController::class, 'store']);
Route::post('/matches/{id}/result', [MatchController::class, 'result']);
Route::get('/standings', [StandingsController::class, 'index']);