<?php declare(strict_types=1);

namespace library\domain;

class Library {

	public function __construct(
		private array $books,
	){}

	public function add(Book $b) {
		$this->books[] = $b;
	}

	public function search(string $q): array {
		$f = array_filter($this->books, function(Book $b) use($q) {
			if (strpos($b->title, $q) !== false) {
				return true;
			}

			if (strpos($b->author, $q) !== false) {
				return true;
			}

			return false;
		});

		return $f;
	}

	public function books(\Closure $c) {
		$c($this->books);
	}

}
