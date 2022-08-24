<?php

use Blackjack200\ProtocolLib\client\TcpClient;
use Blackjack200\ProtocolLib\utils\InetAddress;
use Blackjack200\ProtocolLib\utils\MainLogger;

require 'vendor/autoload.php';
function createClient($i) : TcpClient {
	return new TcpClient(new InetAddress('127.0.0.1', 8849, 4), 'test-' . $i, "test");
}

/** @var TcpClient[] $clients */
/*$clients = [];
for ($i = 0; $i < 1000; $i++) {
	$clients[] = createClient($i+1);
}
while (true) {
	foreach ($clients as $client) {
*/
$logger = new MainLogger();
$client = createClient(random_int(1, 9));
$client->setHandleBroadcastFunc(static function(string $topic, string $source, array $data) use ($logger) : void {
	if ($topic === "chat") {
		[$msg] = $data;
		$logger->info("received broadcast $topic from $source: $msg");
	}
});
$client->login();
while (!$client->isDisconnected()) {
	$client->tick(true, ['iplayfordev']);
	$client->broadcast("chat", "IPlayfordev: test");
	sleep(1);
}
/*
}
}
*/