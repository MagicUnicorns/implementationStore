<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //TODO create payment model

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
                'value' => 1000,
            ],
            'reference' => 'My test reference 123',
            'paymentMethod' => request("paymentMethod"),
            'returnUrl' => env('ADYEN_RETURN_URL_BASE','https://example.com') . '/dropin',
        ]);

        //TODO further fill payment model

        //TODO store payment in DB

        return $response->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function result(Request $request){
        $type = $request->type;
        return view('result')->with('type', $type);
    }
}
