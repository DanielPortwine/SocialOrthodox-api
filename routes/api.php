<?php

use App\Http\Controllers\ParishController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('parishes')->group(function () {
    Route::get('/', [ParishController::class, 'index']);
    Route::get('/{parish}', [ParishController::class, 'show']);
    Route::post('/', [ParishController::class, 'store']);
    Route::put('/{id}', [ParishController::class, 'update']);
    Route::delete('/{id}', [ParishController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
