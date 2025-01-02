<?php declare(strict_types=1);

namespace application\ui;

class Menu {

	private array $actions = [];

	public function action(string $title, \Closure $a) {
		$this->actions[] = new Action($title, $a);
	}

	public function input(string $title, array $requests, \Closure $a) {
		$this->actions[] = new Action($title, function() use($requests, $a) {
			$args = [];
			foreach ($requests as $r) {
				print("$r\n");
				$args[] = readline();
			}

			$r = $a(...$args);

			if (is_array($r)) {
				array_walk($r, fn($s) => print("$s\n"));
			}
		});
	}

	public function run() {
		do {
			print($this->display());
			$input = readline();
			if (!is_numeric($input)) {
				continue;
			}

			$num = (int)$input;
			if ($num > (count($this->actions)+1)) {
				continue;
			} elseif ($num === (count($this->actions)+1)) {
				break; // exit
			}

			print("\n");
			$this->actions[$num-1]();
			print("\n");
			
		} while (true);
	}

	private function display(): string {
		$s = '';
		foreach ($this->actions as $i => $a) {
			$s .= sprintf("%d: %s\n", $i+1, $a->title);
		}

		$s .= sprintf("%d: exit\n", count($this->actions)+1);

		return $s;
	}

}
