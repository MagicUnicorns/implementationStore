<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentsController extends Controller
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
            'proxy' => env('PROXY', null),
         ])
         ->withHeaders([
            'X-API-Key' => env('ADYEN_API_KEY', null),
            'Content-Type' => 'application/json',
        ])
        ->post(env('ADYEN_PAYMENTS_ENDPOINT',null), [
            'merchantAccount' => env('ADYEN_MERCHANT_ACCOUNT_NAME',null),
            'amount' => [
                'currency' => 'EUR',
                'value' => 10000,
            ],
            'reference' => 'My test reference 123',
            'paymentMethod' => request("paymentMethod"),
            'returnUrl' => env('ADYEN_RETURN_URL_BASE','https://example.com') . '/dropin',
        ]);

        return $response->json();
    }

    public function result(Request $request){
        $type = $request->type;
        return view('result')->with('type', $type);
    }
}
