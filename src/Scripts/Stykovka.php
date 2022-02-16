<?php

namespace Sync\Bot\Scripts;

class Stykovka
{

    public $token;
    

    public $name;
    public $URL;
    public $apiKey;
    public $telegramToken;
    public $secretKey;
    public $status;

    private $APIUrl = "https://femzone.space/";

    function __construct($telegramToken)
    {
        $shopObject = $this->initStore($telegramToken);
        
        $this->name = $shopObject->name;
        $this->URL = $shopObject->URL;
        $this->apiKey = $shopObject->api_key;
        $this->telegramToken = $shopObject->tg_token;
        $this->secretKey = $shopObject->secret_key;
        $this->status = $shopObject->status;
    }

    public function setToken($storeToken)
    {
        $this->token = $storeToken;
        return true;
    }

    public function showToken()
    {
        return $this->token;
    }

    public function initStore($tg_token)   
    {
        $requestParams = array(
            "tg_token" => $tg_token
        );

        $request = $this->RestRequest("store", "initialBot", $requestParams);
        return $request;    
    }


    private function RestRequest($controller, $action, $body)
    {

        $modifyURL = $this->APIUrl.$controller."/".$action;

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $modifyURL,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($body)
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response);
    }

}
