<?php

namespace prokits\impl;

interface DataCollectorInterface {
	public function collectTps() : int;

	public function collectAverageTps() : float;

	public function collectMaxOnlinePlayers() : int;

	public function collectOnlinePlayers() : array;

	public function collectCanJoin() : bool;
}