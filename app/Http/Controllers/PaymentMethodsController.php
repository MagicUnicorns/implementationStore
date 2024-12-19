<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentMethodsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store()
    {
        // TODO fix hardcoded stuff here
        $response = Http::accept('application/json')
        ->withOptions([
            'proxy' => env('PROXY', null),
         ])
         ->withHeaders([
            'X-API-Key' => env('ADYEN_API_KEY', null),
            'Content-Type' => 'application/json',
        ])
        ->post(env('ADYEN_PAYMENT_METHODS_ENDPOINT',null), [
            'merchantAccount' => env('ADYEN_MERCHANT_ACCOUNT_NAME',null),
            'amount' => [
                'currency' => 'EUR',
                'value' => 10000,
            ],
            'countryCode' => 'DE',
            'allowedPaymentMethods' => [
                'ideal',
                'twint',
                'scheme',
                'paypal',
                'googlepay',
                'applepay',
            ],
            'blockedPaymentMethods' => [
                
            ],
        ]);

        return $response->json();
    }
}
