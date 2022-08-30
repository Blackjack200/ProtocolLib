<?php

namespace prokits\impl;

class FallbackDataCollector implements DataCollectorInterface {
	public function collectTps() : int { return 20; }

	public function collectAverageTps() : float { return 20; }

	public function collectMaxOnlinePlayers() : int { return 1; }

	public function collectOnlinePlayers() : array { return []; }

	public function collectInGamePlayers() : array { return []; }

	public function collectCanJoin() : bool { return true; }
}