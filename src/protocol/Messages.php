<?php

namespace Blackjack200\ProtocolLib\protocol;

final class Messages {
	public const LOGIN_STATUS_SUCCESS = 0;
	public const LOGIN_STATUS_FAILED = 1;

	public static function loginRequest(string $nodeId, string $type) : Message {
		return Message::wrap('LoginRequest', [$nodeId, $type]);
	}

	public static function loginResponse(int $status) : Message {
		return Message::wrap('LoginResponse', [$status]);
	}

	public static function heartbeat(string $nodeId, bool $canJoin, array $onlinePlayers) : Message {
		return Message::wrap('ClientHeartbeat', [
			$nodeId,
			$canJoin,
			$onlinePlayers,
		]);
	}

	public static function selectServerRequest(string $type) : Message {
		return Message::wrap('SelectServerRequest', [
			$type,
		]);
	}

	public static function selectServerResponse(string $type, ?string $nodeId) : Message {
		return Message::wrap('SelectServerResponse', [
			$type,
			$nodeId,
		]);
	}

	public static function broadcast(string $topic, ...$param) : Message {
		return Message::wrap('Broadcast', [$topic, $param]);
	}
}