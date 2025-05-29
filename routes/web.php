<?php

use App\Http\Controllers\WebLoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function() {
    return view('login');
});

Route::get('/dashboard', function() {
    return view('pages.index');
});

Route::get('/news', function() {
    return view('pages.news');
});

Route::get('/announcement', function() {
    return view('pages.announcement');
});

Route::get('/history', function() {
    return view('pages.history');
});

Route::get('/potential', function() {
    return view('pages.potential');
});

Route::get('/organization', function() {
    return view('pages.organization');
});

Route::get('/village', function() {
    return view('pages.village');
});