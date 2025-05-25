<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\HistoryController;
use App\Models\Announcement;

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

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [UserController::class, 'me']);
});

Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/{id}', [NewsController::class, 'show']);
Route::post('/news', [NewsController::class, 'store']);
Route::put('/news/{id}', [NewsController::class, 'update']);
Route::delete('/news/{id}', [NewsController::class, 'destroy']);

Route::get('/announcement', [AnnouncementController::class, 'index']);
Route::get('/announcement/{id}', [AnnouncementController::class, 'show']);
Route::post('/announcement', [AnnouncementController::class, 'store']);
Route::put('/announcement/{id}', [AnnouncementController::class, 'update']);
Route::delete('/announcement/{id}', [AnnouncementController::class, 'destroy']);

Route::get('/history', [HistoryController::class, 'index']);
Route::get('/history/{id}', [HistoryController::class, 'show']);
Route::post('/history', [HistoryController::class, 'store']);
Route::put('/history/{id}', [HistoryController::class, 'update']);
Route::delete('/history/{id}', [HistoryController::class, 'destroy']);
