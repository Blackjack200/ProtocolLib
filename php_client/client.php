<?php

use prokits\impl\WrappedTrackerClient;
use prokits\protocol\NodeInfo;

require_once __DIR__ . '/../vendor/autoload.php';

$nodeId = "node-" . mt_rand(1, 1000);
$nodeType = "slave";
$client = new WrappedTrackerClient('localhost:8888', $nodeId, $nodeType, static fn() => new NodeInfo());
$client->connect();
$client->subscribe("topic", static function(...$data) : void {
	var_dump($data);
});
while (true) {
	$client->heartbeat();
	$client->publish("topic", "hi!");
	var_dump($client->select('slave'));
	var_dump(($client->getAllNodeInfo()));
	sleep(1);
}