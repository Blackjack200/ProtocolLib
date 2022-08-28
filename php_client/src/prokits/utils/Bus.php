<?php

namespace prokits\utils;

use Closure;

class Bus {
	private array $handler;

	/**
	 * @param \Closure(...$data):void $handler
	 */
	public function subscribe(string $topic, Closure $handler) : void {
		$this->handler[$topic][] = $handler;
	}

	public function publish(string $topic, ...$param) : void {
		foreach ($this->handler[$topic] ?? [] as $handler) {
			$handler(...$param);
		}
	}
}