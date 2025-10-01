<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Models\Kategori;
use App\Models\Produk;
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Response;
use illuminate\Container\Attributes\Auth;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/kategoris', [KategoriController::class, 'index']);
Route::post('/kategoris', [KategoriController::class, 'store']);
Route::get('/kategoris/{id}', [KategoriController::class, 'show']);
Route::put('/kategoris/{id}', [KategoriController::class, 'update']);
Route::delete('/kategoris/{id}', [KategoriController::class, 'destroy']);

Route::get('/produks', [ProdukController::class, 'index']);
Route::post('/produks', [ProdukController::class, 'store']);
Route::get('/produks/{id}', [ProdukController::class, 'show']);
Route::put('/produks/{id}', [ProdukController::class, 'update']);
Route::delete('/produks/{id}', [ProdukController::class, 'destroy']);

