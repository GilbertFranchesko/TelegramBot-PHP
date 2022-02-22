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
use Sync\Bot\Callbacks\Callback;

$Token = $_GET['bot'];

$telegram = new Api($Token);
    
$telegram->addCommands([Sync\Bot\Commands\StartCommand::class,
                      Sync\Bot\Commands\HelpCommand::class
]);
$commandsHandler = $telegram->commandsHandler(true);





$updates = $telegram->getWebhookUpdates();

$response = $telegram->sendMessage([
    'chat_id' => 447774527, 
    'text' => json_encode($updates)
  ]);

if($updates->getCallbackQuery() != NULL)
{
    $CallbacksRouting = new Callback($telegram, $updates);
    $callbackRouteArray = array(
        "/offproduct" => Sync\Bot\Callbacks\Product::class
    );
    $CallbacksRouting->routeArray = $callbackRouteArray;
    
    $CallbacksRouting->routing();  
}
else 
{
    $chatID =  $updates->getMessage()->getFrom()->getId();
    
    $messageText = $updates->getMessage()->getText();
    
    $HandlersRouting = new Handlers($telegram, $updates);
    
    
    $handlersRoutes = array(
        "📊 Статистика" => Sync\Bot\Handlers\Statistics::class,
        "👗 Заказы" => Sync\Bot\Handlers\Orders::class,
        "💀 Поставщики" => Sync\Bot\Handlers\Suppliers::class
    );
    
    
    
    $HandlersRouting->routeArray = $handlersRoutes;
   
    
    
    $HandlersRouting->routing();
}



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