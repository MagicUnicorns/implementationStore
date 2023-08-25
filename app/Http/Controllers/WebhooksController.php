<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessLogic\HmacValidator;

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\Models\Webhook;
use App\Events\WebhookNotification;

class WebhooksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //no authentication as we receive data from external sources
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
                'headers' => json_encode(getallheaders()),
                'hmacSignature' => $request->header('hmacsignature'),
            ]);
            //TODO handle webhook make sure to first send the response back to Adyen before you process the webhook
        }
        elseif($type ==='psp'){
                
            Webhook::create([
                'referenceId' => $type,
                'type' => $type,
                'body' => $content,
                'headers' => json_encode(getallheaders()),
                'hmacSignature' => 'in Body',
            ]);
            //TODO handle webhook make sure to first send the response back to Adyen before you process the webhook
        }
        elseif ($type ==='oob') {
            //handle out of band authentication
            Webhook::create([
                'referenceId' => $type,
                'type' => $type,
                'body' => $content,
                'headers' => json_encode(getallheaders()),
                'hmacSignature' => $request->header('hmacsignature')
            ]);

            //TODO handle webhook make sure to first send the response back to Adyen before you process the webhook
        }
        else{
            //we should never land here
            //TODO handle this? Maybe we just want to ignore everything else
        }

        event(new WebhookNotification(json_encode($content)));

        //middleware overrides return value, so do not change here double check at VerifyWebhook Middelware
        return response('[accepted]', 200);
    }
}