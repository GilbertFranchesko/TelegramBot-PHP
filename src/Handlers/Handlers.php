<?php


namespace Sync\Bot\Handlers;

use Sync\Bot\Scripts\Stykovka;
use Sync\Bot\Keyboards\General;

class Handlers
{
    public $client;
    public $updates;
    
    public $routeArray;
    public $routeStepsArray;

    public $callbackRouteArray;

    public $keyboard;

    public $chatID;

    function __construct($client, $updates)
    {
        $this->client = $client;
        $this->updates = $updates;

        $this->chatID = $updates->getMessage()->getFrom()->getId();
    }

    public function routing()
    {
        $messageText = $this->updates->getMessage()->getText();
        foreach($this->routeArray as $route => $className)
        {
            $initExecuteClass = new $className($this->client, $this->updates);     
            if($messageText == $route)
            {           
                $initExecuteClass->handle();
            }
            else if($initExecuteClass != null)
            {
                if(!empty($initExecuteClass->steps))
                {
                    foreach($initExecuteClass->steps as $stepHandler => $methodName)
                    {
                        if($messageText == $stepHandler)
                        {
                            $initExecuteClass->$methodName();
                        }
                    }
                }
                
                if(!empty($initExecuteClass->dynamicHandlers))
                {
                   foreach($initExecuteClass->dynamicHandlers as $dynamicHalder => $methodName)
                   {
                       $checkDynamic = strpos($messageText, $dynamicHalder);
                    //    var_dump($checkDynamic);
                        if($checkDynamic === 0)
                        {
                            $getDynamicArg = explode(" ", $messageText);
                            array_splice($getDynamicArg, 0,1);
                            $initExecuteClass->$methodName($getDynamicArg);
                        }
                   }
                }

                // if(!empty($this->callbackRouteArray) && isset($this->client->callback_query))
                // { 
                //     foreach($this->callbackRouteArray as $callbackQuery => $className)
                //     {
                        
                        
                //         $initExecuteClass = new $className($this->client, $this->updates);
                //         if($this->client->callback_query->data == $callbackQuery)
                //         {
                //             $methodName = str_replace("/", "", $callbackQuery);
                //             var_dump($methodName);
                //             $initExecuteClass->$methodName($this->updates);
                //         }
                //     }
                // }


            }
        }
    }

    public function routingStep($mainClass, $routeArray)
    {
        $messageText = $this->updates->getMessage()->getText();
        foreach($routeArray as $route => $methodName)
        {
            if($messageText == $route)
            {
                $initExecuteMethod = $mainClass->$methodName();
            }
        }
    }


    public function permission($typeUserArray)
    {
        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        if(in_array($Stykovka->type, $typeUserArray))
        {
            return true;
        }
        else {
            $response = $this->client->sendMessage([
                'chat_id' => $this->chatID, 
                'text' => 'Заблудились?'
              ]);
        }

    }

    public function cancel()
    {
        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $GeneralKeyboard = new General($this->client, $Stykovka->type);


        $replyMarkup = $GeneralKeyboard->get();

        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => 'ВНИМАНИЕ!!! Если что-то пошло не так, нажмите здесь 👉 /start',
            "reply_markup" => $replyMarkup
          ]);
    }
}