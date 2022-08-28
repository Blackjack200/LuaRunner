<?php

namespace blackjack200;

use blackjack200\lua\EvaluateRequest;
use blackjack200\lua\EvaluateResponse;
use blackjack200\lua\EvaluatorClient;
use Grpc\ChannelCredentials;

class Lua {
	private array $vars = [];
	private array $func = [];

	public function __construct() {

	}

	public function assign(string $name, float|bool|int|string $val) : void {
		$this->vars[$name] = json_encode($val);
	}

	public function evalFile(string $file) : LuaResult {
		return $this->eval(file_get_contents($file));
	}

	public function eval(string $code) : LuaResult {
		$client = new EvaluatorClient("127.0.0.1:6666", ['credentials' => ChannelCredentials::createInsecure()]);
		[$resp, $status] = $client->Eval((new EvaluateRequest())
			->setCode($code)
			->setFunctions([])
			->setHostname("")
			->setVariables($this->vars)
		)->wait();
		if ($resp instanceof EvaluateResponse) {
			return new LuaResult(
				$resp->getStdout(),
				$resp->getStderr(),
				$resp->getError()
			);
		}
		throw new \RuntimeException();
	}

}