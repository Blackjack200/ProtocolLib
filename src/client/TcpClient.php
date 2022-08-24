<?php

namespace Blackjack200\ProtocolLib\client;

use Blackjack200\ProtocolLib\ClientInterface;
use Blackjack200\ProtocolLib\protocol\Messages;
use Blackjack200\ProtocolLib\utils\InetAddress;
use Blackjack200\ProtocolLib\utils\TcpClientSocket;
use Closure;

class TcpClient implements ClientInterface {
	protected TcpClientSocket $socket;
	private bool $open = false;
	private string $nodeId;
	private string $type;
	/** @var \Closure[] */
	private array $selectCallback = [];

	public function __construct(InetAddress $serverAddr, string $nodeId, string $type) {
		$this->type = $type;
		$this->nodeId = $nodeId;
		$this->socket = TcpClientSocket::connect($serverAddr, static fn($close) => $close());
		$this->login($this->nodeId, $this->type);
	}

	private function login(string $nodeId, string $type) : void {
		$this->socket->write(Messages::loginRequest($nodeId, $type));
	}

	public function getNodeId() : string { return $this->nodeId; }

	public function isDisconnected() : bool { return $this->socket->isClosed(); }

	public function close() : void { $this->socket->close(); }

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
				case 'LoginResponse':
					[$status] = $msg->get();
					if ($status === Messages::LOGIN_STATUS_SUCCESS) {
						$this->open = true;
					} else {
						$this->open = false;
					}
					break;
				case 'SelectServerResponse':
					[$type, $nodeId] = $msg->get();
					$calArr = $this->selectCallback[$type] ?? [];
					unset($this->selectCallback[$type]);
					foreach ($calArr as $f) {
						$f($nodeId);
					}
					break;
			}
		}
	}

	public function heartbeat(bool $canJoin, array $onlinePlayers) : void {
		$this->socket->write(Messages::heartbeat($this->nodeId, $canJoin, $onlinePlayers));
	}

	public function getType() : string { return $this->type; }

	/**
	 * @param \Closure(string):void $c
	 */
	public function select(string $type, Closure $c) : void {
		$this->socket->write(Messages::selectServerRequest($type));
		$this->selectCallback[$type][] = $c;
	}

	public function broadcast(string $topic, ...$param) : void {
		$this->socket->write(Messages::broadcast($topic, ...$param));
	}
}