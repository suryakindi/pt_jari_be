<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookBorrowingController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'create']);
    Route::get('/delete/{id}', [AuthController::class, 'delete']);
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('/logout', [AuthController::class, 'logout']);
        Route::get('/profile', [AuthController::class, 'profile']);
    });
    Route::prefix('book')->group(function(){
        Route::get('/index', [BookController::class, 'index']);
        Route::post('/create', [BookController::class, 'create']);
        Route::get('/search', [BookController::class, 'searchbook']);
        Route::post('/update/{id}', [BookController::class, 'update']);
        Route::get('/delete/{id}', [BookController::class, 'delete']);
    });
    Route::prefix('bookborrowing')->group(function(){
        Route::get('/index', [BookborrowingController::class, 'index']);
        Route::get('/search', [BookborrowingController::class, 'search']);
        Route::post('/create', [BookborrowingController::class, 'create']);
    });
    Route::prefix('dashboard')->group(function(){
        Route::get('/index', [DashboardController::class, 'countBookBooking']);
        
    });
});
