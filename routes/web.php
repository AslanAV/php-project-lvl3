<?php

use App\Http\Controllers\UrlChecksController;
use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'main')->name('main');
Route::resource('urls', UrlController::class)->only('show', 'index', 'store');
Route::resource('urls.checks', UrlChecksController::class)->only('store');
