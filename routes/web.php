<?php

use App\Http\Controllers\Client\HomeController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/bai-viet.html', function() {
    return view('client.post');
})->name('c-post-index');
Route::get('/video-tren-song', function() {
    return view('client.video');
})->name('c-video');
Route::get('/chi-tiet/{slug}', function() {
    return view('client.detail_post');
})->name('c-post-detail');
Route::get('/ve-toi.html', function() {
    return view('client.about');
})->name('c-about');
Route::get('/lien-lac.html', function() {
    return view('client.contact');
})->name('c-contact');