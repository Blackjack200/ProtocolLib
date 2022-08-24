<?php

namespace Blackjack200\ProtocolLib\server;

use Blackjack200\ProtocolLib\protocol\Messages;
use Blackjack200\ProtocolLib\ServerInterface;
use Blackjack200\ProtocolLib\utils\BufferedWriter;
use Blackjack200\ProtocolLib\utils\InetAddress;
use Blackjack200\ProtocolLib\utils\TcpClientSocket;
use Blackjack200\ProtocolLib\utils\TcpServerSocket;
use Logger;

class TcpServer implements ServerInterface {
	private Logger $logger;
	private TcpServerSocket $socket;
	/** @var array<string,ClientSession> */
	private array $sessions = [];
	/** @var TcpClientSocket[] */
	private array $incoming = [];
	/** @var float[] */
	private array $incomingTime = [];
	private InetAddress $addr;

	public function __construct(InetAddress $addr, Logger $logger) {
		$this->socket = new TcpServerSocket($addr);
		$this->addr = $addr;
		$this->logger = $logger;
	}

	public function getAddr() : InetAddress { return $this->addr; }

	public function getLogger() : Logger { return $this->logger; }

	public function listen() : void {
		$this->acceptIncomingConnection();
		$this->handleIncomingMessages();
		$this->closeInvalidConnection();
		$this->handleSession();
	}

	private function acceptIncomingConnection() : void {
		while (($clientSocket = $this->socket->accept(static fn($close) => $close())) !== null) {
			$this->incoming[spl_object_hash($clientSocket)] = $clientSocket;
			$this->incomingTime[spl_object_hash($clientSocket)] = microtime(true);
		}
	}

	private function handleIncomingMessages() : void {
		foreach (BufferedWriter::selectRead(...$this->incoming) as $clientSocket) {
			$msg = $clientSocket->read();
			if ($msg !== null && $msg->getType() === Messages::LOGIN_REQUEST) {
				unset($this->incoming[spl_object_hash($clientSocket)], $this->incomingTime[spl_object_hash($clientSocket)]);
				[$nodeId, $type] = $msg->get();
				$session = new ClientSession($clientSocket, $nodeId, $type);
				if (isset($this->sessions[$nodeId])) {
					$session->write(Messages::loginResponse(Messages::LOGIN_STATUS_FAILED));
					//$clientSocket->close();
				} else {
					$this->sessions[$nodeId] = $session;
					$session->write(Messages::loginResponse(Messages::LOGIN_STATUS_SUCCESS));
					$this->logger->info("[+] connected(" . $clientSocket->getAddr()->toString() . ") nodeId=$nodeId type=$type");
				}
			}
		}
	}

	private function closeInvalidConnection() : void {
		foreach ($this->incoming as $hash => $socket) {
			$time = microtime(true) - $this->incomingTime[$hash];
			if ($time > 20 || $socket->isClosed()) {
				$socket->close();
				unset($this->incoming[$hash], $this->incomingTime[$hash]);
			}
		}
	}

	private function handleSession() : void {
		foreach ($this->sessions as $id => $session) {
			if ($session->isExpired()) {
				$session->close();
				unset($this->sessions[$id]);
				$this->logger->info("[-] disconnected nodeId={$session->getNodeId()} type={$session->getType()}");
				continue;
			}
			$msg = $session->read();
			if ($msg !== null) {
				switch ($msg->getType()) {
					case Messages::CLIENT_HEARTBEAT:
						[$nodeId, $canJoin, $onlinePlayers] = $msg->get();
						$session->heartbeat($canJoin, $onlinePlayers);
						$this->logger->debug("[*] heartbeat nodeId={$session->getNodeId()} canJoin=$canJoin online=" . implode(",", $onlinePlayers));
						break;
					case Messages::SELECT_SERVER_REQUEST:
						[$type] = $msg->get();
						$session->write(Messages::selectServerResponse($type, $this->select($type)));
						$this->logger->debug("[*] select request nodeId={$session->getNodeId()} type=$type");
						break;
					case Messages::BROADCAST:
						foreach ($this->sessions as $s) {
							if ($s !== $session) {
								$s->write($msg);
							}
						}
						break;
				}
			}
		}
	}

	public function select(string $type) : ?string {
		foreach ($this->sessions as $session) {
			if ($session->getType() === $type && $session->isCanJoin()) {
				return $session->getNodeId();
			}
		}
		return null;
	}

	public function shutdown() : void {
		$this->socket->close();
	}
}