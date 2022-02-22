<?php

namespace Sync\Bot\Callbacks;

class Product
{
    public $client;
    public $updates;

    public $chatID; 



    function __construct($TelegramClient, $updates)
    {
        $this->client = $TelegramClient;
        $this->updates = $updates;

        $this->chatID = $updates->getCallbackQuery()->getFrom()->getId();
    }

    public function offproduct($updates)
    {
        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => json_encode($updates)
          ]);
    }


}