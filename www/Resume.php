<?php
class Resume implements DB_functions
{
	protected int $id; // or private?
	public int $userId;
	public string $name;

	public function setID(int $id):void { $this->id = $id; } // for testing & creation only rn  TODO: repair

	public function create(mysqli $mysqli): void
	{
		$query = "insert into resumes(userId, name) values (?,?)";
		$stmt = $mysqli->prepare($query);
		$userId = $this->userId;
		$name = $this->name;
		$types = "ss";
		$stmt->bind_param($types, $userId, $name);
		$stmt->execute();
	}

	public function delete(mysqli $mysqli): void
	{
		$query = "delete from resumes where resumes.id = (?)";
		$stmt = $mysqli->prepare($query);
		$id = this->id;
		$types = "i";
		$stmt->bind_param($types, $id);
		$stmt->execute();
	}

	// NOTE: make static & return obj???
	public function fetch(mysqli $mysqli, int $id): void
	{
		$query = "select * from resumes where resumes.id = $id"; // WARN: best practice???
		$stmt = $mysqli->prepare($query);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		$this->id = $row['id'];
		$this->userId = $row['userId'];
		$this->name = $row['name'];
	}

	public function insert(mysqli $mysqli, string $field): void
	{
		$query = "insert into resumes(field) values (?) where resumes.id = (?)";
		$stmt = $mysqli->prepare($query);
		$field = $field; // necessary?
		$id = $this->id;
		$types = "si";
		$stmt->bind_param($types, $field, $id);
		$stmt->execute();
	}

	public function update(mysqli $mysqli, string $field): void
	{
		$query = "update resmues(field) set (?) where resumes.id = (?)";
		$stmt = $mysqli->prepare($query);
		$field = $field; // necessary?
		$id = $this->id;
		$types = "si";
		$stmt->bind_param($types, $field, $id);
		$stmt->execute();
	}

}
?>
