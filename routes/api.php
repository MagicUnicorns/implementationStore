<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\VerifyWebhook;

use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
|
|
| When /login is called you get back an oauth token which can be used for subsequent calls - /logout discards the token
| When logged in you can use the Bearer Token which was returned by the POST /login call to authenticate in-between calls
|
| TODO do we want to also build API-KEY functionality?
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/webhooks/{type}', [App\Http\Controllers\WebhooksController::class, 'store'])->middleware(VerifyWebhook::class)->name('webhooks.store');

/**
 * Login and logout for the oauth session
 */
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

//=========
//Example usages:
// Route::middleware(['auth:api', 'role:admin'])->group(function () {
//     Route::get('/admin/resource', [YourController::class, 'adminResource']);
// });

// Route::middleware(['auth:api', 'permission:view articles'])->group(function () {
//     Route::get('/articles', [YourController::class, 'index']);
// });

// Route::middleware(['auth:api'])->group(function () {
//     Route::get('/profile', [YourController::class, 'profile']);
// });
//=========