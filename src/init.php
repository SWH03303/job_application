<?php
declare(strict_types = 1);

const DEFAULT_ROUTE = 'root';
const MIGRATIONS_TABLE = '__migrations';
const COMPONENTS_DIR = __DIR__ . '/parts';
define('DATABASE_URL', dirname(__DIR__) . '/db.sqlite');
define('MIGRATIONS_DIR', dirname(__DIR__) . '/migrations');

foreach (['database', 'render', 'router', 'session', 'utils'] as $module) {
	require __DIR__ . "/core/$module.php";
}
