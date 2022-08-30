<?php

namespace prokits\impl;

interface DataCollectorInterface {
	public function collectTps() : float;

	public function collectAverageTps() : float;

	public function collectMaxOnlinePlayers() : int;

	public function collectOnlinePlayers() : array;

	public function collectInGamePlayers() : array;

	public function collectCanJoin() : bool;
}