<?php

require_once __DIR__ . '/vendor/autoload.php';

use Grpc\ChannelCredentials;
use prokits\protocol\LoginRequest;
use prokits\protocol\LoginResponse;
use prokits\protocol\LoginStatusCode;
use prokits\protocol\NodeInfo;
use prokits\protocol\NodePerformanceInfo;
use prokits\protocol\SelectServerRequest;
use prokits\protocol\SelectServerResponse;
use prokits\protocol\TrackerClient;

$client = new TrackerClient('localhost:8888', ['credentials' => ChannelCredentials::createInsecure()]);
$nodeId = "node-" . mt_rand(1, 1000);
$nodeType = "slave";
if ($client->waitForReady(PHP_INT_MAX)) {
	[$data, $status] = $client->Login(
		(new LoginRequest())
			->setNodeId($nodeId)
			->setType($nodeType)
			->setInfo((new NodeInfo())
				->setNodeId($nodeId)
				->setCanJoin(true)
				->setMaxOnlinePlayers(1)
				->setOnlinePlayers([])
				->setPerformanceInfo((new NodePerformanceInfo())
					->setAverageTps(20.0)
					->setTps(20)
				)
			)
	)->wait();
	assert($data instanceof LoginResponse);
	if ($data->getStatus() === LoginStatusCode::SUCCESS) {
		[$d, $_] = $client->Select((new SelectServerRequest())->setNodeId($nodeId)->setRequestedYpe('slave'))->wait();
		assert($d instanceof SelectServerResponse);
		var_dump($d->getTargetNodeId());
		//$client->Quit((new QuitRequest())->setNodeId($nodeId))->wait();
	}

}