<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyNotification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $type = $request->type;
        // Notification Request JSON
        $content = $request->getContent();
      
        if($type == 'balance'){
            
            $key = env('BALANCE_HMAC_KEY');
            $hexHash = hash_hmac('sha256', $content, hex2bin($key));
            $base64Hash = base64_encode(hex2bin($hexHash));
            $signature = $request->header('hmacSignature');

            if (strcmp($signature, $base64Hash) !== 0){
                return response('[rejected]', 200);
            }

            $response = $next($request);

            return response('[accepted]', 200);
        }
        elseif ($type == 'psp') {

            // HMAC_KEY from the Customer Area
            $hmacKey = env('PSP_HMAC_KEY');
            $notificationRequest = json_decode($content, true);
            $hmac = new \Adyen\Util\HmacSignature();

            // Handling multiple notificationRequests
            foreach ( $notificationRequest["notificationItems"] as $notificationRequestItem ) {
                $params = $notificationRequestItem["NotificationRequestItem"];
                // Handle the notification
                if ( !$hmac->isValidNotificationHMAC($hmacKey, $params) ) {
                    // verification failed, note: here we assume, that if one test fails the whole array fails!
                    return response('[rejected]', 200);
                }
            }
        }
        else{
            return response('[rejected]: Not supported type: ' . $type, 200);
        }
        
        //test passed, so process the notification
        $response = $next($request);

        //when processing is done send the accepted string
        return response('[accepted]', 200);
    }
}