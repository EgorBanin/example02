<?php declare(strict_types=1);

namespace library\services;

const ExcCodeFileNotFound = 1;
const ExcCodeWrongFileFormat = 2;

class Exception extends \Exception {

	public static function FileNotFound(string $filename): Exception {
		return new Exception(sprintf('file %s not found', $filename), ExcCodeFileNotFound);
	}

	public static function WrongDataFormat(string $filename, $e) {
		return new Exception(sprintf('wrong file format %s', $filename), ExcCodeWrongFileFormat, $e);
	}

}
