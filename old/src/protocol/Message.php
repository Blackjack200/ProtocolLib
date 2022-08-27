<?php

namespace Blackjack200\ProtocolLib\protocol;

final class Message {
	private string $type;
	private mixed $val;

	private function __construct() { }

	public static function wrap(string $type, mixed $val) : self {
		$ret = new self();
		$ret->type = $type;
		$ret->val = $val;
		return $ret;
	}

	public static function deserialize(string $data) : self {
		$ret = new self();
		[$ret->type, $ret->val] = json_decode($data, true);
		return $ret;
	}

	public function serialize() : string {
		return json_encode([$this->type, $this->val]);
	}

	public function getType() : string { return $this->type; }

	public function get() : mixed { return $this->val; }
}