<?php

namespace blackjack200;

class LuaResult implements \JsonSerializable {
	public function __construct(
		private string  $stdout,
		private string  $stderr,
		private ?string $error,
	) {
	}

	public function jsonSerialize() {
		return [
			'stdout' => $this->getStdout(),
			'stderr' => $this->getStderr(),
			'error' => $this->getError(),
		];
	}

	public function getStdout() : string { return $this->stdout; }

	public function getStderr() : string { return $this->stderr; }

	public function getError() : ?string { return $this->error; }
}