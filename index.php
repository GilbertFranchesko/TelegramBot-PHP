<?php

/**
 * Initial Stykovka Bot
 */

require 'vendor/autoload.php';
// require_once 'stykovka.php';


ini_set('display_errors', 1);

// ini_set('log_errors', 'On');
// ini_set('error_log', 'error.txt');

use Telegram\Bot\Api;

$Token = $_GET['bot'];

$telegram = new Api($Token);


$telegram->addCommand([Sync\Bot\Commands\StartCommand::class
                      Sync\Bot\Commands\HelpCommand::class
]);
$commandsHandler = $telegram->commandsHandler(true);

// $telegram->addCommand($StartCommand);

$StykovkaAPI = new Sync\Scripts\Stykovka\StykovkaAPI();


$initBotOnServer = $StykovkaAPI->initStore($Token);

$updates = $telegram->getWebhookUpdates();

$chatID = $updates->getMessage()->getFrom()->getId();
$firstName = $updates->getMessage()->getFrom()->getFirstName();
$lastName = $updates->getMessage()->getFrom()->getLastName();
$text = $updates->getMessage()->getText();