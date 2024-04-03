<?php

use Illuminate\Support\Facades\Route;

use App\Events\PaymentRequestNotification;
use App\Events\TestNotification;

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
Route::get('/dropin-ctp', [App\Http\Controllers\DropinControllerCtp::class, 'index'])->name('dropin-ctp');

Route::get('/components', [App\Http\Controllers\ComponentsController::class, 'index'])->name('components');
Route::get('/api', [App\Http\Controllers\ApiController::class, 'index'])->name('api');

Route::get('/result/{type}', [App\Http\Controllers\PaymentController::class,'result'])->name('result');

//TODO temporary for testing remove this line, it is defined in api.php!
// Route::post('/payments', [App\Http\Controllers\PaymentController::class, 'store']);

//temporary for testing only!
Route::get('/event', function(){
    event(new TestNotification('This is test message'));
});

Route::post('/tokens/create', [App\Http\Controllers\AuthTokenController::class, 'store']);

Route::post('/paymentMethods', [App\Http\Controllers\PaymentMethodsController::class, 'store'])->name('paymentMethods.store');
Route::post('/payments', [App\Http\Controllers\PaymentController::class, 'store'])->name('payments.store');
Route::post('/payments/details', [App\Http\Controllers\PaymentsDetailsController::class, 'store'])->name('paymentsDetails.store');
/*
 NOTE: it is important to have routes in correct order, e.g

Route::get('/profile/{id}', [App\Http\Controllers\MerchantProfileController::class, 'create'])->name('profile.create');
Route::get('/profile/create', [App\Http\Controllers\MerchantProfileController::class, 'edit'])->name('profile.edit');

will never trigger the /create route as it is caught by the first one. Just reorder them ;)

*/