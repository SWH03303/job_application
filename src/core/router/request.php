<?php
class Request {
	public static function path(): string {
		$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '';
		$path = trim($path, '/');
		return preg_replace(':/+:', '/', $path);
	}
	public static function method(): string { return $_SERVER['REQUEST_METHOD']; }
	public static function is_post(): bool { return self::method() == 'POST'; }

	public static function header(string $key): ?string { return $_SERVER["HTTP_$key"] ?? null; }

	public static function param(string $key, bool $trim = true, bool $html = false): ?string {
		$dict = is_post()? $_POST : $_GET;
		$val = $dict[$key] ?? null;
		if (is_null($val)) { return $val; }
		$val = $trim? trim($val) : $val;
		$val = $html? html_sanitize($val) : $val;
		return $val;
	}
}
