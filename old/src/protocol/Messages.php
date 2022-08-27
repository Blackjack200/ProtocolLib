<?php

namespace Blackjack200\ProtocolLib\protocol;

final class Messages {
	public const LOGIN_STATUS_SUCCESS = 0;
	public const LOGIN_STATUS_FAILED = 1;

	public const CLIENT_HEARTBEAT = 'ClientHeartbeat';
	public const LOGIN_RESPONSE = 'LoginResponse';
	public const LOGIN_REQUEST = 'LoginRequest';
	public const SELECT_SERVER_REQUEST = 'SelectServerRequest';
	public const SELECT_SERVER_RESPONSE = 'SelectServerResponse';
	public const BROADCAST = 'Broadcast';
	public const INFO_REQUEST = 'InfoRequest';
	public const INFO_RESPONSE = 'InfoResponse';

	public static function loginRequest(string $nodeId, string $type) : Message {
		return Message::wrap(self::LOGIN_REQUEST, [$nodeId, $type]);
	}

	public static function loginResponse(int $status) : Message {
		return Message::wrap(self::LOGIN_RESPONSE, [$status]);
	}

	public static function heartbeat(string $nodeId, bool $canJoin, array $onlinePlayers) : Message {
		return Message::wrap(self::CLIENT_HEARTBEAT, [
			$nodeId,
			$canJoin,
			$onlinePlayers,
		]);
	}

	public static function selectServerRequest(string $type) : Message {
		return Message::wrap(self::SELECT_SERVER_REQUEST, [
			$type,
		]);
	}

	public static function selectServerResponse(string $type, ?string $nodeId) : Message {
		return Message::wrap(self::SELECT_SERVER_RESPONSE, [
			$type,
			$nodeId,
		]);
	}

	public static function broadcast(string $topic, string $source, ...$param) : Message {
		return Message::wrap(self::BROADCAST, [$topic, $source, $param]);
	}

	//TODO
	public static function infoRequest() : Message {
		return Message::wrap(self::INFO_REQUEST, null);
	}

	//TODO
	public static function infoResponse(array $data) : Message {
		return Message::wrap(self::INFO_RESPONSE, $data);
	}
}