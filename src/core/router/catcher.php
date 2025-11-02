<?php
class Catcher {
	private static function code(int $code, bool $msg = true): never {
		http_response_code($code);
		if ($msg) { render("status/$code"); }
		exit;
	}

	public static function not_modified(): never { self::code(304, false); }
	public static function not_found(): never { self::code(404); }
	public static function internal_error(): never { self::code(500); }
}
