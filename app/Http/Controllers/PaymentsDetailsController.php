<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentsDetailsController extends Controller
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
    public function store(Request $request)
    {
        $response = Http::accept('application/json')
        ->withOptions([
            'proxy' => 'http://sandboxproxy-vip.system.osext1.nlzwo1o.adyen.cloud:3128'
         ])
         ->withHeaders([
            'X-API-Key' => env('ADYEN_API_KEY', null),
            'Content-Type' => 'application/json',
        ])
        ->post(env('ADYEN_PAYMENTS_DETAILS_ENDPOINT',null), 
            $request->post(),
        );

        return $response->json();
    }
}
