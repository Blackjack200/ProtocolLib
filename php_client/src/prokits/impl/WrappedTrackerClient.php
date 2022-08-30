<?php

namespace prokits\impl;

use Google\Protobuf\GPBEmpty;
use Grpc\ChannelCredentials;
use prokits\protocol\BroadcastMessage;
use prokits\protocol\HeartbeatResponse;
use prokits\protocol\LoginRequest;
use prokits\protocol\LoginResponse;
use prokits\protocol\LoginStatusCode;
use prokits\protocol\NodeInfo;
use prokits\protocol\NodeInfoResponse;
use prokits\protocol\SelectServerRequest;
use prokits\protocol\SelectServerResponse;
use prokits\protocol\TrackerClient;
use prokits\utils\Bus;
use stdClass;
use const Grpc\STATUS_OK;

class WrappedTrackerClient {
	private ?TrackerClient $client = null;
	private Bus $bus;

	public function __construct(
		private string                 $hostname,
		private DataCollectorInterface $collector,
		private string                 $nodeId,
		private string                 $type,
		private int                    $timeoutSec = 5
	) {
		$this->bus = new Bus();
	}

	public function setCollector(DataCollectorInterface $collector) : void { $this->collector = $collector; }

	public function getClient() : ?TrackerClient { return $this->client; }

	public function heartbeat() : void {
		if (!$this->checkConnection()) {
			return;
		}
		[$response, $status] = $this->client->Heartbeat($this->obtainNodeInfo())->wait();
		$this->checkStatus($status);
		if ($response instanceof HeartbeatResponse) {
			foreach ($response->getMsg() as $msg) {
				assert($msg instanceof BroadcastMessage);
				$this->bus->publish($msg->getTopic(), $msg->getNodeId(), $msg->getData());
			}
		}
	}

	private function checkConnection() : bool {
		if ($this->client === null) {
			$this->connect();
			return false;
		}
		$this->tryLogin($this->client);
		return true;
	}

	public function connect() : void {
		$client = new TrackerClient($this->hostname, ['credentials' => ChannelCredentials::createInsecure()]);
		if ($client->waitForReady($this->timeoutSec * 1000000)) {
			[$response, $status] = $this->tryLogin($client);
			$this->checkStatus($status);
			if ($response === null) {
				$client->close();
				return;
			}
			if ($response instanceof LoginResponse && $response->getStatus() === LoginStatusCode::SUCCESS) {
				$this->client = $client;
			}
		} else {
			$this->client = null;
		}
	}

	private function tryLogin(TrackerClient $client) : array {
		return $client->Login((new LoginRequest())
			->setNodeId($this->nodeId)
			->setType($this->type)
			->setInfo($this->obtainNodeInfo()))
			->wait();
	}

	private function obtainNodeInfo() : NodeInfo {
		return $this->collector->getNodeInfo();
	}

	private function checkStatus(stdClass $status) : void {
		if ($status->code !== STATUS_OK) {
			$this->connect();
		}
	}

	public function close() : void {
		if ($this->client !== null) {
			$this->client->close();
		}
	}

	public function publish(string $topic, string $data) : void {
		if (!$this->checkConnection()) {
			return;
		}
		[$empty, $status] = $this->client->Broadcast((new BroadcastMessage())
			->setNodeId($this->nodeId)
			->setTopic($topic)
			->setData($data)
		)->wait();
		$this->checkStatus($status);
	}

	public function select(string $type) : ?string {
		if (!$this->checkConnection()) {
			return null;
		}
		[$response, $status] = $this->client->Select((new SelectServerRequest())
			->setNodeId($this->nodeId)
			->setRequestedYpe($type)
		)->wait();
		$this->checkStatus($status);
		if ($response instanceof SelectServerResponse) {
			if ($response->hasTargetNodeId()) {
				return $response->getTargetNodeId();
			}
			return null;
		}
		return null;
	}

	public function subscribe(string $topic, \Closure $handler) : void {
		$this->bus->subscribe($topic, $handler);
	}

	/**
	 * @return NodeInfo[]
	 */
	public function getAllNodeInfo() : array {
		if (!$this->checkConnection()) {
			return [];
		}
		[$response, $status] = $this->client->GetAllNodeInfo(new GPBEmpty())->wait();
		$this->checkStatus($status);
		if ($response instanceof NodeInfoResponse) {
			$ret = [];
			foreach ($response->getInfo() as $key => $val) {
				assert($val instanceof NodeInfo);
				$ret[$key] = $val;
			}
			return $ret;
		}
		return [];
	}
}