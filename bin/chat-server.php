<?php

use App\Controller\ChatController;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

require dirname(__DIR__) . '/vendor/autoload.php';

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new ChatController()
        )
    ),
    8080
);

echo "Serveur WebSocket démarré sur le port 8080...\n";
$server->run();