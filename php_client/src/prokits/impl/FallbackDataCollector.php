<?php

namespace prokits\impl;

use prokits\protocol\NodeInfo;

class FallbackDataCollector implements DataCollectorInterface {
	public function getNodeInfo() : NodeInfo {
		return new NodeInfo();
	}
}