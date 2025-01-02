<?php declare(strict_types=1);

namespace appliction\ui;

class Action {

	public function __construct(
		public string $title,
		public \Closure $impl,
	){}

	public function __invoke() {
		($this->impl)();
	}

}
