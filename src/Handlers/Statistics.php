<?php

namespace Sync\Bot\Handlers;

use Sync\Bot\Keyboards\Statistics as StatisticsKeyboard;


use Sync\Bot\Scripts\Stykovka;
use Sync\Bot\Handlers\Handlers;


class Statistics extends Handlers
{

    public $steps = array(
        "Статусы заказов" => "statuses",
        "Маржа" => "profit",
        "Топ 10 продаж" => "topTenOrders",
        "➖ Отменить" => "cancel"
    );

    public function handle()
    {
        if(!$this->permission([Stykovka::TYPE_ADMIN])) return;

        $StatisticsReplyInit = new StatisticsKeyboard($this->client, $this->chatID);

        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => "Выбери отчёт",
            'reply_markup' => $StatisticsReplyInit->get() 
          ]);

    }

    public function statuses()
    {
        if(!$this->permission([Stykovka::TYPE_ADMIN])) return;

        $StatisticsReplyInit = new StatisticsKeyboard($this->client, $this->chatID);
        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => "Выбери период",
            "reply_markup" => $StatisticsReplyInit->period()
          ]);
    }

    public function profit()
    {
        
    }

    public function topTenOrders()
    {

    }

}