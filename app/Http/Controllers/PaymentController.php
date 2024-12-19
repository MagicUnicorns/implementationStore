<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Fluent;

use App\BusinessLogic\Payments\PaymentsJsonBuilder;

use App\Events\PaymentRequestNotification;
use App\Events\PaymentResponseNotification;

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
    public function store(Request $request)
    {
        $payment = new Payment;
        error_log("TEST1");

        //TODO fill parameter array for following call correctly
        $body = PaymentsJsonBuilder::createPaymentsBody(json_decode($request->getContent(), true));

        $payment->request = json_encode($body);
        $payment->reference = Str::uuid();

        //TODO give the user model an organisation id and use this here to make sure all users of an organisation can see the payment
        $payment->organization_id = auth()->user()->organization_id;


        //TODO proper handling of error
        try{
            event(new PaymentRequestNotification(json_encode($body)));
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
        ->post(env('ADYEN_PAYMENTS_ENDPOINT',null), $body);
        error_log(json_encode($response->json(), JSON_PRETTY_PRINT));
        $payment->response = json_encode($response->json());

        $responseBody = new Fluent($response->json());
        $payment->pspreference = $responseBody->pspReference;
        $payment->resultCode = $responseBody->resultCode;
        
        //TODO proper handling of error
        try{
            event(new PaymentResponseNotification(json_encode($response->json())));
        } catch (\Exception $e) {
            error_log($e->getMessage());
        }
        
        $payment->save();

        //if there is an action in the response frontend will handle it, if it is already authorised, 
        //we are finished and front end will show success message
        //hence for both cases simply return response here :)
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
        return view('payments.result')->with('type', $type);
    }
}
