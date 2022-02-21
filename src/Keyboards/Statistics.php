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
            ['Статусы заказов', 'Маржа', 'Топ 10 продаж'],
            ['➖ Отменить']
        ];

        
        $replyMarkup = $this->client->replyKeyboardMarkup([
            'keyboard' => $keyboards, 
            'resize_keyboard' => true, 
            'one_time_keyboard' => false
        ]);

        return $replyMarkup;
    }

    public function period()
    {
        $keyboards = [
            ['📝Сегодня', '📝Вчера', '📝Позавчера'],
            ['📝7 дней', '📝30 дней', '📝Весь период'],
            ['➖ Отменить']
        ];

        $replyMarkup = $this->client->replyKeyboardMarkup([
            'keyboard' => $keyboards, 
            'resize_keyboard' => true, 
            'one_time_keyboard' => false
        ]);

        return $replyMarkup;
    }

    public function periodProfit()
    {
        $keyboards = [
            ['💲Сегодня', '💲Вчера'],
            ['💲7 дней', '💲Прошлый месяц'],
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