<?php

/**
 * Initial Stykovka Bot
 */

require 'vendor/autoload.php';

ini_set('display_errors', 1);

// ini_set('log_errors', 'On');
// ini_set('error_log', 'error.txt');
    
use Telegram\Bot\Api;
use Sync\Bot\Scripts\Stykovka;

$Token = $_GET['bot'];

$telegram = new Api($Token);

// $StykovkaAPI = new Sync\Bot\Scripts\Stykovka();
// $StykovkaAPI->token = "123321";

$telegram->addCommands([Sync\Bot\Commands\StartCommand::class,
                      Sync\Bot\Commands\HelpCommand::class
]);
$commandsHandler = $telegram->commandsHandler(true);

// $telegram->addCommand($StartCommand);


// $StykovkaAPI = new Stykovka();
// $initBotOnServer = $StykovkaAPI->initStore($Token);

$updates = $telegram->getWebhookUpdates();

$chatID = $updates->getMessage()->getFrom()->getId();
$firstName = $updates->getMessage()->getFrom()->getFirstName();
$lastName = $updates->getMessage()->getFrom()->getLastName();
$text = $updates->getMessage()->getText();