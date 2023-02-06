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
        $response = Http::accept('application/json')
        ->withOptions([
            'proxy' => 'http://sandboxproxy-vip.system.osext1.nlzwo1o.adyen.cloud:3128'
         ])
         ->withHeaders([
            'X-API-Key' => env('ADYEN_API_KEY', null),
            'Content-Type' => 'application/json',
        ])
        ->post(env('ADYEN_PAYMENT_METHODS_ENDPOINT',null), [
            'merchantAccount' => env('ADYEN_MERCHANT_ACCOUNT_NAME',null),
        ]);

        return $response->json();
    }
}
