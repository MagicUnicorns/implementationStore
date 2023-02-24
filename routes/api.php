<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/notifications', [App\Http\Controllers\SettingsController::class, 'index'])->name('getNotifications');
Route::post('/notifications/{type}', [App\Http\Controllers\NotificationsController::class, 'store'])->middleware(VerifyNotification::class)->name('notifications.store');

Route::post('/paymentMethods', [App\Http\Controllers\PaymentMethodsController::class, 'store'])->name('paymentMethods.store');
Route::post('/payments', [App\Http\Controllers\PaymentsController::class, 'store'])->name('payments.store');
Route::post('/payments/details', [App\Http\Controllers\PaymentsDetailsController::class, 'store'])->name('paymentsDetails.store');