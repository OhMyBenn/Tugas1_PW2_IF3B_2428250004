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


Route::get('/kategori', [KategoriController::class,'index']);
Route::post('/kategori', [KategoriController::class, 'store']);
Route::patch('/kategori/{id}', [KategoriController::class, 'update']);
Route::get('/kategori/{id}', [KategoriController::class, 'show']);
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);

Route::get('/produk', [ProdukController::class,'index']);
Route::post('/produk', [ProdukController::class, 'store']);
Route::patch('/produk/{id}', [ProdukController::class, 'update']);
Route::get('/produk/{id}', [ProdukController::class, 'show']);
Route::delete('/produk/{id}', [ProdukController::class, 'destroy']);

Route::get('/kategori/{id}/produk', [ProdukController::class, 'getByKategori']);

Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class, 'login']);

