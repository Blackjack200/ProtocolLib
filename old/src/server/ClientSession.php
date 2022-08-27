<?php

namespace Blackjack200\ProtocolLib\server;

use Blackjack200\ProtocolLib\protocol\Message;
use Blackjack200\ProtocolLib\utils\TcpClientSocket;

class ClientSession {
	private float $lastActive;
	private string $nodeId;
	private string $type;
	private bool $canJoin = false;
	private array $onlinePlayers = [];
	private TcpClientSocket $socket;

	public function __construct(
		TcpClientSocket $socket,
		string          $nodeId,
		string          $type,
	) {
		$this->socket = $socket;
		$this->type = $type;
		$this->nodeId = $nodeId;
		$this->lastActive = microtime(true);
	}

	public function getType() : string { return $this->type; }

	public function getLastActive() : float { return $this->lastActive; }

	public function isCanJoin() : bool { return $this->canJoin; }

	public function getNodeId() : string { return $this->nodeId; }

	public function getOnlinePlayers() : array { return $this->onlinePlayers; }

	public function heartbeat(bool $canJoin, array $onlinePlayers) : void {
		$this->lastActive = microtime(true);
		$this->canJoin = $canJoin;
		$this->onlinePlayers = $onlinePlayers;
	}

	public function isExpired() : bool {
		return microtime(true) - $this->lastActive > 5;
	}

	public function close() : void {
		$this->socket->close();
	}

	public function write(Message $msg) : bool {
		return $this->socket->write($msg);
	}

	public function read() : ?Message {
		return $this->socket->read();
	}
}