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
        "➖ Отменить" => "cancel",

/**
 *       Статусы 
 */

        "📝Сегодня" => "todayOrderStats",
        "📝Вчера" => "yesterdayOrderStats",
        "📝Позавчера" => "towDaysAgoOrderStats",
        "📝7 дней" => "weekOrderStats",
        "📝30 дней" => "monthAgoOrderStats",
        "📝Весь период" => "allOrderStats",

        
/**
 *       Маржа 
 */

        "💲Сегодня" => "todayProfitStats",
        "💲Вчера" => "yesterdayProfitStats",
        "💲7 дней" => "weekProfitStats",
        "💲Прошлый месяц" => "monthAgoProfitStats",
/**
 *       Топ 10 продаж 
 */
        "📈За сегодня" => "todayTopTen",
        "📈За вчера" => "yesterdayTopTen",
        "📈За 3 дня" => "threeDaysTopTen",
        "📈За 5 дней" => "fiveDaysTopTen",
        "📈За неделю" => "weekTopTen"


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
        if(!$this->permission([Stykovka::TYPE_ADMIN])) return;
        $StatisticsReplyInit = new StatisticsKeyboard($this->client, $this->chatID);
        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => "Выбери период",
            "reply_markup" => $StatisticsReplyInit->periodProfit()
          ]);

    }

    public function topTenOrders()
    {
        if(!$this->permission([Stykovka::TYPE_ADMIN])) return;
        $StatisticsReplyInit = new StatisticsKeyboard($this->client, $this->chatID);
        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => "Выбери период",
            "reply_markup" => $StatisticsReplyInit->periodTopTenOrders()
          ]);
    }

/**
 *       Статусы 
 */

    public function todayOrderStats()
    {
        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $statisticData = $Stykovka->getOrdersStatistic(0, 0);

        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => $statisticData->data,
            "parse_mode" => "html"
          ]);
    }

    public function yesterdayOrderStats()
    {
        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $statisticData = $Stykovka->getOrdersStatistic(1, 0);

        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => $statisticData->data,
            "parse_mode" => "html"
          ]);
    }

    public function towDaysAgoOrderStats()
    {
        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $statisticData = $Stykovka->getOrdersStatistic(2, 0);

        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => $statisticData->data,
            "parse_mode" => "html"
          ]);
    }

    public function weekOrderStats()
    {
        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $statisticData = $Stykovka->getOrdersStatistic(7, 1);

        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => $statisticData->data,
            "parse_mode" => "html"
          ]);
    }

    public function monthAgoOrderStats()
    {
        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $statisticData = $Stykovka->getOrdersStatistic(30, 1);

        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => $statisticData->data,
            "parse_mode" => "html"
          ]);
    }

    public function allOrderStats()
    {
        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $statisticData = $Stykovka->getOrdersStatistic(0,0,1);

        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => $statisticData->data,
            "parse_mode" => "html"
          ]); 
    }

/**
 *       Маржа 
 */

    public function todayProfitStats() {}
    public function yesterdayProfitStats() {}
    public function weekProfitStats() {}
    public function monthAgoProfitStats() {}

/**
 *       Топ 10 продаж 
 */


    public function todayTopTen() {}
    public function yesterdayTopTen() {}
    public function threeDaysTopTen() {}
    public function fiveDaysTopTen() {}
    public function weekTopTen() {}



}