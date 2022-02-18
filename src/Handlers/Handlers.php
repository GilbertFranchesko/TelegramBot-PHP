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
                foreach($initExecuteClass->steps as $stepHandler => $methodName)
                {
                    if($messageText == $stepHandler)
                    {
                        $initExecuteClass->$methodName();
                    }
                }
            }
        }
    }

    public function routingStep($mainClass, $routeArray)
    {
        var_dump($routeArray);
        $messageText = $this->updates->getMessage()->getText();
        foreach($routeArray as $route => $methodName)
        {
            if($messageText == $route)
            {
                var_dump("ok");
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