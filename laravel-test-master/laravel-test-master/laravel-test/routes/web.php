<?php

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

Route::get('/', [\App\Http\Controllers\SearchController::class, 'index'])->name('index');
Route::get('/search', [\App\Http\Controllers\SearchController::class, 'search'])
    ->name('search');
Route::get('/history', [\App\Http\Controllers\SearchController::class, 'history'])
    ->name('history');
Route::get('/history/{id}', [\App\Http\Controllers\SearchController::class, 'historyRow'])
    ->name('history-row');
