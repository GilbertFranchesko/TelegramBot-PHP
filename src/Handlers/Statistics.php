<?php

namespace Sync\Bot\Handlers;

use Sync\Bot\Keyboards\Statistics as StatisticsKeyboard;


use Sync\Bot\Scripts\Stykovka;
use Sync\Bot\Handlers\Handlers;


class Statistics extends Handlers
{

    public $steps = array(
        "Статусы заказов" => "today",
        "➖ Отменить" => "cancel"
    );

    public function handle()
    {
        if(!$this->permission([Stykovka::TYPE_ADMIN, Stykovka::TYPE_DRIVER])) return;

        $StatisticsReplyInit = new StatisticsKeyboard($this->client, $this->chatID);

        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => "Выбери отчёт",
            'reply_markup' => $StatisticsReplyInit->get() 
          ]);

    }

    public function today()
    {
        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => "Работаем"
          ]);
    }
}