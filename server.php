<?php

use Blackjack200\ProtocolLib\server\TcpServer;
use Blackjack200\ProtocolLib\utils\InetAddress;
use Blackjack200\ProtocolLib\utils\MainLogger;

require 'vendor/autoload.php';
$logger = new MainLogger(false);
$server = new TcpServer(new InetAddress('127.0.0.1', 8849, 4), $logger);
$logger->info("started");
while (true) {
	$server->listen();
}