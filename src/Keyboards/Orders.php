<?php


namespace Sync\Bot\Keyboards;

class Orders
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
            ['📦 Упаковка', '🚚 Статистика по заказам'],
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