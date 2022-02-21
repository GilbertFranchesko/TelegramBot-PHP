<?php

namespace Sync\Bot\Keyboards;

use Sync\Bot\Scripts\Stykovka;


class Suppliers
{
    public $client;
    public $type;

    public $chatID;
    function __construct($TelegramClient, $type)
    {
        $this->client = $TelegramClient;
        $this->type = $type;

        // $this->chatID = $this->client->getMessage()->getFrom()->getId();

    }

    public function get($suppliersArray)
    {
        $keyboards = array();
        foreach($suppliersArray as $supplier)
        {
            array_push($keyboards, array("Конт ".$supplier->sup_id));
        }

        array_push($keyboards, array("➖ Отменить"));

        $replyMarkup = $this->client->replyKeyboardMarkup([
            'keyboard' => $keyboards, 
            'resize_keyboard' => true, 
            'one_time_keyboard' => false
        ]);

        return $replyMarkup;        
    }
}