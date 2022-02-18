<?php


namespace Sync\Bot\Handlers;

use Sync\Bot\Keyboards\Orders as OrdersKeyboard;
use Sync\Bot\Handlers\Handlers;

class Orders extends Handlers
{
    public $steps = array(
        "📦 Упаковка" => "package",
        "🚚 Статистика по заказам" => "statsFromOrders"
    );

    public function handle()
    {
        $OrdersKeyboardInit = new OrdersKeyboard($this->client, $this->chatID);

        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => "Что надо по товарам:",
            'reply_markup' => $OrdersKeyboardInit->get() 
          ]);
    }

    public function package()
    {

    }

    public function statsFromOrders()
    {

    }
}
