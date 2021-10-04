<?php

namespace App;

class datatrans
{

    private $apiUrl;
    private $basicAuth;
    private $currency;

    const payUrl = "https://pay.sandbox.datatrans.com/v1/start/";
    const transactionsPath = "transactions";
    const paymentMethods = ["VIS","ECA","PAP","TWI"];

    public function __construct()
    {
        $this->apiUrl = "https://api.sandbox.datatrans.com/v1/";
        $this->basicAuth = "MTEwMDAzMjU4NTpwWkFwUjhOc1lEWVJNTlNl";
        $this->currency= "CHF";
    }

    private function sendReq($endpoint,$data){
        $postdata = json_encode($data);
        $ch = curl_init($this->apiUrl.$endpoint);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Basic '.$this->basicAuth));
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    public function CreateTransaction($refTransaction,$amount,$successUrl,$cancelPath,$errorUrl){
        $params = [
            'currency' => $this->currency,
            'refno' => $refTransaction,
            'amount' => $amount,
            'paymentMethods' => self::paymentMethods,
            'autoSettle' => true,
            'option' => [
                'createAlias' => true
            ],
            'redirect' => [
                'successUrl' => $successUrl,
                'cancelUrl' => $cancelPath,
                'errorUrl' => $errorUrl
            ]
        ];

        $response = self::sendReq(self::transactionsPath,$params);
        return $response;
    }

}