<?php

namespace Blackjack200\ProtocolLib\utils;

use Blackjack200\ProtocolLib\protocol\Message;
use Closure;
use RuntimeException;
use Socket;

class TcpClientSocket {
	private BufferedWriter $writer;
	private InetAddress $addr;

	public function __construct(Socket $socket, Closure $onDisconnected) {
		$this->writer = new BufferedWriter($socket, $onDisconnected);
		$this->addr = InetAddress::fromSocket($socket);
	}

	public static function connect(InetAddress $addr, Closure $onDisconnected) : self {
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);
		socket_set_block($socket);
		if ($socket === false) {
			throw new RuntimeException("Failed to create socket fd");
		}
		$attempts = 32;
		while (!@socket_connect($socket, $addr->getIP(), $addr->getPort()) && $attempts-- > 0) {
			$error = socket_last_error();
			if ($error === SOCKET_EALREADY) {
				break;
			}
		}
		return new self($socket, $onDisconnected);
	}

	public function getAddr() : InetAddress { return $this->addr; }

	public function getWriter() : BufferedWriter { return $this->writer; }

	public function isClosed() : bool { return $this->writer->isClosed(); }

	public function close() : void { $this->writer->close(); }

	public function read() : ?Message { return $this->writer->read(); }

	public function write(Message $msg) : bool { return $this->writer->write($msg); }
}