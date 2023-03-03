<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessLogic\HmacValidator;

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\Models\Webhook;

class WebhooksController extends Controller
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
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return 'test';
    }

    /**
     * Stores a new Webhook in the database
     * 
     * https://docs.adyen.com/marketplaces-and-platforms/notification-webhooks#validate-hmac
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $type = $request->type;
        $content = $request->getContent();
        
        if($type === 'balance'){
            //TODO properly fill referenceId, maybe we want a user_id here to be able to show webhooks belonging to a specific user?
            
            Webhook::create([
                'referenceId' => $type,
                'type' => $type,
                'body' => $content,
                'hmacSignature' => $request->header('hmacsignature'),
            ]);
            //TODO handle webhook
        }
        elseif($type ==='psp'){
                
            Webhook::create([
                'referenceId' => $type,
                'type' => $type,
                'body' => $content,
                'hmacSignature' => 'in Body',
            ]);
            //TODO handle webhook
        }
        else{
            //we should never land here
            //TODO handle this?
        }

        //middleware overrides return value, so do not change here double check at VerifyNotification Middelware
        return response('[accepted]', 200);
    }
}