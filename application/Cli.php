<?php declare(strict_types=1);

namespace application;

class Cli {

	public function __construct(
		private \application\ui\Menu $menu,
	){}

	public static function init(array $argv): Cli {
		$filename = $argv[1]?? 'library.json';
		$s = new \library\infrastructure\Storage($filename);
		$l = new \library\services\Library($s);
		$l->load();
		$m = new \ui\Menu();
		$m->input('add book', ['title:', 'author:'], fn($title, $author) => $l->add($title, $author));
		$m->input('search', ['query:'], function($q) use($l) {
			$books = $l->search($q);

			return array_map(fn($b) => sprintf("%s %s", $b->title, $b->author), $books);
		});
		$m->action('save', fn() => $l->save());

		return new Cli($m);
	}

	public function run() {
		$this->menu->run();
	}

}
