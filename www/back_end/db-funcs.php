<?php
interface  DB_functions
{
	// we could make these return bool for p/f
	public function create(mysqli $mysqli, ...$args): int;
	public function delete(mysqli $mysqli, int $id): void;
	public function pull(mysqli $mysqli, int $id): void;
	public function push(mysqli $mysqli): void;
}
?>
