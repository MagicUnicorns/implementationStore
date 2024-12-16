<?php

use Illuminate\Support\Facades\Route;

use App\Events\PaymentRequestNotification;
use App\Events\TestNotification;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PatientController;

use App\Http\Controllers\DynamicModelController;

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
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/settings/{organization}', [App\Http\Controllers\SettingsController::class, 'show'])->name('settings.show');

Route::get('/dropin', [App\Http\Controllers\DropinController::class, 'index'])->name('payments.dropin');
Route::get('/dropin-ctp', [App\Http\Controllers\DropinControllerCtp::class, 'index'])->name('payments.dropin-ctp');

Route::get('/components', [App\Http\Controllers\ComponentsController::class, 'index'])->name('payments.components');
Route::get('/api', [App\Http\Controllers\ApiController::class, 'index'])->name('payments.api');

Route::get('/result/{type}', [App\Http\Controllers\PaymentController::class,'result'])->name('payments.result');

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

Route::GET('/onboarding/{id}', [App\Http\Controllers\OnboardingController::class, 'index'])->name('onboardings.onboarding');

Route::GET('/reporting/{id}', [App\Http\Controllers\ReportingController::class, 'index'])->name('reports.reporting');

Route::GET('/adyen-onboarding-sdk-token', [App\Http\Controllers\OnboardingSdkController::class, 'index']);
Route::POST('/adyen-onboarding-sdk-token', [App\Http\Controllers\OnboardingSdkController::class, 'store']);
Route::GET('/adyen-reporting-sdk-token', [App\Http\Controllers\OnboardingSdkController::class, 'reporting']);
/*
 NOTE: it is important to have routes in correct order, e.g

Route::get('/profile/{id}', [App\Http\Controllers\MerchantProfileController::class, 'create'])->name('profile.create');
Route::get('/profile/create', [App\Http\Controllers\MerchantProfileController::class, 'edit'])->name('profile.edit');

will never trigger the /create route as it is caught by the first one. Just reorder them ;)

*/

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resources([
    'roles' => RoleController::class,
    'users' => UserController::class,
    'patients' => PatientController::class,
    'customers' => CustomerController::class,
]);

Route::get('/list/{modelName}', [DynamicModelController::class, 'index']);

