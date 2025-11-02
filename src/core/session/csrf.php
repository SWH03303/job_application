<?php
class Csrf {
	private const KEY = 'csrf_token';

	public static function new() { Session::set(self::KEY, bin2hex(random_bytes(32))); }
	public static function get(): ?string { Session::get(self::KEY); }
	public static function check(string $token): bool {
		if (is_null(self::get())) { return false; }
		return Session::pop(self::KEY) === $token;
	}
}
