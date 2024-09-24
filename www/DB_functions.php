<?php
interface  DB_functions
{
	// we could make these return bool for p/f
	public function create(mysqli $mysqli): void;
	public function delete(mysqli $mysqli): void;
	public function fetch(mysqli $mysqli, int $id): void; // return obj?
	public function insert(mysqli $mysqli, string $field): void;
	public function update(mysqli $mysqli, string $field): void;
}
?>
