<?php
class User implements  DB_functions
{
	protected int $id; // or private?
	public string $firstName;
	public string $lastName;
	public string $email;

	public function setID(int $id):void { $this->id = $id; } // for testing & creation only rn  TODO: repair

	public function create(mysqli $mysqli):void
	{
		$query = "insert into users(firstName, lastName, email) values (?,?,?)";
		$stmt = $mysqli->prepare($query);
		$fistName = $this->firstName;
		$lastName = $this->lastName;
		$email = $this->email;
		$types = "sss";
		$stmt->bind_param($types, $fistName, $lastName, $email);
		$stmt->execute();
	}

	public function delete(mysqli $mysqli): void
	{
		$query = "delete from users where users.id = (?)";
		$stmt = $mysqli->prepare($query);
		$id = this->id;
		$types = "i";
		$stmt->bind_param($types, $id);
		$stmt->execute();
	}

	// NOTE: make static & return obj???
	public function fetch(mysqli $mysqli, int $id): void
	{
		$query = "select * from users where users.id = $id"; // WARN: best practice???
		$stmt = $mysqli->prepare($query);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		$this->id = $row['id'];
		$this->firstName = $row['firstName'];
		$this->lastName = $row['lastName'];
		$this->email = $row['email'];
	}

	public function insert(mysqli $mysqli, string $field): void
	{
		$query = "insert into users(field) values (?) where users.id = (?)";
		$stmt = $mysqli->prepare($query);
		$field = $field; // necessary?
		$id = $this->id;
		$types = "si";
		$stmt->bind_param($types, $field, $id);
		$stmt->execute();
	}

	public function update(mysqli $mysqli, string $field): void
	{
		$query = "update users(field) set (?) where users.id = (?)";
		$stmt = $mysqli->prepare($query);
		$field = $field; // necessary?
		$id = $this->id;
		$types = "si";
		$stmt->bind_param($types, $field, $id);
		$stmt->execute();
	}
}
?>
