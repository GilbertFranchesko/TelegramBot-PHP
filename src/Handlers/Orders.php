<?php


namespace Sync\Bot\Handlers;

use Sync\Bot\Keyboards\Orders as OrdersKeyboard;
use Sync\Bot\Keyboards\Suppliers as SuppliersKeyboard;
use Sync\Bot\Handlers\Handlers;
use Sync\Bot\Scripts\Stykovka;

class Orders extends Handlers
{
    public $steps = array(
        "📦 Упаковка" => "package",
        "🚚 Статистика по заказам" => "statsFromOrders"
    );

    public function handle()
    {
        if(!$this->permission([Stykovka::TYPE_ADMIN, Stykovka::TYPE_SUPPLIER])) return;

        $OrdersKeyboardInit = new OrdersKeyboard($this->client, $this->chatID);

        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => "Что надо по товарам:",
            'reply_markup' => $OrdersKeyboardInit->get() 
          ]);
    }

    public function package()
    {
        if(!$this->permission([Stykovka::TYPE_ADMIN, Stykovka::TYPE_SUPPLIER])) return;

        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $suppliersPackage = $Stykovka->getSuppliersPackage();

        if($suppliersPackage == NULL)
        {
            $response = $this->client->sendMessage([
                'chat_id' => $this->chatID, 
                'text' => "На данный момент упаковки нет!"
            ]);

            return false;
        }

        else
        {
            $suppliersKeyboardInit = new SuppliersKeyboard($this->client, $this->chatID);

            $response = $this->client->sendMessage([
                'chat_id' => $this->chatID, 
                'text' => "Выберите поставщика: ",
                'reply_markup' => $OrdersKeyboardInit->generatePackageSuppliers() 
              ]);

              return true;
        }
    }

    public function statsFromOrders()
    {
        if(!$this->permission([Stykovka::TYPE_ADMIN, Stykovka::TYPE_SUPPLIER])) return;

        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $ordersInfo = $Stykovka->getOrdersInfo();

        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => $ordersInfo->data,
            "parse_mode" => "html"
          ]);

    }
}
