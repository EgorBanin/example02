<?php declare(strict_types=1);

namespace library\infrastructure;

class Storage implements \library\services\Storage {

	public function __construct(
		private string $filename,
	){}

	public function load(): array {
		$c = file_get_contents($this->filename);
		if ($c === false) {
			throw \library\services\Exception::FileNotFound($this->filename);
		}

		try {
			$a = json_decode($c, true, JSON_THROW_ON_ERROR);
		} catch(\JsonException $e) {
			throw \library\services\Exception::WrongFileFormat($this->filename, $e);
		}

		return array_map(fn($i) => new \library\domain\Book($i['title'], $i['author']), $a);
	}

	public function save(array $books) {
		$j = json_encode($books, JSON_UNESCAPED_UNICODE);
		file_put_contents($this->filename, $j);
	}

}
