<?php
class Database {
	private static ?self $instance = null;

	public static function get(): self { return (self::$instance = self::$instance ?? new self()); }

	public static function run_migrations() {
		$db = self::get();
		$db->query('CREATE TABLE IF NOT EXISTS ' . MIGRATIONS_TABLE . '(
			idx INTEGER PRIMARY KEY
		) WITHOUT ROWID;');
		$last = $db->query('SELECT MAX(idx) FROM ' . MIGRATIONS_TABLE)[0]['MAX(idx)'] ?? null;
		$last = $last? intval($last) : 0;

		foreach (range($last, 9999) as $idx) {
			$base = str_pad("$idx", 4, "0", STR_PAD_LEFT);
			$file = MIGRATIONS_DIR . "/$base.sql";

			if (!is_readable($file)) { break; }
			$data = file_get_contents($file);
			foreach (explode(';', $data) as $stmt) {
				$stmt = trim($stmt);
				if (empty($stmt)) { continue; }
				$db->query("$stmt;");
			}
			$db->query('INSERT INTO ' . MIGRATIONS_TABLE . ' VALUES (?)', [$idx]);
		}
	}

	private function __construct(
		private SQLite3 $conn = new SQLite3(DATABASE_URL),
	) {}
	public function __destruct() { $this->conn->close(); }

	public function query(string $stmt, array $args = []): ?array {
		$query = $this->conn->prepare($stmt);
		foreach ($args as $idx => $arg) {
			$type = match (gettype($arg)) {
				'NULL' => SQLITE3_NULL,
				'double' => SQLITE3_FLOAT,
				'integer' => SQLITE3_INTEGER,
				'string' => SQLITE3_TEXT,
				default => throw new Exception('Unhandled type: ' . gettype($arg)),
			};
			if (!$query->bindValue($idx + 1, $arg, $type)) { return null; }
		}
		$result = $query->execute();
		if ($result === false) { return null; }
		if (!str_starts_with($stmt, 'SELECT')) { return []; }
		$rows = [];
		while ($row = $result->fetchArray(SQLITE3_ASSOC)) { array_push($rows, $row); }
		return $rows;
	}
}

Database::run_migrations();
