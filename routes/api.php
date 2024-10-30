<?php

use App\Http\Controllers\PengunjungController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('pengunjung', [PengunjungController::class, 'index']);
Route::post('pengunjung/create', [PengunjungController::class, 'store']);
Route::patch('pengunjung/{id}', [PengunjungController::class, 'update']);
Route::delete('pengunjung/delete/{id}', [PengunjungController::class, 'destroy']);
