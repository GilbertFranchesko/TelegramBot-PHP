<?php

namespace Sync\Bot\Handlers;

use Sync\Bot\Handlers\Handlers;

class Statistics extends Handlers
{

    public function handle()
    {
        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => 'Hello World'
          ]);
    }
}