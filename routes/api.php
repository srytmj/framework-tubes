<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController as AuthController;
use App\Http\Controllers\Api\ApiController as ApiController;

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
Route::get('/me', [AuthController::class, 'me'])->name('me');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//  login register
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route::post('/login', [AuthController::class, 'login'])->name('login');
// Route::post('/register', [AuthController::class, 'register'])->name('register');
    // Route untuk resource Produk
Route::get('/produk', [ApiController::class, 'index']); // Menampilkan daftar produk
// Route::post('/produk', [ApiController::class, 'store']); // Menyimpan produk baru
Route::get('/produk/{id}', [ApiController::class, 'show']); // Menampilkan produk berdasarkan id
// Route::put('/produk/{id}', [ApiController::class, 'update']); // Mengupdate produk berdasarkan id
// Route::delete('/produk/{id}', [ApiController::class, 'destroy']); // Menghapus produk berdasarkan id
Route::get('/produk/search/{produk}', [ApiController::class, 'search']); // Mencari produk berdasarkan nama

// // Grup route dengan middleware auth:sanctum
// Route::middleware(['auth:sanctum'])->group(function () {
//     // Route untuk logout
//     Route::post('/logout', [AuthController::class, 'logout']);
    
//     // Route untuk resource Produk
//     Route::get('/produk', [ApiController::class, 'index']); // Menampilkan daftar produk
//     Route::post('/produk', [ApiController::class, 'store']); // Menyimpan produk baru
//     Route::get('/produk/{id}', [ApiController::class, 'show']); // Menampilkan produk berdasarkan id
//     Route::put('/produk/{id}', [ApiController::class, 'update']); // Mengupdate produk berdasarkan id
//     Route::delete('/produk/{id}', [ApiController::class, 'destroy']); // Menghapus produk berdasarkan id
//     Route::get('/produk/search/{produk}', [ApiController::class, 'search']); // Mencari produk berdasarkan nama
// });

