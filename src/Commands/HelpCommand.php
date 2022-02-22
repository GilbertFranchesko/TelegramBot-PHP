<?php

namespace Sync\Bot\Commands;

use Sync\Bot\Scripts\Registry;

use Telegram\Bot\Commands\Command;


/**
 * Class HelpCommand.
 */
class HelpCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'help';

    /**
     * @var string Command Description
     */
    protected $description = 'Help command, Get a list of commands';

    /**
     * {@inheritdoc}
     */
    public function handle($arguments)
    {
        $keyboard = array(
            "text" => "TEST",
            "callback_data" => "testCall"
        );
        $inline_button1 = array("text"=>"Google url","callback_data"=>"/test");
        $inline_button2 = array("text"=>"work plz","callback_data"=>'/offproduct');
        $inline_keyboard = [[$inline_button1,$inline_button2]];
        $keyboard=array("inline_keyboard"=>$inline_keyboard);

        $replyMarkup = $this->telegram->InlineKeyboardButton($keyboard);

        $this->replyWithMessage(['text' => "test", "reply_markup" => $replyMarkup]);

    }
}