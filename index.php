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

use Sync\Bot\Handlers\Handlers;

$Token = $_GET['bot'];

$telegram = new Api($Token);
    
$telegram->addCommands([Sync\Bot\Commands\StartCommand::class,
                      Sync\Bot\Commands\HelpCommand::class
]);
$commandsHandler = $telegram->commandsHandler(true);


$updates = $telegram->getWebhookUpdates();

$chatID = $updates->getMessage()->getFrom()->getId();

$messageText = $updates->getMessage()->getText();

$HandlersRouting = new Handlers($telegram, $updates);

$handlersRoutes = array(
    "📊 Статистика" => Sync\Bot\Handlers\Statistics::class,
    "👗 Заказы" => Sync\Bot\Handlers\Orders::class,
    "💀 Поставщики" => Sync\Bot\Handlers\Suppliers::class
);

$HandlersRouting->routeArray = $handlersRoutes;
$HandlersRouting->routing();

// switch($messageText)
// {
//     case "📊 Статистика":
//         {
//             $response = $telegram->sendMessage([
//                 'chat_id' => '447774527', 
//                 'text' => "Hello"
//               ]);
//             break;
//         }
// }