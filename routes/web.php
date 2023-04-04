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

Route::get('/profile/create', [App\Http\Controllers\MerchantProfileController::class, 'create'])->name('profile.create');
Route::get('/profile/{id}/edit', [App\Http\Controllers\MerchantProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{id}', [App\Http\Controllers\MerchantProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile/{id}', [App\Http\Controllers\MerchantProfileController::class, 'destroy'])->name('profile.destroy');
Route::post('/profile', [App\Http\Controllers\MerchantProfileController::class, 'store'])->name('profile.store');

Route::get('/dropin', [App\Http\Controllers\DropinController::class, 'index'])->name('dropin');
Route::get('/components', [App\Http\Controllers\ComponentsController::class, 'index'])->name('components');
Route::get('/api', [App\Http\Controllers\ApiController::class, 'index'])->name('api');

Route::get('/result/{type}', [App\Http\Controllers\PaymentController::class,'result'])->name('result');



//temporary for testing only!
Route::get('/event', function(){
    event(new MessageNotification('This is test message'));
});
Route::get('/listen', function() {
    return view('listen');
});
/*
 NOTE: it is important to have routes in correct order, e.g

Route::get('/profile/{id}', [App\Http\Controllers\MerchantProfileController::class, 'create'])->name('profile.create');
Route::get('/profile/create', [App\Http\Controllers\MerchantProfileController::class, 'edit'])->name('profile.edit');

will never trigger the /create route as it is caught by the first one. Just reorder them ;)

*/