<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PotentialController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\VillageOfficialsController;
use App\Http\Controllers\LetterTypeController;
use App\Http\Controllers\LetterRequestController;
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
    Route::post('/logout', [UserController::class, 'logout']);

    Route::post('/letterRequest', [LetterRequestController::class, 'store']);
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

Route::get('/potential', [PotentialController::class, 'index']);
Route::get('/potential/{id}', [PotentialController::class, 'show']);
Route::post('/potential', [PotentialController::class, 'store']);
Route::put('/potential/{id}', [PotentialController::class, 'update']);
Route::delete('/potential/{id}', [PotentialController::class, 'destroy']);

Route::get('/organization', [OrganizationController::class, 'index']);
Route::get('/organization/{id}', [OrganizationController::class, 'show']);
Route::post('/organization', [OrganizationController::class, 'store']);
Route::put('/organization/{id}', [OrganizationController::class, 'update']);
Route::delete('/organization/{id}', [OrganizationController::class, 'destroy']);

Route::get('/village', [VillageOfficialsController::class, 'index']);
Route::get('/village/{id}', [VillageOfficialsController::class, 'show']);
Route::post('/village', [VillageOfficialsController::class, 'store']);
Route::put('/village/{id}', [VillageOfficialsController::class, 'update']);
Route::delete('/village/{id}', [VillageOfficialsController::class, 'destroy']);

Route::get('/letterType', [LetterTypeController::class, 'index']);
Route::get('/letterType/{id}', [LetterTypeController::class, 'show']);
Route::post('/letterType', [LetterTypeController::class, 'store']);
Route::put('/letterType/{id}', [LetterTypeController::class, 'update']);
Route::delete('/letterType/{id}', [LetterTypeController::class, 'destroy']);

Route::get('/letterRequest', [LetterRequestController::class, 'index']);
Route::get('/letterRequest/{id}', [LetterRequestController::class, 'show']);
Route::put('/letterRequest/approved/{id}', [LetterRequestController::class, 'approved']);
Route::put('/letterRequest/rejected/{id}', [LetterRequestController::class, 'rejected']);
Route::get('/letterRequest/byLetterType', [LetterRequestController::class, 'showByLetterType']);
// Route::put('/letterRequest/{id}', [LetterRequestController::class, 'update']);
Route::delete('/letterRequest/{id}', [LetterRequestController::class, 'destroy']);

