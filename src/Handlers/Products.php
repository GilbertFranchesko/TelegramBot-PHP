<?php


namespace Sync\Bot\Handlers;

use Sync\Bot\Handlers\Handlers;
use Sync\Bot\Scripts\Stykovka;


class Products extends Handlers
{
    public function handle() 
    {
        if(!$this->permission([Stykovka::TYPE_SUPPLIER])) return;

        $Stykovka = new Stykovka($_GET['bot'], $this->chatID);
        $getMyProducts = $Stykovka->getMyProducts();

        $messageText = "<b>Ваши товары:</b>\n";
        $messageText .= "<a href='".$getMyProducts."'>Намжмите сюда</a>";

        $response = $this->client->sendMessage([
            'chat_id' => $this->chatID, 
            'text' => $messageText,
            "parse_mode" => "html"
          ]);

    }
}
