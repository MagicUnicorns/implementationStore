<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OnboardingSdkController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        error_log("test");

        $post = Http::withHeaders([
            'Content-Type :application/json'
        ])->withBasicAuth(env('ADYEN_LEM_API_BASIC_AUTH_USER'),env('ADYEN_LEM_API_BASIC_AUTH_PW'))
            ->post(env('ADYEN_LEM_SESSION_URL', false), [
                'allowOrigin' => 'http://localhost:8080',
                'product' => 'onboarding',
                'policy'=> [
                    'resources' => [
                        [
                            'legalEntityId' => 'LE3293S223225R5KZBJFS8944',
                            'type' => 'legalEntity'
                        ]
                    ],
                    'roles' => [
                        'createTransferInstrumentComponent','manageTransferInstrumentComponent' //todo replace by requests params
                    ]
                ]        
            ]);
        error_log($post);
        return $post;
        //return view('onboarding');
    }}
