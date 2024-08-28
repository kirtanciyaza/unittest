<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QrCodeController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {

    Route::get('user', [AuthController::class, 'user']);
    Route::get('product', [QrCodeController::class, 'index']);
    Route::post('product/store', [QrCodeController::class, 'store']);
    Route::get('product/{id}/edit', [QrCodeController::class, 'edit']);
    Route::post('product/{id}/update', [QrCodeController::class, 'update']);
    Route::delete('product/{id}/delete', [QrCodeController::class, 'delete']);

});






