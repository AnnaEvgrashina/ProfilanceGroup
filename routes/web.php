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

Route::get('/',  [\App\Http\Controllers\LinkController::class, 'index'])->name('index');
Route::post('/create',  [\App\Http\Controllers\LinkController::class, 'store'])->name('create');
Route::get('/all', [\App\Http\Controllers\LinkController::class, 'getAllLinks'])->name('all_links');
Route::get('{short_link}', [\App\Http\Controllers\LinkController::class, 'redirectShortLink'])->name('short_link');
