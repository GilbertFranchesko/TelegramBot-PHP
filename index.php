<?php

/**
 * Initial Stykovka Bot
 */

require 'vendor/autoload.php';
require_once 'stykovka.php';


// ini_set('log_errors', 'On');
// ini_set('error_log', 'error.txt');

use Telegram\Bot\Api;

$Token = $_GET['bot'];

$telegram = new Api($Token);

// $telegram->addCommand($StartCommand);
// $update = $telegram->commandsHandler(true);

$StykovkaAPI = new StykovkaAPI();

$initBotOnServer = $StykovkaAPI->initStore($Token);

$updates = $telegram->getWebhookUpdates();

$chatID = $updates->getMessage()->getFrom()->getId();
$firstName = $updates->getMessage()->getFrom()->getFirstName();
$lastName = $updates->getMessage()->getFrom()->getLastName();
$text = $updates->getMessage()->getText();


switch($text) {
  case "/start": {
    $response = $telegram->sendMessage([
      'chat_id' => $chatID, 
      'text' => $initBotOnServer->name
    ]);
  }
}
