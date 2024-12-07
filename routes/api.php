<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppleController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;

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

// Endpoint untuk autentikasi
Route::post('/register', [AuthController::class, 'register']); // Registrasi
Route::post('/login', [AuthController::class, 'login']);  // Login
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); // Logout
Route::middleware('auth:sanctum')->prefix('user')->group(function () {
    Route::post('/update', [UserController::class, 'update']);
    Route::post('/updatePassword', [UserController::class, 'updatePassword']);
});
Route::get('/categories/{category}', [CategoryController::class, 'getCategoryByLabel']);

Route::get('/articles', [ArticleController::class, 'index']);


// Endpoint yang membutuhkan autentikasi
Route::middleware('auth:sanctum')->group(function () {
    // Endpoint untuk tanaman apel
    Route::apiResource('apples', AppleController::class);

    // Endpoint untuk riwayat diagnosis
    Route::apiResource('histories', HistoryController::class);

    // Endpoint untuk kategori penyakit
    // Route::apiResource('categories', CategoryController::class);

    // Endpoint untuk artikel (opsional)
    // Route::apiResource('articles', ArticleController::class);

    // Mengambil data pengguna yang sedang login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
