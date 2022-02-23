<?php

namespace Sync\Bot\Keyboards;

class Product
{

    public $keyboards;

    public function infoProduct($productID)
    {
        $this->keyboards = array("text" => "Информация о товаре", "callback_data" => "/productinfo $productID");
    }

    public function get()
    {
        $inlineKeyboard = array("inline_keyboard" => array(array($this->keyboards)));
        var_dump(json_encode($inlineKeyboard));
        return json_encode($inlineKeyboard);
    }
}