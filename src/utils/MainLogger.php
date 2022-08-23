<?php

namespace Blackjack200\ProtocolLib\utils;

use Throwable;

class MainLogger implements \Logger {
	public function __construct(private bool $logDebug = true) { }

	public function emergency($message) : void {
		$this->log(\LogLevel::EMERGENCY, $message);
	}

	public function log($level, $message) : void {
		if ($level === \LogLevel::DEBUG && !$this->logDebug) {
			return;
		}
		echo sprintf("[%s/%s]: %s\n", (new \DateTime())->format("H:i:s:v"), $level, $message);
	}

	public function alert($message) : void {
		$this->log(\LogLevel::ALERT, $message);

	}

	public function critical($message) : void {
		$this->log(\LogLevel::CRITICAL, $message);
	}

	public function error($message) : void {
		$this->log(\LogLevel::ERROR, $message);

	}

	public function warning($message) : void {
		$this->log(\LogLevel::WARNING, $message);
	}

	public function notice($message) : void {
		$this->log(\LogLevel::NOTICE, $message);
	}

	public function info($message) : void {
		$this->log(\LogLevel::INFO, $message);
	}

	public function debug($message) : void {
		$this->log(\LogLevel::DEBUG, $message);
	}

	public function logException(Throwable $e, $trace = null) : void {
		$this->log(\LogLevel::EMERGENCY, $message);
	}
}