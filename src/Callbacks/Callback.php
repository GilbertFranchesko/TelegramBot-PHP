<?php

namespace Sync\Bot\Callbacks;

class Callback
{
    public $client;
    public $update;
    public $chatID;

    public $routeArray;

    function __construct($TelegramClient, $update)
    {
        $this->client = $TelegramClient;
        $this->update = $update;

        $this->chatID = $update->getCallbackQuery()->getFrom()->getId(); 
    }

    public function routing()
    {
        foreach($this->routeArray as $callbackData => $className)
        {
            if($this->update->getCallbackQuery()->getData() == $callbackData)
            {
                $methodName = str_replace("/", "", $callbackData);
            
                $initExecuteClass = new $className($this->client, $this->update);
                var_dump($methodName);
                $initExecuteClass->$methodName($this->update->getCallbackQuery()->getData());
            }
            
        }
    }
}