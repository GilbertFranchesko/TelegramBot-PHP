<?php

namespace Sync\Bot\Handlers;

use Sync\Bot\Handlers\Handlers;
use Sync\Bot\Scripts\Stykovka;

use Sync\Bot\Keyboards\Suppliers as SuppliersKeyboard;

class Suppliers extends Handlers
{

    public $dynamicHandlers = array(
        "Конт" => "getSupplierInfo"
    ); 

    public function handle()
    {
        if(!$this->permission([Stykovka::TYPE_ADMIN])) return;

        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);


        
        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $suppliersArray = $Stykovka->getSuppliersByStore();

        $InitKeyboard = new SuppliersKeyboard($this->client, $Stykovka->type);
        $suppliersKeyboard = $InitKeyboard->get($suppliersArray);

        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => "Выбери контейнер из списка:",
            "reply_markup" => $suppliersKeyboard
          ]);

    }

    public function getSupplierInfo($dynamic)
    {
        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID,     
            'text' => $dynamic[0]
          ]);
    }
}