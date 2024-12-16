<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Events\PaymentDetailsResponseNotification;
use App\Events\PaymentDetailsRequestNotification;

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
        try{
            event(new PaymentDetailsRequestNotification(json_encode($request->post())));
        } catch (\Exception $e) {
            error_log($e->getMessage());
        }
        $response = Http::accept('application/json')
        ->withOptions([
            'proxy' => env('PROXY', null),
         ])
         ->withHeaders([
            'X-API-Key' => env('ADYEN_API_KEY', null),
            'Content-Type' => 'application/json',
        ])
        ->post(env('ADYEN_PAYMENTS_DETAILS_ENDPOINT',null), 
            $request->post(),
        );

        try{
            event(new PaymentDetailsResponseNotification(json_encode($response->json())));
        } catch (\Exception $e) {
            error_log($e->getMessage());
        }

        return $response->json();
    }
}
