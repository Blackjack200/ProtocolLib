<?php

namespace Blackjack200\ProtocolLib\utils;

use InvalidArgumentException;
use Socket;

class InetAddress {
	private string $ip;
	private int $port;
	private int $version;

	public function __construct(string $address, int $port, int $version) {
		$this->ip = $address;
		if ($port < 0 || $port > 65535) {
			throw new InvalidArgumentException("Invalid port range");
		}
		$this->port = $port;
		$this->version = $version;
	}

	public static function fromSocket(Socket $socket) : self {
		socket_getpeername($socket, $addr, $port);
		return new self($addr, $port, filter_var($addr, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ? 4 : 6);
	}

	public function getIP() : string {
		return $this->ip;
	}

	public function getPort() : int {
		return $this->port;
	}

	public function getVersion() : int {
		return $this->version;
	}

	public function toString() : string {
		return $this->__toString();
	}

	public function __toString() {
		return $this->ip . " " . $this->port;
	}

	public function equals(InetAddress $address) : bool {
		return $this->ip === $address->ip and $this->port === $address->port and $this->version === $address->version;
	}
}