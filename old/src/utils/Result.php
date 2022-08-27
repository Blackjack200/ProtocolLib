<?php

namespace Blackjack200\ProtocolLib\utils;

use Closure;
use RuntimeException;

/**
 * @template ResultT
 */
class Result {
	/**
	 * @param ResultT $result
	 */
	public function __construct(private bool $ok, private mixed $result) { }

	/** @param \Closure(ResultT):void $closure */
	public function unwrap(Closure $closure) : void {
		if (!$this->ok) {
			throw new RuntimeException($this->result);
		}
		$closure($this->result);
	}

	/** @param \Closure(ResultT):void $closure */
	public function catch(Closure $closure) : void {
		if (!$this->ok) {
			$closure($this->result);
		}
	}
}