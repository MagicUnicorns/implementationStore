<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessLogic\HmacValidator;

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class NotificationsController extends Controller
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
     * Stores a new notification in the database
     * 
     * https://docs.adyen.com/marketplaces-and-platforms/notification-webhooks#validate-hmac
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $content = '{"data":{"balancePlatform":"SebastianL","balanceAccount":{"accountHolderId":"AH3227C223222D5HF8267FJBM","defaultCurrencyCode":"EUR","description":"Main balance account 123873255456546677","timeZone":"Europe\/Amsterdam","id":"BA3227C223222D5HGBNB7FMKQ","status":"Active"}},"environment":"test","type":"balancePlatform.balanceAccount.created"}';

        //$key = '6D5BADA576A73109D879220DCB793FFD67DEF7AA18C74CCC0AB66FD87AC8AEEA';
        $key = '7CEC7468D07AC56038AAC42A9961006AF08E2130A675106444317B13CE42A6AA';
        $hexHash = hash_hmac('sha256', $content, hex2bin($key));
        $base64Hash = base64_encode(hex2bin($hexHash));
        $signature = 'WH0T9PxiUNUtGMNuPkePAZeJG5l5EoTyehWreRKSUVk=';

        Storage::disk('local')->append('example.txt', Carbon::now() . ' | signature = ' . $signature . ' | hash: ' . $base64Hash . ' | strcmp: ' . strcmp($signature, $base64Hash));
        return Carbon::now()->toDateString() . ' | signature = ' . $signature . ' | hash: ' . $base64Hash . ' | strcmp: ' . strcmp($signature, $base64Hash);
    }
}