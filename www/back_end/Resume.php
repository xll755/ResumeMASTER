<?php
// TODO: error handling, specifically in regards to the db

class Resume implements DB_functions
{
	private int $id;
	private int $userId;
	private string $name;
	private array $resume; // text contents of pdf

	// TODO: add enum to db & throughout appropriate funcs
	private ?resume_styes $style;

	public function getID(): int { return $this->id; }
	public function setID(int $id): void { $this->id = $id; }
	public function get_contents(): string { return $this->contents; }
	public function print(): void { var_dump($this->resume); } // WARN: remove
	public function set_userId(int $id): void { $this->userId = $id; }
	public function set_name(string $name): void { $this->name = $name; }
	public function set_resume(array $resume): void { $this->resume = $resume; }
	public function get_resume(): array { return $this->resume; }
	public function set_style(resume_styes $style): void { $this->style = $style; }
	public function get_style(): ?resume_styes { return $this->style; }

	/**
	 * Create a db entry for the current resume obj
	 *
	 * TODO: desc
	 *
	 * @param mysqli $mysqli db object
	 * @return resume_id
	 */
	public function create(mysqli $mysqli, ...$args): int
	{
		$query = "insert into resumes(userId, name, resume) values (?,?, ?)";
		$stmt = $mysqli->prepare($query);
		$this->userId = $args[0];
		$this->name = $args[1];
		$this->resume = $args[2];
		$json_resume = json_encode($this->resume, 512);
		$types = "iss";
		$stmt->bind_param($types, $this->userId, $this->name, $json_resume);
		$stmt->execute();

		$id = $this->exists($mysqli);
		if ($id) {
			return $id;
		} else {
			throw new Exception("RESUME NOT ADDED TO DB", 1);
		}
	}

	/**
	 * Delete the resume who's resume obj this is from db
	 *
	 * TODO: desc
	 *
	 * @param mysqli $mysqli db object
	 * @return void
	 */
	public function delete(mysqli $mysqli, int $id): void
	{
		$query = "delete from resumes where resumes.id = (?)";
		$stmt = $mysqli->prepare($query);
		$types = "i";
		$stmt->bind_param($types, $id);
		$stmt->execute();
	}

	/**
	 * Pull a resume from db into a resume object.
	 *
	 * TODO: desc
	 *
	 * @param mysqli $mysqli db object
	 * @param int $id id of resume to pull
	 * @return void
	 */
	public function pull(mysqli $mysqli, int $id): void
	{
		$query = "select * from resumes where resumes.id = (?)";
		$stmt = $mysqli->prepare($query);
		$id = $id;
		$types = "i";
		$stmt->bind_param($types, $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		if ($row['id'] == null) {
			print("no resume in db with that id");
			return;
		}
		$this->id = $row['id'];
		$this->userId = $row['userId'];
		$this->name = $row['name'];
		$this->resume = json_decode($row['resume'], true, 512);
	}

	/**
	 * Push the current resume obj into the db
	 *
	 * TODO: desc
	 *
	 * @param mysqli $mysqli db object
	 * @return void
	 */
	public function push(mysqli $mysqli): void
	{
		// $query = "update resumes(name, resume) set (?,?) where resumes.id = (?)";
		$query = "update resumes set name=(?), resume=(?) where resumes.id = (?)";
		$stmt = $mysqli->prepare($query);
		$id = $this->id;
		$name = $this->name;
		$json_resume = json_encode($this->resume, 512);
		$types = "ssi";
		$stmt->bind_param($types, $name, $json_resume, $id);
		$stmt->execute();
	}

	/**
	 * Confirm the existence of a Resume in the DB
	 * TODO: this is a terrible check for this class. REFINE
	 *
	 * Uses the Resume obj's name to query DB to check if an id exists for the
	 * provided name.
	 *
	 * @param mysqli $mysqli db oject
	 * @return bool false if resume.id not found
	 * @return int $id if resume.id found
	 */
	public function exists(mysqli $mysqli): bool|int
	{
		$query = "select id from resumes where resumes.name = (?);";
		$stmt = $mysqli->prepare($query);
		$name = $this->name;
		$types = "s";
		$stmt->bind_param($types, $name);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		if ($row == null) {
			return false;
		} else {
			return $row['id'];
		}
	}
}
