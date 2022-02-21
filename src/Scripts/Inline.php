<?php 

namespace Sync\Bot\Scripts\Inline;

class InlineKeyboard
{

    public $client;
    public $type;

    function __construct($TelegramClient, $type)
    {
        $this->client = $TelegramClient;
        $this->type = $type;
    }
}