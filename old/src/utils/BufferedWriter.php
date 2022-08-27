<?php

namespace Blackjack200\ProtocolLib\utils;

use Blackjack200\ProtocolLib\protocol\Message;
use Closure;
use RuntimeException;
use Socket;

class BufferedWriter {
	public const MSG_LEN = 512;
	private bool $closed = false;

	public function __construct(protected Socket $socket, protected Closure $onDisconnected) {
		socket_set_nonblock($socket);
	}

	/**
	 * @param TcpClientSocket ...$wrappers
	 * @return TcpClientSocket[]
	 */
	public static function selectRead(...$wrappers) : array {
		if (empty($wrappers)) {
			return [];
		}
		$sockets = [];
		$socketToWrapperMap = [];
		foreach ($wrappers as $wrapper) {
			$socketToWrapperMap[spl_object_hash($wrapper->getWriter()->socket)] = $wrapper;
			$sockets[] = $wrapper->getWriter()->socket;
		}
		socket_select($sockets, $_, $_, 1);
		$ret = [];
		foreach ($sockets as $ffs) {
			$ret[] = $socketToWrapperMap[spl_object_hash($ffs)];
		}
		return $ret;
	}

	public function write(Message $msg) : bool {
		$buf = $msg->serialize();
		if (strlen($buf) >= self::MSG_LEN) {
			throw new RuntimeException();
		}

		return $this->internalWrite($buf . str_repeat(" ", self::MSG_LEN - strlen($buf)));
	}

	protected function internalWrite(string $buf) : bool {
		if ($this->closed) {
			return false;
		}
		$result = @socket_write($this->socket, $buf);
		if ($result === false) {
			$err = socket_last_error($this->socket);
			if ($err === SOCKET_EPIPE || $err === SOCKET_ECONNRESET) {
				$this->callDisconnected();
				return false;
			}
		}
		return ($result === strlen($buf));
	}

	private function callDisconnected() : void {
		($this->onDisconnected)(fn() => $this->close());
	}

	public function close() : void {
		if (!$this->closed) {
			@socket_shutdown($this->socket);
			@socket_close($this->socket);
			$this->closed = true;
		}
	}

	public function read() : ?Message {
		if ($this->internalRead($buf, self::MSG_LEN)) {
			return Message::deserialize($buf);
		}
		return null;
	}

	protected function internalRead(&$buf, int $len) : bool {
		if ($this->closed) {
			return false;
		}
		$data = @socket_read($this->socket, $len);
		if ($data === false) {
			$err = socket_last_error($this->socket);
			if ($err === SOCKET_EPIPE || $err === SOCKET_ECONNRESET) {
				$this->callDisconnected();
				return false;
			}
			if ($err !== SOCKET_EAGAIN) {
				throw new RuntimeException(socket_strerror($err));
			}
			return false;
		}
		if ($data === '') {
			return false;
		}
		$buf = $data;
		return true;
	}

	public function isClosed() : bool {
		return $this->closed;
	}
}