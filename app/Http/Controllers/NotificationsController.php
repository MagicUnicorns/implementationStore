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
        //$this->middleware('auth');
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        //$content = '{"data":{"balancePlatform":"SebastianL","accountHolder":{"contactDetails":{},"description":"Test Account h123447 test 23123","legalEntityId":"LE322KH223222J5HCSKGS75PQ","capabilities":{"receiveFromPlatformPayments":{"enabled":"true","requested":"true","allowed":"true","verificationStatus":"valid"},"receiveFromBalanceAccount":{"enabled":"true","requested":"true","allowed":"true","verificationStatus":"valid"},"sendToBalanceAccount":{"enabled":"true","requested":"true","allowed":"true","verificationStatus":"valid"},"sendToTransferInstrument":{"enabled":"true","requested":"true","allowed":"true","verificationStatus":"valid"}},"id":"AH32272223222D5HDR94HBX67","status":"Active"}},"environment":"test","type":"balancePlatform.accountHolder.created"}';
        $key = 'D7AC6CDB75C9A54A16E05FCC8F26FE472042E4885457D9F9AF6667B87A599A19';
        
        $content = $request->getContent();
        $signature = $request->header('hmacsignature');
        $hexHash = hash_hmac('sha256', utf8_encode($content), hex2bin($key));
        $base64Hash = base64_encode(hex2bin($hexHash));
        //$signature = '8fncAAAEM6YAYuvLWBteWsSXfCIgoDtahgBkZce/Ows=';

        Storage::disk('local')->append('example.txt', Carbon::now() . ' | signature = ' . $signature . ' | hash: ' . $base64Hash . ' | strcmp: ' . strcmp($signature, $base64Hash)) . ' | content: ' . $content;
        return response('[accepted]', 200);
    }
}

/*
Working sample:
        $content = "{\"data\":{\"balancePlatform\":\"YourBalancePlatform\",\"creationDate\":\"2022-11-21T16:48:35+01:00\",\"id\":\"3JERI45WZHNCUHZY\",\"accountHolder\":{\"description\":\"Farah's Fedoras Company Account Holder\",\"id\":\"AH3227C223222C5GXTQM35ZX3\"},\"amount\":{\"currency\":\"EUR\",\"value\":900},\"balanceAccount\":{\"description\":\"Farah's Fedoras Balance Account\",\"id\":\"BA32272223222C5GXTQM43WKF\"},\"description\":\"Porcelain Doll: Eliza (20cm)\",\"originalAmount\":{\"currency\":\"EUR\",\"value\":900},\"platformPayment\":{\"account\":\"BA32272223222C5GXTQM43WKF\",\"modificationMerchantReference\":\"<auto>\",\"modificationPspReference\":\"G8X8VXGN2MQ7C782\",\"paymentMerchantReference\":\"uniqueReference\",\"paymentPspReference\":\"H42JQZ4RTGXXGN82\",\"reference\":\"6124145\",\"type\":\"BalanceAccount\"},\"reference\":\"6124145\",\"status\":\"Authorised\"},\"environment\":\"test\",\"type\":\"balancePlatform.payment.created\"}";
        $type = $request->type;
        //$content = $request->getContent();

        $key = '6D5BADA576A73109D879220DCB793FFD67DEF7AA18C74CCC0AB66FD87AC8AEEA';
        //$content = $request::all();

        $hexHash = hash_hmac('sha256', $content, hex2bin($key));
        $base64Hash = base64_encode(hex2bin($hexHash));
        $signature = 'lFrZb+1R+3Hfnbh+VM4Jt5qZYre5r3Lu5RJeQQSsl6M=';

        Storage::disk('local')->append('example.txt', Carbon::now() . ' | signature = ' . $signature . ' | hash: ' . $base64Hash . ' | strcmp: ' . strcmp($signature, $base64Hash));
        return Carbon::now()->toDateString() . ' | signature = ' . $signature . ' | hash: ' . $base64Hash . ' | strcmp: ' . strcmp($signature, $base64Hash);
*/


/* not working
        //$type = $request->type;
        //$content = "{\"data\":{\"balancePlatform\":\"YourBalancePlatform\",\"creationDate\":\"2022-11-21T16:48:35+01:00\",\"id\":\"3JERI45WZHNCUHZY\",\"accountHolder\":{\"description\":\"Farah's Fedoras Company Account Holder\",\"id\":\"AH3227C223222C5GXTQM35ZX3\"},\"amount\":{\"currency\":\"EUR\",\"value\":900},\"balanceAccount\":{\"description\":\"Farah's Fedoras Balance Account\",\"id\":\"BA32272223222C5GXTQM43WKF\"},\"description\":\"Porcelain Doll: Eliza (20cm)\",\"originalAmount\":{\"currency\":\"EUR\",\"value\":900},\"platformPayment\":{\"account\":\"BA32272223222C5GXTQM43WKF\",\"modificationMerchantReference\":\"<auto>\",\"modificationPspReference\":\"G8X8VXGN2MQ7C782\",\"paymentMerchantReference\":\"uniqueReference\",\"paymentPspReference\":\"H42JQZ4RTGXXGN82\",\"reference\":\"6124145\",\"type\":\"BalanceAccount\"},\"reference\":\"6124145\",\"status\":\"Authorised\"},\"environment\":\"test\",\"type\":\"balancePlatform.payment.created\"}";
        $type = $request->type;
        //$content = $request->getContent();
        $content = '{"data":{"balancePlatform":"SebastianL","accountHolder":{"contactDetails":{},"description":"Test Account h123447 test 23123","legalEntityId":"LE322KH223222J5HCSKGS75PQ","capabilities":{"receiveFromPlatformPayments":{"enabled":"true","requested":"true","allowed":"true","verificationStatus":"valid"},"receiveFromBalanceAccount":{"enabled":"true","requested":"true","allowed":"true","verificationStatus":"valid"},"sendToBalanceAccount":{"enabled":"true","requested":"true","allowed":"true","verificationStatus":"valid"},"sendToTransferInstrument":{"enabled":"true","requested":"true","allowed":"true","verificationStatus":"valid"}},"id":"AH3227C223222D5HDR9267D6K","status":"Active"}},"environment":"test","type":"balancePlatform.accountHolder.created"}';
        $key = '981BD5B8B7686106D1B2A2A038D7E314A493E441E123DF00E0A8BE7527480B1C';


        $hexHash = hash_hmac('sha256', $content, hex2bin($key));
        $base64Hash = base64_encode(hex2bin($hexHash));
        $signature = 'u3ZhUrVE0QhqOyrXlV+779US4WLYauCGbeUGA678fEA=';

        Storage::disk('local')->append('example.txt', Carbon::now() . ' | signature = ' . $signature . ' | hash: ' . $base64Hash . ' | strcmp: ' . strcmp($signature, $base64Hash));
        return Carbon::now()->toDateString() . ' | signature = ' . $signature . ' | hash: ' . $base64Hash . ' | strcmp: ' . strcmp($signature, $base64Hash);
*/