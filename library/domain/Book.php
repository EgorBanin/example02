<?php declare(strict_types=1);

namespace library\domain;

class Book {

	public function __construct(
		public string $title,
		public string $author,
	){}

}
