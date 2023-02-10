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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/settings/{user}', [App\Http\Controllers\SettingsController::class, 'show'])->name('settings.show');

Route::get('/dropin', [App\Http\Controllers\DropinController::class, 'index'])->name('dropin');
Route::get('/components', [App\Http\Controllers\ComponentsController::class, 'index'])->name('components');
Route::get('/api', [App\Http\Controllers\ApiController::class, 'index'])->name('api');

Route::get('/result/{type}', [App\Http\Controllers\PaymentsController::class,'result'])->name('result');