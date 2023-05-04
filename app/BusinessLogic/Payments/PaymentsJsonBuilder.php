<?php

namespace App\BusinessLogic\Payments;

use Illuminate\Support\Str;

class PaymentsJsonBuilder
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
     * @param $paymentsData: This is the data coming from frontend, this should include payment method
     *                        and e.g. for scheme the (encrypted) card data. If not it should at least contain the 
     *                        paymentMethod, s.t. we can fill it with dummy data here.
     */
    public static function createPaymentsBody($paymentsData, $amount = 1234, $currency = 'EUR'){
        
        //first add everything all payment methods have in common
        $body = self::getCommonDefaultValues($amount, $currency);

        return array_merge(
            $body,
            self::getPaymentMethodContent($paymentsData)
        );
    }

    private static function getCommonDefaultValues($amount, $currency){

        $body = array();

        $body["reference"] = (string) Str::orderedUuid();

        $body["merchantAccount"] = env('ADYEN_MERCHANT_ACCOUNT_NAME',null);
        
        //TODO this is still a dummy
        $body["returnUrl"] = 'https://implementation.store';

        $body["amount"] = [
            "currency" => $currency,
            "value" => $amount,
        ];

        return $body;

    }

    private static function getPaymentMethodContent($paymentsData){

        if (array_key_exists('paymentMethod', $paymentsData) && array_key_exists('type', $paymentsData['paymentMethod'])){
            $paymentMethodType = $paymentsData["paymentMethod"]["type"];
        }
        else{
            $paymentMethodType = 'scheme';
        }   

        switch ($paymentMethodType) {
            case 'scheme':
                return self::getSchemeData($paymentsData);                
                break;
            
            default:
                # code...
                dd("Unsupported payment method " . $paymentMethodType . ".");
                break;
        }
    }

    private static function getSchemeData($paymentsData){

        $returnValue = [
            "paymentMethod" => [
                "type" => "scheme"
            ]
        ];
        //TODO network tokens!

        if(array_key_exists('paymentMethod', $paymentsData)){

            //case 1: token is used
            if (array_key_exists('storedPaymentMethodId', $paymentsData['paymentMethod'])){
                $token = $paymentsData["paymentMethod"]["storedPaymentMethodId"];

                $returnValue = [
                    "paymentMethod" => [
                        "type" => "scheme",
                        "storedPaymentMethodId" => $token,
                    ],
                ];

                if (array_key_exists('cvc', $paymentsData['paymentMethod'])){
                    $returnValue['paymentMethod']['cvc'] = paymentsData['paymentMethod']['cvc'];
                }
                elseif(array_key_exists('encryptedSecurityCode', $paymentsData['paymentMethod'])){
                    $returnValue['paymentMethod']['encryptedSecurityCode'] = paymentsData['paymentMethod']['encryptedSecurityCode'];
                }
            }
            //encrypted card details are used
            elseif(array_key_exists('encryptedCardNumber', $paymentsData['paymentMethod']) &&
                array_key_exists('encryptedExpiryMonth', $paymentsData['paymentMethod']) &&
                array_key_exists('encryptedExpiryYear', $paymentsData['paymentMethod']) &&
                array_key_exists('encryptedSecurityCode', $paymentsData['paymentMethod'])){

                $returnValue['paymentMethod']['encryptedCardNumber'] = $paymentsData['paymentMethod']['encryptedCardNumber'];
                $returnValue['paymentMethod']['encryptedExpiryMonth'] = $paymentsData['paymentMethod']['encryptedExpiryMonth'];
                $returnValue['paymentMethod']['encryptedExpiryYear'] = $paymentsData['paymentMethod']['encryptedExpiryYear'];
                $returnValue['paymentMethod']['encryptedSecurityCode'] = $paymentsData['paymentMethod']['encryptedSecurityCode'];
            }
            //raw credit card details are used
            elseif(array_key_exists('number', $paymentsData['paymentMethod']) &&
            array_key_exists('expiryMonth', $paymentsData['paymentMethod']) &&
            array_key_exists('expiryYear', $paymentsData['paymentMethod'])){
                $returnValue['paymentMethod']['number'] = $paymentsData['paymentMethod']['number'];
                $returnValue['paymentMethod']['expiryMonth'] = $paymentsData['paymentMethod']['expiryMonth'];
                $returnValue['paymentMethod']['expiryYear'] = $paymentsData['paymentMethod']['expiryYear'];
                if(array_key_exists('cvc', $paymentsData['paymentMethod']))
                    $returnValue['paymentMethod']['cvc'] = $paymentsData['paymentMethod']['cvc'];
            }

            //add holder name if provided
            if (array_key_exists('holderName', $paymentsData['paymentMethod'])){
                $returnValue['paymentMethod']['holderName'] = $paymentsData['paymentMethod']['holderName'];
            }

            //Add tokenization data if provided
            $returnValue = array_merge($returnValue, self::getTokenisationData($paymentsData));

            //Add 3DS data and return
            $returnValue = array_merge($returnValue, self::get3DSData($paymentsData));
        }
        //nothing was specified => use dummy values
        else{
            //note we return here directly only the values specified here, no 3ds, no tokenization, etc., maybe improve
            return [
                "paymentMethod" => [
                    "type" => "scheme",
                    "encryptedCardNumber" => "test_5454545454545454",
                    "encryptedExpiryMonth" => "test_03",
                    "encryptedExpiryYear" => "test_2030",
                    "encryptedSecurityCode" => "test_737",
                ]
            ];
        }

        return $returnValue;
    }

    private static function getTokenisationData($paymentsData){
        if(array_key_exists('storePaymentMethod',$paymentsData) &&
            array_key_exists('recurringProcessingModel',$paymentsData) &&
            array_key_exists('storePaymentMethod',$paymentsData) &&
            array_key_exists('shopperReference',$paymentsData)){
            return [
                "storePaymentMethod" => "true",
                "shopperInteraction" => $paymentsData['shopperInteraction'],
                "recurringProcessingModel" => $paymentsData['recurringProcessingModel'],
                "shopperReference" => $paymentsData['shopperReference'],
            ];
        }

        //no data provided
        return [];
    }

    private static function get3DSData($paymentsData){
        if(array_key_exists('browserInfo', $paymentsData) &&
        array_key_exists('origin', $paymentsData)){

            $returnArray = [
                "browserInfo" => $paymentsData['browserInfo'],
                "authenticationData" => [
                    "threeDSRequestData" => [
                        "nativeThreeDS" => "preferred"
                    ],
                ],
                "channel" => "web",
                "origin" => $paymentsData['origin'],
            ];

            //add optional fields
            if(array_key_exists('billingAddress', $paymentsData)){
                $returnArray['billingAddress'] = $paymentsData['billingAddress'];
            }

            if(array_key_exists('shopperEmail', $paymentsData)){
                $returnArray['shopperEmail'] = $paymentsData['shopperEmail'];
            }

            if(array_key_exists('shopperIP', $paymentsData)){
                $returnArray['shopperIP'] = $paymentsData['shopperIP'];
            }

            return $returnArray;
        }

        //data missing
        return [];
    }
}