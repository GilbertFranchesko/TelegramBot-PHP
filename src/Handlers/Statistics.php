<?php

namespace Sync\Bot\Handlers;

use Sync\Bot\Keyboards\Statistics as StatisticsKeyboard;
use Sync\Bot\Keyboards\Product as ProductPreview;


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
        if(!$this->permission([Stykovka::TYPE_ADMIN])) return;

        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $statisticData = $Stykovka->getOrdersStatistic("today");

        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => $statisticData->data,
            "parse_mode" => "HTML"
          ]);
    }

    public function yesterdayOrderStats()
    {
        if(!$this->permission([Stykovka::TYPE_ADMIN])) return;

        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $statisticData = $Stykovka->getOrdersStatistic("yesterday");

        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => $statisticData->data,
            "parse_mode" => "HTML"
          ]);
    }

    public function towDaysAgoOrderStats()
    {
        
        if(!$this->permission([Stykovka::TYPE_ADMIN])) return;

        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $statisticData = $Stykovka->getOrdersStatistic("two_day");

        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => $statisticData->data,
            "parse_mode" => "html"
          ]);
    }

    public function weekOrderStats()
    {
        if(!$this->permission([Stykovka::TYPE_ADMIN])) return;

        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $statisticData = $Stykovka->getOrdersStatistic("week");

        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => $statisticData->data,
            "parse_mode" => "html"
          ]);
    }

    public function monthAgoOrderStats()
    {
        if(!$this->permission([Stykovka::TYPE_ADMIN])) return;

        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $statisticData = $Stykovka->getOrdersStatistic("month");

        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => $statisticData->data,
            "parse_mode" => "html"
          ]);
    }

    public function allOrderStats()
    {
        if(!$this->permission([Stykovka::TYPE_ADMIN])) return;

        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $statisticData = $Stykovka->getOrdersStatistic("all");

        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => $statisticData->data,
            "parse_mode" => "html"
          ]); 
    }

/**
 *       Маржа 
 */

    public function todayProfitStats()
    {
        if(!$this->permission([Stykovka::TYPE_ADMIN])) return;

        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $statisticData = $Stykovka->getProfitStatic("today");

        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => $statisticData->data,
            "parse_mode" => "html"
          ]); 
    }
    public function yesterdayProfitStats() 
    {
        if(!$this->permission([Stykovka::TYPE_ADMIN])) return;

        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $statisticData = $Stykovka->getProfitStatic("yesterday");

        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => $statisticData->data,
            "parse_mode" => "html"
          ]); 
    }
    public function weekProfitStats() 
    {
        if(!$this->permission([Stykovka::TYPE_ADMIN])) return;

        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $statisticData = $Stykovka->getProfitStatic("week");

        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => $statisticData->data,
            "parse_mode" => "html"
          ]); 
    }
    public function monthAgoProfitStats() 
    {
        if(!$this->permission([Stykovka::TYPE_ADMIN])) return;

        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $statisticData = $Stykovka->getProfitStatic("last_month");

        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => $statisticData->data,
            "parse_mode" => "html"
          ]); 
    }

