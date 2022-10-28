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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home' ])->name('home')->middleware('auth');

Route::resource('/usuarios', App\Http\Controllers\UserController::class)->middleware('auth');
Route::resource('/relatorios', App\Http\Controllers\RelatorioController::class)->middleware('auth');
require __DIR__.'/auth.php';
