<?php

namespace prokits\impl;

use prokits\protocol\NodeInfo;

interface DataCollectorInterface {
	public function getNodeInfo() : NodeInfo;
}