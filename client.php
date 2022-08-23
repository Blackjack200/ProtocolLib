<?php

use Blackjack200\ProtocolLib\client\TcpClient;
use Blackjack200\ProtocolLib\utils\InetAddress;

require 'vendor/autoload.php';
function createClient($i) : TcpClient {
	return new TcpClient(new InetAddress('127.0.0.1', 8849, 4), 'test-' . $i, "test");
}

/** @var TcpClient[] $clients */
$clients = [];
for ($i = 0; $i < 1000; $i++) {
	$clients[] = createClient($i+1);
}
while (true) {
	foreach ($clients as $client) {
		if (!$client->isDisconnected()) {
			echo "----{$client->getNodeId()}----\n";
			$client->tick(true, ['iplayfordev']);
			if ($client->isOpen()) {
				$client->select("test");
			}
			echo "-----------\n";
		}
	}
}