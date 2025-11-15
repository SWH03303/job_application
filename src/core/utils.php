<?php
function html_sanitize(string $data): string {
	return htmlspecialchars($data, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

class Range {
	public function __construct(public int $begin, public int $end) {}
	public function contains(int $x) { return $this->begin <= $x && $x <= $this->end; }
}
