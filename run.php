<?php
require_once __DIR__ . '/vendor/autoload.php';

use Discord\Discord;
use Discord\WebSockets\Intents;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$discord = new Discord([
    'token' => $_ENV['TOKEN'],
    'storeMessages' => true,
    'pmChannels' => true,
    'loadAllMembers' => true,
    'intents' => Intents::getDefaultIntents() | Intents::GUILD_MEMBERS,
]);

$discord->on('ready', function(Discord $discord) {
    $discord->updatePresence(null, false, $_ENV['BOT_STATUS']);
});

$discord->run();