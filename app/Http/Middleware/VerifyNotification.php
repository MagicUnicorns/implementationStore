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
        $content = '{"data":{"balancePlatform":"SebastianL","balanceAccount":{"accountHolderId":"AH3227C223222D5HF8267FJBM","defaultCurrencyCode":"EUR","description":"Main balance account 123873255456546677","timeZone":"Europe\/Amsterdam","id":"BA3227C223222D5HGBNB7FMKQ","status":"Active"}},"environment":"test","type":"balancePlatform.balanceAccount.created"}';

        //$key = '6D5BADA576A73109D879220DCB793FFD67DEF7AA18C74CCC0AB66FD87AC8AEEA';
        $key = '7CEC7468D07AC56038AAC42A9961006AF08E2130A675106444317B13CE42A6AA';
        $hexHash = hash_hmac('sha256', $content, hex2bin($key));
        $base64Hash = base64_encode(hex2bin($hexHash));
        $signature = 'WH0T9PxiUNUtGMNuPkePAZeJG5l5EoTyehWreRKSUVk=';

        Storage::disk('local')->append('example.txt', Carbon::now() . ' | signature = ' . $signature . ' | hash: ' . $base64Hash . ' | strcmp: ' . strcmp($signature, $base64Hash));

        if (strcmp($signature, $base64Hash) !== 0){
            return response('[rejected]', 200);
        }

        return $next($request);
    }
}
