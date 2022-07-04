<?php


namespace Sync\Bot\Keyboards;

use Sync\Bot\Scripts\Stykovka;

class General
{

    public $client;
    public $type;

    const STATS_BUTTON = "📊 Статистика";
    const ORDERS_BUTTON = "👗 Заказы";
    const MYPRODUCTS_BUTTON = "🚚 Мои Товары";
    const SUPPLIERS_BUTTON = "💀 Поставщики";
    const SUPPLIERS_MSG_BUTTON = "🎫 Сообщение поставщикам";

    function __construct($TelegramClient, $type)
    {
        $this->client = $TelegramClient;
        $this->type = $type;
    }

    public function get()
    {

        $keyboards = null;
        if($this->type == Stykovka::TYPE_ADMIN)
        {
            $keyboards = [
                [General::STATS_BUTTON, General::ORDERS_BUTTON, General::MYPRODUCTS_BUTTON],
                [General::SUPPLIERS_BUTTON, General::SUPPLIERS_MSG_BUTTON]
            ];
        }
        else if($this->type == Stykovka::TYPE_DRIVER)
        {
            $keyboards = [
                [General::ORDERS_BUTTON]
            ];
        }

        else if($this->type == Stykovka::TYPE_SUPPLIER)
        {
            $keyboards = [
                [General::MYPRODUCTS_BUTTON, General::ORDERS_BUTTON]
            ];
        }

       if($keyboards == null)
       {
         $replyMarkup = $this->client->replyKeyboardHide();           
       }
       else {
            $replyMarkup = $this->client->replyKeyboardMarkup([
                'keyboard' => $keyboards, 
                'resize_keyboard' => true, 
                'one_time_keyboard' => false
            ]);
       }
        return $replyMarkup;
    }

}