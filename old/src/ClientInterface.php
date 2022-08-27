<?php

namespace Blackjack200\ProtocolLib;

interface ClientInterface {
	public function heartbeat(bool $canJoin, array $onlinePlayers) : void;
}