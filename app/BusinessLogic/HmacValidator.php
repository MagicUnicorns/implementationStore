<?php

/*
TODO replace by middleware?
*/

namespace App\BusinessLogic;

use Illuminate\Http\Request;

class HmacValidator
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {

    }

    public static function validateHmacBalance($signature, $content){
        //$signature = $request->header('HmacSignature');
        $key = '644179BC7E6BCEDAEBFB05BB8427183EFA8BD40ABCB92D0BE88867CDDCA19A23';
        //$content = $request::all();

        $hexHash = hash_hmac('sha256', $content, utf8_encode($key));
        $base64Hash = base64_encode(hex2bin($hexHash));

        return $signature == $base64Hash;
    }
}