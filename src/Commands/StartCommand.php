<?php

namespace Sync\Bot\Commands;

use Sync\Bot\Scripts\Stykovka;
use Sync\Bot\Keyboards\General;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "start";
    
    /**
     * @var string Command Description
     */
    protected $description = "Start Command to get you started";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {

        $chatID = $this->getUpdate()->getMessage()->getChat()->getId();
        $Stykovka = new Stykovka($_GET['bot'], $chatID);


        $General = new General($this->telegram);


        $this->replyWithChatAction(['action' => Actions::TYPING]);
        $this->replyWithMessage(['text' => "hello ".$Stykovka->supplier->container, "reply_markup" => $General->get()]);

    }
}