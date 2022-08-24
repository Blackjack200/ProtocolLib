<?php

namespace Blackjack200\ProtocolLib\client;

use Blackjack200\ProtocolLib\ClientInterface;
use Blackjack200\ProtocolLib\protocol\Message;
use Blackjack200\ProtocolLib\protocol\Messages;
use Blackjack200\ProtocolLib\utils\InetAddress;
use Blackjack200\ProtocolLib\utils\TcpClientSocket;
use Closure;

class TcpClient implements ClientInterface {
	private TcpClientSocket $socket;
	private ?Closure $handleBroadcastFunc = null;
	private bool $open = false;
	private string $nodeId;
	private string $type;
	/** @var \Closure[] */
	private array $selectCallback = [];

	public function __construct(InetAddress $serverAddr, string $nodeId, string $type) {
		$this->type = $type;
		$this->nodeId = $nodeId;
		$this->socket = TcpClientSocket::connect($serverAddr, static fn($close) => $close());
	}

	public function login() : void {
		if (!$this->open) {
			$this->writeMessage(Messages::loginRequest($this->nodeId, $this->type));
		}
	}

	public function close() : void {
		$this->socket->close();
		$this->open = false;
	}

	public function getNodeId() : string { return $this->nodeId; }

	public function isDisconnected() : bool { return $this->socket->isClosed(); }

	public function isOpen() : bool { return $this->open; }

	public function tick(bool $canJoin, array $onlinePlayers) : void {
		if ($this->socket->isClosed()) {
			return;
		}
		if ($this->open) {
			$this->heartbeat($canJoin, $onlinePlayers);
		}
		$msg = $this->socket->read();
		if ($msg !== null) {
			switch ($msg->getType()) {
				case Messages::LOGIN_RESPONSE:
					[$status] = $msg->get();
					if ($status === Messages::LOGIN_STATUS_SUCCESS) {
						$this->open = true;
					} else {
						$this->open = false;
					}
					break;
				case Messages::SELECT_SERVER_RESPONSE:
					[$type, $nodeId] = $msg->get();
					$calArr = $this->selectCallback[$type] ?? [];
					unset($this->selectCallback[$type]);
					foreach ($calArr as $f) {
						$f($nodeId);
					}
					break;
				case Messages::BROADCAST:
					[$topic, $source, $data] = $msg->get();
					$this->handleBroadcast($topic, $source, $data);
					break;
			}
		}
	}

	public function setHandleBroadcastFunc(?Closure $handleBroadcastFunc) : void { $this->handleBroadcastFunc = $handleBroadcastFunc; }

	public function heartbeat(bool $canJoin, array $onlinePlayers) : void { $this->writeMessage(Messages::heartbeat($this->nodeId, $canJoin, $onlinePlayers)); }

	public function getType() : string { return $this->type; }

	/**
	 * @param \Closure(?string):void $c
	 */
	public function select(string $type, Closure $c) : void {
		$this->writeMessage(Messages::selectServerRequest($type));
		$this->selectCallback[$type][] = $c;
	}

	public function broadcast(string $topic, ...$param) : void { $this->writeMessage(Messages::broadcast($topic, $this->getNodeId(), ...$param)); }

	private function handleBroadcast(string $topic, string $source, array $data) : void {
		if ($this->handleBroadcastFunc !== null) {
			($this->handleBroadcastFunc)($topic, $source, $data);
		}
	}


	private function writeMessage(Message $msg) : void { $this->socket->write($msg); }
}