/**
 *       Топ 10 продаж 
 */


    public function todayTopTen() 
    {
        if(!$this->permission([Stykovka::TYPE_ADMIN])) return;

        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $getTopTenToday = $Stykovka->getTopTenProducts("today");
        if(count($getTopTenToday) == 0) 
        {
            $response = $this->client->sendMessage([
                'chat_id' => $this->chatID, 
                'text' => "Товаров не найдено",
                "parse_mode" => "html"
              ]); 
        } 
        else
        {
            foreach($getTopTenToday as $productInfo)
            {
                $ProductPreview = new ProductPreview();
                $ProductPreview->infoProduct($productInfo->product_id);

                $textMessage = "<b>".$productInfo['name']."</b>\n\n";
                $textMessage .= "➕ Модель: <b>".$productInfo['model']."</b>\n";
                $textMessage .= "➕ Контейнер: <b>".$productInfo['mpn']."</b>\n";
                $textMessage .= "➕ Заказов: <b>".$productInfo['sales']."</b>\n";

                $response = $telegram->sendPhoto([
                    'chat_id' => 'CHAT_ID', 
                    'photo' => $productInfo['image'],
                    'reply_markup' => $ProductPreview->get(),
                    'caption' => $textMessage
                ]);
            }
        }
    }
    public function yesterdayTopTen() 
    {
        if(!$this->permission([Stykovka::TYPE_ADMIN])) return;

        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $getTopTenToday = $Stykovka->getTopTenProducts("yesterday");
        if(count($getTopTenToday) == 0) 
        {
            $response = $this->client->sendMessage([
                'chat_id' => $this->chatID, 
                'text' => "Товаров не найдено",
                "parse_mode" => "html"
              ]); 
        } 
        else
        {
            foreach($getTopTenToday as $productInfo)
            {
                $ProductPreview = new ProductPreview();
                $ProductPreview->infoProduct($productInfo->product_id);

                $textMessage = "<b>".$productInfo['name']."</b>\n\n";
                $textMessage .= "➕ Модель: <b>".$productInfo['model']."</b>\n";
                $textMessage .= "➕ Контейнер: <b>".$productInfo['mpn']."</b>\n";
                $textMessage .= "➕ Заказов: <b>".$productInfo['sales']."</b>\n";

                $response = $telegram->sendPhoto([
                    'chat_id' => 'CHAT_ID', 
                    'photo' => $productInfo['image'],
                    'reply_markup' => $ProductPreview->get(),
                    'caption' => $textMessage
                ]);
            }
        }
    }

    
    public function threeDaysTopTen() 
    {
        if(!$this->permission([Stykovka::TYPE_ADMIN])) return;

        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $getTopTenToday = $Stykovka->getTopTenProducts("three_day");
        if(count($getTopTenToday) == 0) 
        {
            $response = $this->client->sendMessage([
                'chat_id' => $this->chatID, 
                'text' => "Товаров не найдено",
                "parse_mode" => "html"
              ]); 
        } 
        else
        {
            foreach($getTopTenToday as $productInfo)
            {
                $ProductPreview = new ProductPreview();
                $ProductPreview->infoProduct($productInfo->product_id);

                $textMessage = "<b>".$productInfo['name']."</b>\n\n";
                $textMessage .= "➕ Модель: <b>".$productInfo['model']."</b>\n";
                $textMessage .= "➕ Контейнер: <b>".$productInfo['mpn']."</b>\n";
                $textMessage .= "➕ Заказов: <b>".$productInfo['sales']."</b>\n";

                $response = $telegram->sendPhoto([
                    'chat_id' => 'CHAT_ID', 
                    'photo' => $productInfo['image'],
                    'reply_markup' => $ProductPreview->get(),
                    'caption' => $textMessage
                ]);
            }
        }
    }
    public function fiveDaysTopTen() 
    {
        if(!$this->permission([Stykovka::TYPE_ADMIN])) return;

        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $getTopTenToday = $Stykovka->getTopTenProducts("five_day");
        if(count($getTopTenToday) == 0) 
        {
            $response = $this->client->sendMessage([
                'chat_id' => $this->chatID, 
                'text' => "Товаров не найдено",
                "parse_mode" => "html"
              ]); 
        } 
        else
        {
            foreach($getTopTenToday as $productInfo)
            {
                $ProductPreview = new ProductPreview();
                $ProductPreview->infoProduct($productInfo->product_id);

                $textMessage = "<b>".$productInfo['name']."</b>\n\n";
                $textMessage .= "➕ Модель: <b>".$productInfo['model']."</b>\n";
                $textMessage .= "➕ Контейнер: <b>".$productInfo['mpn']."</b>\n";
                $textMessage .= "➕ Заказов: <b>".$productInfo['sales']."</b>\n";

                $response = $telegram->sendPhoto([
                    'chat_id' => 'CHAT_ID', 
                    'photo' => $productInfo['image'],
                    'reply_markup' => $ProductPreview->get(),
                    'caption' => $textMessage
                ]);
            }
        }
    }
    public function weekTopTen() 
    {
        if(!$this->permission([Stykovka::TYPE_ADMIN])) return;

        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $getTopTenToday = $Stykovka->getTopTenProducts("week");
        if(count($getTopTenToday) == 0) 
        {
            $response = $this->client->sendMessage([
                'chat_id' => $this->chatID, 
                'text' => "Товаров не найдено",
                "parse_mode" => "html"
              ]); 
        } 
        else
        {
            foreach($getTopTenToday as $productInfo)
            {
                $ProductPreview = new ProductPreview();
                $ProductPreview->infoProduct($productInfo->product_id);

                $textMessage = "<b>".$productInfo['name']."</b>\n\n";
                $textMessage .= "➕ Модель: <b>".$productInfo['model']."</b>\n";
                $textMessage .= "➕ Контейнер: <b>".$productInfo['mpn']."</b>\n";
                $textMessage .= "➕ Заказов: <b>".$productInfo['sales']."</b>\n";

                $response = $telegram->sendPhoto([
                    'chat_id' => 'CHAT_ID', 
                    'photo' => $productInfo['image'],
                    'reply_markup' => $ProductPreview->get(),
                    'caption' => $textMessage
                ]);
            }
        }
    }



}