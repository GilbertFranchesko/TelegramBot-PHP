<?php

namespace Sync\Bot\Handlers;

use Sync\Bot\Handlers\Handlers;
use Sync\Bot\Scripts\Stykovka;

use Sync\Bot\Keyboards\Suppliers as SuppliersKeyboard;

class Suppliers extends Handlers
{

    public $dynamicHandlers = array(
        "Конт" => "getSupplierInfo",
        "msg" => "sendMessageAllSuppliers"
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
        $supplier = $dynamic[0];
        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $supplierInfo = $Stykovka->getSupplierProductInfo($supplier);


        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID,     
            'text' => $supplierInfo->data,
            'parse_mode' => 'HTML'
          ]);
    }

    public function sendMessageAllSuppliers($dynamic)
    {
        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $suppliersChatID = $Stykovka->getAllSuppliersChat();

        foreach($suppliersChatID->data as $chatID)
        {
            $message = $dynamic[0];
            $response = $this->client->sendMessage([
            'chat_id' => $chatID->chat_id,     
            'text' => $message,
            'parse_mode' => 'HTML'
          ]);
        }


        
    }
}