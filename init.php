<?php
declare(strict_types = 1);

const MIGRATIONS_TABLE = '__migrations';
const COMPONENTS_DIR = __DIR__ . '/parts';
const PAGES_DIR = __DIR__ . '/routes';
define('ASSETS_DIR', dirname(__DIR__) . '/assets');
define('DATABASE_URL', dirname(__DIR__) . '/db.sqlite');
define('MIGRATIONS_DIR', dirname(__DIR__) . '/migrations');

/*
 * Thanks, @user2226755!
 * Source: https://stackoverflow.com/questions/24783862/list-all-the-files-and-folders-in-a-directory-with-php-recursive-function
 */
function list_recursive(string $dir = __DIR__ . "/core"): array {
	$files = [];
	foreach (scandir($dir) as $name) {
		if ($name == '.' || $name == '..') { continue; }
		$path = "$dir/$name";
		if (is_dir($path)) {
			$files = array_merge($files, list_recursive($path, $files));
		} else {
			if (!str_ends_with($name, '.php')) { continue; }
			array_push($files, $path);
		}
	}

	return $files;
}

foreach (list_recursive() as $module) { require $module; }

Router::route();
