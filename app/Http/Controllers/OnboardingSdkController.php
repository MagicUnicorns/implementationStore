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

        $post = Http::withHeaders([
                'Content-Type :application/json'
            ])
            ->withBasicAuth(env('ADYEN_LEM_API_BASIC_AUTH_USER'),env('ADYEN_LEM_API_BASIC_AUTH_PW'))
            ->post(env('ADYEN_LEM_SESSION_URL', false), [
                'allowOrigin' => 'http://localhost:8080',
                'product' => 'onboarding',
                'policy'=> [
                    'resources' => [
                        [
                            'legalEntityId' => 'LE32CPB22322675LPTZ3VFRPB',
                            'type' => 'legalEntity'
                        ]
                    ],
                    'roles' => [
                        'createTransferInstrumentComponent','manageTransferInstrumentComponent','manageIndividualComponent','createIndividualComponent' //todo replace by requests params
                    ]
                ]        
            ]);
        error_log("token fetched");
        //error_log($post);
        return $post;
        //return view('onboarding');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        error_log("TEST");

        $post = Http::withHeaders([
                'Content-Type :application/json'
            ])
            ->withBasicAuth(env('ADYEN_LEM_API_BASIC_AUTH_USER'),env('ADYEN_LEM_API_BASIC_AUTH_PW'))
            ->post(env('ADYEN_LEM_SESSION_URL', false), [
                'allowOrigin' => 'http://localhost:8080',
                'product' => 'onboarding',
                'policy'=> [
                    'resources' => [
                        [
                            'legalEntityId' => 'LE32CPB22322675LPTZ3VFRPB',
                            'type' => 'legalEntity'
                        ]
                    ],
                    'roles' => [ //todo replace by requests params
                        'createTransferInstrumentComponent',
                        'manageTransferInstrumentComponent',
                        'manageIndividualComponent',
                        'createIndividualComponent',
                        'acceptTermsOfServiceComponent',
                        'manageTermsOfServiceComponent' 
                    ]
                ]        
            ]);
        error_log($post);
        return $post;
        //return view('onboarding');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reporting()
    {
        error_log("getting session token for transaction overview component");

        $response = Http::withHeaders([
            'Content-Type :application/json'
        ])->withBasicAuth(env('ADYEN_CONFIGURATION_BASIC_AUTH_USER'),env('ADYEN_CONFIGURATION_BASIC_AUTH_PW'))
            ->post(env('ADYEN_LEM_SESSION_URL', false), [
                'allowOrigin' => 'http://localhost:8080',
                'product' => 'platform',
                'policy'=> [
                    'resources' => [
                        [
                            'accountHolderId' => 'AH3295522322845LC2BMJ73NT',
                            'type' => 'accountHolder'
                        ]
                    ],
                    'roles' => [
                        "Transactions Overview Component: View"
                    ]
                ]        
            ]);
        error_log($response);

        return $response;
        //return view('onboarding');
    }

}

    
