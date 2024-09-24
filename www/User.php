<?php
class User
{
	protected int $id; // or private?
	public string $firstName;
	public string $lastName;
	public string $email;

	public function setID(int $id):void { $this->id = $id; } // for testing & creation only rn  TODO: repair
}
?>
