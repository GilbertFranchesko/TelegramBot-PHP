<?php

require_once "StartCommand.php";

class RouterCommand
{
    public function run($messageText)
    {
        switch($messageText)
        {
            case "/start":
                {
                    StartCommand::run();
                    break;
                }
        }
    }
}