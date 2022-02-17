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
        $supplierObject = Registry::get("supplierObject");
        var_dump($supplierObject);
        // $commands = $this->telegram->getCommands();

        // $text = '';
        // foreach ($commands as $name => $handler) {
        //     $text .= sprintf('/%s - %s'.PHP_EOL, $name, $handler->getDescription());
        // }

        // $this->replyWithMessage(compact('text'));

            

    }
}