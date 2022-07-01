<?php

namespace Sync\Bot\Scripts;

use Sync\Bot\Models\Supplier;

class Stykovka
{

    public $token;
    

    public $name;
    public $URL;
    public $apiKey;
    public $telegramToken;
    public $secretKey;
    public $status;
    public $type;

    public $supplier;

    const TYPE_ADMIN = "Администратор";
    const TYPE_SUPPLIER = "Поставщик";
    const TYPE_DRIVER = "Водитель";

    private $APIUrl = "http://femzone.trade/";

    function __construct($telegramToken, $chatID)
    {
        $shopObject = $this->initStore($telegramToken);
        $this->id = $shopObject->id;
        $this->name = $shopObject->name;
        $this->URL = $shopObject->URL;
        $this->apiKey = $shopObject->api_key;
        $this->telegramToken = $shopObject->tg_token;
        $this->secretKey = $shopObject->secret_key;
        $this->status = $shopObject->status;

        $requestParams = array(
            "chat_id" => $chatID
        ); 
        $requestCheckAdminDriver = $this->RestRequestAuth("telegramUser","getBy", $requestParams, $shopObject->secret_key);
        
        if($requestCheckAdminDriver != null)
        {
            $this->type = $requestCheckAdminDriver->type;

        //    // Определим админ он или закупщик
        //    if($requestCheckAdminDriver->type == self::TYPE_ADMIN) $this->type = self::TYPE_ADMIN;
        //    else if($requestCheckAdminDriver->type == self::TYPE_DRIVER) $this->type = self::TYPE_DRIVER;
        }
        else {
            $requestCheckSupplier = $this->getSupplierInfo($chatID);

            if($requestCheckSupplier == null) echo "not in db";
            else $this->supplier = $requestCheckSupplier;
        }

        

        // $supplierData = $this->getSupplierInfo($chatID);
        // $this->supplier = new Supplier($supplierData->sup_id, $supplierData->cont, $supplierData->chat_id);
    }

    public function initStore($tg_token)   
    {
        $requestParams = array(
            "tg_token" => $tg_token
        );

        $request = $this->RestRequest("store", "initialBot", $requestParams);
        return $request;    
    }


    public function getSupplierInfo($chatID)
    {
        $requestParams = array(
            "chat_id" => $chatID
        );

        $request = $this->RestRequestAuth("supplier", "getBy", $requestParams, $this->secretKey);
        return $request;
    }

    public function getSuppliersByStore()
    {
        $requestParams = array(
            "store_id" => $this->id
        );

        $request = $this->RestRequestAuth("suppliersToStore", "getManyBy", $requestParams, $this->secretKey);
        return $request;
    }


    public function getOrdersStatistic($interval, $dateSub, $all=0)
    {
        $response = $this->CustomRequest("GET", $this->URL."/index.php?route=rest/tg_bot_api/getStatsStatus&interval=".$interval, array(), $this->apiKey);

        var_dump($response);
        return $response;   
    }

    
    public function getProfitStatic($interval, $dateSub, $all=0)
    {
        $response = $this->CustomRequest("GET", $this->URL."/index.php?route=rest/tg_bot_api/getProfit&interval=".$interval."&date_sub=".$dateSub."&all=".$all, array(), $this->apiKey);

        var_dump($response);
        return $response;   
    }

    public function getSupplierProductInfo($supID)
    {
        $response = $this->CustomRequest("GET", $this->URL."/index.php?route=rest/tg_bot_api/getSupplierProducts&sup_id=".$supID, array(), $this->apiKey);

        var_dump($this->URL."/index.php?route=rest/tg_bot_api/getSupplierProducts?sup_id=".$supID);
        var_dump($response);
        return $response;   
    }

    public function getSuppliersPackage()
    {
        $response = $this->CustomRequest("GET", $this->URL."/index.php?route=rest/tg_bot_api/getPackages", array(), $this->apiKey);
        
        var_dump($response);
        return $response;
    }

    private function CustomRequest($type, $url, $body, $token)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $type,
            CURLOPT_POSTFIELDS => json_encode($body),
            CURLOPT_HTTPHEADER => array(
              'X-Oc-Restadmin-Id: '.$token.'',
              'Content-Type: application/json'
            )
          ));
  
        $response = curl_exec($curl);
  
        curl_close($curl);
  
        return json_decode($response);
    }


    private function RestRequestAuth($controller, $action, $body,$token)
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
          CURLOPT_POSTFIELDS => json_encode($body),
          CURLOPT_HTTPHEADER => array(
            'Authorization: Token '.$token.'',
            'Content-Type: application/json'
          )
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response);
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
