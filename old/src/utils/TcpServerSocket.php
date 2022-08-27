<?php

namespace Blackjack200\ProtocolLib\utils;

use Closure;
use RuntimeException;
use Socket;

class TcpServerSocket {
	private Socket $socket;

	/**
	 * @throws \RuntimeException
	 */
	public function __construct(InetAddress $addr) {
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);
		if ($socket === false) {
			throw new RuntimeException("Failed to create socket fd");
		}
		if (!socket_bind($socket, $addr->getIP(), $addr->getPort())) {
			socket_close($socket);
			throw new RuntimeException("Failed to bind socket");
		}
		if (!socket_listen($socket)) {
			throw new RuntimeException("Failed to listen");
		}
		socket_set_nonblock($socket);
		$this->socket = $socket;
	}

	public function close() : void {
		@socket_shutdown($this->socket);
		@socket_close($this->socket);
	}

	public function accept(Closure $onDisconnected) : ?TcpClientSocket {
		$conn = socket_accept($this->socket);
		if ($conn !== false) {
			return new TcpClientSocket($conn, $onDisconnected);
		}
		return null;
	}
}