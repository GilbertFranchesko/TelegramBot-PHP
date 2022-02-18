<?php


namespace Sync\Bot\Handlers;

class Handlers
{
    public $client;
    public $updates;

    public $chatID;

    function __construct($client, $updates)
    {
        $this->client = $client;
        $this->updates = $updates;

        $this->chatID = $updates->getMessage()->getFrom()->getId();
    }

    public function routing($routeArray)
    {
        $messageText = $this->updates->getMessage()->getText();
        foreach($routeArray as $route => $className)
        {
            if($messageText == $route)
            {
                $initExecuteClass = new $className($this->client, $this->updates);
                $initExecuteClass->handle();
            }
        }
    }
}