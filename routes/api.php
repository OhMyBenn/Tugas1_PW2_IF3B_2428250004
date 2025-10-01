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

Route::get('/kategori', [KategoriController::class,'index']);
Route::get('/produk', [ProdukController::class,'index']);

Route::post('/kategori', [KategoriController::class,'store']);
Route::post('/produk', [ProdukController::class,'store']);

Route::patch('/kategori/{id}', [KategoriController::class,'update']);
Route::patch('/produk/{id}', [ProdukController::class,'update']);

Route::delete('/kategori/{id}', [KategoriController::class,'destroy']);
Route::delete('/produk/{id}', [ProdukController::class,'destroy']);

Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class, 'login']);

