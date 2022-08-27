<?php

use Blackjack200\ProtocolLib\server\TcpServer;
use Blackjack200\ProtocolLib\utils\InetAddress;
use Blackjack200\ProtocolLib\utils\MainLogger;

require 'vendor/autoload.php';

final class SignalHandler {
	/** @phpstan-var (\Closure(int) : void)|null */
	private ?Closure $interruptCallback;

	/**
	 * @phpstan-param \Closure() : void $interruptCallback
	 */
	public function __construct(Closure $interruptCallback) {
		$this->interruptCallback = $interruptCallback;

		if (function_exists('sapi_windows_set_ctrl_handler')) {
			sapi_windows_set_ctrl_handler($this->interruptCallback = static function(int $signo) use ($interruptCallback) : void {
				if ($signo === PHP_WINDOWS_EVENT_CTRL_C || $signo === PHP_WINDOWS_EVENT_CTRL_BREAK) {
					$interruptCallback();
				}
			});
		} else if (function_exists('pcntl_signal')) {
			foreach ([
				         SIGTERM,
				         SIGINT,
				         SIGHUP,
			         ] as $signal) {
				pcntl_signal($signal, $this->interruptCallback = fn(int $signo) => $interruptCallback());
			}
			pcntl_async_signals(true);
		}
		//no supported signal handlers :(
	}

	public function unregister() : void {
		if (function_exists('sapi_windows_set_ctrl_handler')) {
			sapi_windows_set_ctrl_handler($this->interruptCallback, false);
		} else if (function_exists('pcntl_signal')) {
			foreach ([
				         SIGTERM,
				         SIGINT,
				         SIGHUP,
			         ] as $signal) {
				pcntl_signal($signal, SIG_DFL);
			}
		}
	}
}

function loadConfig() : array {
	if (!is_file('config.yml')) {
		yaml_emit_file('config.yml', [
			'addr' => '127.0.0.1',
			'port' => 8849,
		]);
	}
	return yaml_parse_file('config.yml');
}

$logger = new MainLogger(false);
$config = loadConfig();

$running = true;
$server = new TcpServer(InetAddress::auto($config['addr'], $config['port']), $logger);

$signalHandler = new SignalHandler(static function() use ($logger, &$running) : void {
	$logger->info('shutdown the server');
	$running = false;
});

$logger->info("started server on {$server->getAddr()->toString()}");

while ($running) {
	$server->listen();
	usleep(2500);
}

$server->shutdown();

$logger->info('shutdown the server gracefully');
