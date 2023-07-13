<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/user', function (Request $request) {
    $request->user()->makeVisible(['email', 'email_verified_at']);

    return $request->user();
});

Route::prefix('users')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/refresh-token', [AuthController::class, 'refreshToken']);
        Route::put('/{id}', [AuthController::class, 'update']);
        Route::delete('/{id}', [AuthController::class, 'destroy']);
    });
});

Route::prefix('email')->group(function () {
    Route::get('/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
        ->middleware(['signed'])
        ->name('verification.verify');
    Route::post('/verification-notification', [AuthController::class, 'resendVerificationEmail'])
        ->middleware(['auth:sanctum', 'throttle:6,1'])
        ->name('verification.send');
});


Route::prefix('parishes')->group(function () {
    Route::get('/', [ParishController::class, 'index']);
    Route::get('/{parish}', [ParishController::class, 'show']);
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::post('/', [ParishController::class, 'store']);
        Route::put('/{id}', [ParishController::class, 'update']);
        Route::delete('/{id}', [ParishController::class, 'destroy']);
    });
});

Route::prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'index']);
    Route::get('/{id}', [EventController::class, 'show']);
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::post('/', [EventController::class, 'store']);
        Route::put('/{id}', [EventController::class, 'update']);
        Route::delete('/{id}', [EventController::class, 'destroy']);
    });
});
