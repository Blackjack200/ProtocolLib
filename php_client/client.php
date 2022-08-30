<?php

use prokits\impl\FallbackDataCollector;
use prokits\impl\WrappedTrackerClient;

require_once __DIR__ . '/../vendor/autoload.php';

$nodeId = "node-" . mt_rand(1, 1000);
$nodeType = "slave";
$client = new WrappedTrackerClient('localhost:8888', new FallbackDataCollector(), $nodeId, $nodeType);
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