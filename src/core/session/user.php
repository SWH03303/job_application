<?php
class User {
	private const KEY = 'user';

	private function __construct (private string $name) {}

	public static function register(
		string $name,
		#[SensitiveParameter] string $pass,
		string $email,
	): bool {
		$db = Database::get();
		$hash = password_hash($pass, PASSWORD_DEFAULT);
		$query = 'INSERT INTO user(name, hash, email) VALUES (?, ?, ?)';
		$res = $db->query($query, [$name, $hash, $email]);
		return !is_null($res);
	}

	public function authenticate(#[SensitiveParameter] string $pass): bool {
		$db = Database::get();
		$row = $db->query('SELECT hash FROM user WHERE name = ?', [$this->name])[0] ?? [];
		$hash = $row['hash'] ?? null;
		if (is_null($hash)) { return false; }
		return password_verify($pass, $hash);
	}
	public static function login(string $name, #[SensitiveParameter] string $pass): ?self {
		$user = new self($name); // could be non-existent
		if (!$user->authenticate($pass)) { return null; }
		Session::force_new(); // remove userless session
		Session::set(self::KEY, $user->name);
		return $user;
	}
	public function logout() { Session::reset(); }

	// NOTE: Hidden method, use `Session::user` instead
	public static function _from_session(): ?self {
		$name = Session::get(self::KEY);
		return $name? new self($name) : null;
	}
}
