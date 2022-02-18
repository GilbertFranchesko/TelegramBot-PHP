<?php

namespace Sync\Bot\Keyboards;


class Statistics
{
    public $client;
    public $type;

    function __construct($TelegramClient, $type)
    {
        $this->client = $TelegramClient;
        $this->type = $type;
    }

    public function get()
    {
        $keyboards = [
            ['Статусы заказов', 'Марка', 'Топ 10 продаж'],
            ['➖ Отменить']
        ];

        
        $replyMarkup = $this->client->replyKeyboardMarkup([
            'keyboard' => $keyboards, 
            'resize_keyboard' => true, 
            'one_time_keyboard' => false
        ]);

        return $replyMarkup;
    }




}