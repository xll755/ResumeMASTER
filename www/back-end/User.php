<?php
class User implements  dbfuncs
{
	private int $id;
	private string $userName;
	private string $firstName;
	private string $lastName;
	private string $email;
	private string $passwd;

	public function getID():int { return $this->id; }
	public function setUserName(string $str): void { $this->userName = $str; }
	public function getUserName(): string { return $this->userName; }
	public function setFirstName(string $str): void { $this->firstName = $str; }
	public function getFirstName(): string { return $this->firstName; }
	public function setLastName(string $str): void { $this->lastName = $str; }
	public function getLastName(): string { return $this->lastName; }
	public function setEmail(string $str): void { $this->email = $str; }
	public function getEmail(): string { return $this->email; }
	public function setPW(string $str):void { $this->passwd = password_hash($str, PASSWORD_DEFAULT); }
	public function getPW():string { return $this->passwd; }

	/**
	* INSERT the $this User object's data into the DB.
	*
	* Create a db entry for the $this User obj.
	* For use when adding a non-existing User to the DB.
	*
	* @param mysqli $mysqli db object
	 * @param array  $args a list of args
	* @return int $id created user's id
	 */
	public function create(mysqli $mysqli, ...$args): int
	{
		$query = "insert users(userName, firstName, lastName, email, passwd) values (?,?,?,?,?)";
		$stmt = $mysqli->prepare($query);
		$this->userName = $args[0];
		$this->firstName = $args[1];
		$this->lastName = $args[2];
		$this->email = $args[3];
		$this->setPW($args[4]);
		$types = "sssss";
		$stmt->bind_param($types, $this->userName, $this->firstName, $this->lastName, $this->email, $this->passwd);
		$stmt->execute();

		$id = $this->exists($mysqli);
		if ($id) {
			$this->id = $id;
			return $id;
		} else {
			throw new Exception("USER NOT ADDED TO DB", 1);
		}
	}

	/**
	* DELETE the $this User object's data from the DB.
	*
	* Remove the db entry for $this User obj.
	* For use when removing an existing User from the DB.
	*
	* @param mysqli $mysqli db object
	* @param int $id of User to delete
	* @return void
	*/
	public function delete(mysqli $mysqli, int $id): void
	{
		$query = "delete from users where users.id = (?)";
		$stmt = $mysqli->prepare($query);
		$types = "i";
		$stmt->bind_param($types, $id);
		$stmt->execute();
	}

	/**
	* PULL all information for a user from DB into $this User obj.
	*
	* Get all of an existing user's DB fields and place them in $this obj.
	* For use when loading a User obj to work with locally.
	*
	* @param mysqli $mysqli db object
	* @param int $id id of user to pull
	* @return void
	*/
	public function pull(mysqli $mysqli, int $id): void
	{
		$query = "select * from users where users.id = (?)";
		$stmt = $mysqli->prepare($query);
		$types = "i";
		$stmt->bind_param($types, $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		if ($row['id'] == null) {
			print("no user in db with that id");
			return;
		}
		$this->id = $row['id'];
		$this->userName = $row['userName'];
		$this->firstName = $row['firstName'];
		$this->lastName = $row['lastName'];
		$this->email = $row['email'];
		$this->passwd = $row['passwd'];
	}

	/**
	* PUSH all information for a User from $this User obj to DB.
	*
	* Update $this User's DB entry with the current state of $this User obj.
	* For use after manipulating a User's data locally.
	*
	* @param mysqli $mysqli db object
	* @return void
	*/
	public function push(mysqli $mysqli): void
	{
		$query = "update users set userName=(?), firstName=(?), lastName=(?), email=(?), passwd=(?) where users.id = (?)";
		$stmt = $mysqli->prepare($query);
		$id = $this->id;
		$userName = $this->userName;
		$firstName = $this->firstName;
		$lastName = $this->lastName;
		$email = $this->email;
		$passwd = $this->passwd;
		$types = "sssssi";
		$stmt->bind_param($types, $userName, $firstName, $lastName, $email, $passwd, $id);
		$stmt->execute();
	}

	/**
	* Confirm the existence of a User in the DB
	*
	* Uses the User obj's userName to query DB to check if an id exists for the
	* provided username.
	*
	* @param mysqli $mysqli db oject
	* @return bool false if user.id not found
	* @return int $id if user.id found
	*/
	public function exists(mysqli $mysqli): bool|int
	{
		$query = "select id from users where users.userName = (?);";
		$stmt = $mysqli->prepare($query);
		$userName = $this->userName;
		$types = "s";
		$stmt->bind_param($types, $userName);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		if ($row == null) {
			return false;
		} else {
			return $row['id'];
		}
	}

	/**
	* Confirms the correctness of a provided User's passwd
	*
	* Uses the User obj's userName to query the DB to check if the provided
	* passwd matches the passwd for $this User in the DB.
	*
	* @param mysqli $mysqli db object
	* @return bool true if passwds match, false otherwise.
	*/
	public function confirmPW(mysqli $mysqli, string $passwd): bool
	{
		$query = "select passwd from users where users.userName = (?);";
		$stmt = $mysqli->prepare($query);
		$userName = $this->userName;
		$types = "s";
		$stmt->bind_param($types, $userName);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		return password_verify($passwd, $row['passwd']);
	}
}
?>
