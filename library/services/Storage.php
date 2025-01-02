<?php declare(strict_types=1);

namespace library\services;

interface Storage {

	public function load(): array;

	public function save(array $books);

}
