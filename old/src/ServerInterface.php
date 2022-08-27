<?php

namespace Blackjack200\ProtocolLib;

interface ServerInterface {
	public function select(string $type) : ?string;
}