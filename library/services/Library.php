<?php declare(strict_types=1);

namespace library\services;

class Library {


	private Storage $storage;

	private \library\domain\Library $library;

	public function __construct(Storage $s) {
		$this->storage = $s;
		$this->library = new \library\domain\Library([]);
	}

	public function load() {
		try {
			$books = $this->storage->load();
		} catch (Exception $e) {
			if ($e->getCode() === ExcCodeFileNotFound) {
				$books = [];
			} else {
				throw $e;
			}
		}

		foreach ($books as $b) {
			$this->library->add($b);
		}
	}

	public function add(string $title, string $author) {
		$this->library->add(new \library\domain\Book($title, $author));
	}

	public function save() {
		$this->library->books(fn($books) => $this->storage->save($books));
	}

	public function search(string $q): array {
		return $this->library->search($q);
	}

}
