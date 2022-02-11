<?php

require 'vendor/autoload.php';

use Telegram\Bot\Api;

$telegram = new Api('5098676907:AAFpQBrAK8y3tJujjwm_VG63858-qry3Gks');

$updates = $telegram->getWebhookUpdates();

$chatID = $updates->getMessage()->getFrom()->getId();
$firstName = $updates->getMessage()->getFrom()->getFirstName();
$lastName = $updates->getMessage()->getFrom()->getLastName();

$response = $telegram->sendMessage([
    'chat_id' => '447774527', 
    'text' => "Hello $firstName $lastName"
  ]);


