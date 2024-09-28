<?php
// TODO: error handling, specifically in regards to the db
//
//
class User implements  DB_functions
{
	protected int $id; // or private?
	public string $userName;
	public string $firstName;
	public string $lastName;
	public string $email;
	protected string $passwd; // or private?

	public function setID(int $id):void { $this->id = $id; } // for testing & creation only rn  TODO: repair
	public function getID():int { return $this->id; } // for testing & creation only rn  TODO: repair
	public function setPW(string $pwd):void { $this->passwd = $pwd; } // for testing & creation only rn  TODO: repair

	/**
	 * Create a db entry for the current user obj
	 *
	* TODO: desc
	*
	* @param mysqli $mysqli db object
	* @return void
	 */
	public function create(mysqli $mysqli): void
	{
		$query = "insert users(userName, firstName, lastName, email, passwd) values (?,?,?,?,?)";
		$stmt = $mysqli->prepare($query);
		$userName = $this->userName;
		$fistName = $this->firstName;
		$lastName = $this->lastName;
		$email = $this->email;
		$passwd = $this->passwd;
		$types = "sssss";
		$stmt->bind_param($types, $userName, $fistName, $lastName, $email, $passwd);
		$stmt->execute();
	}

	/**
	* Delete the user who's user obj this is from db
	*
	* TODO: desc
	*
	* @param mysqli $mysqli db object
	* @return void
	*/
	public function delete(mysqli $mysqli): void
	{
		$query = "delete from users where users.id = (?)";
		$stmt = $mysqli->prepare($query);
		$id = $this->id;
		$types = "i";
		$stmt->bind_param($types, $id);
		$stmt->execute();
	}

	/**
	* Pull a user from db into a user object.
	*
	* TODO: desc
	*
	* @param mysqli $mysqli db object
	* @param int $id id of user to pull
	* @return void
	*/
	public function pull(mysqli $mysqli, int $id): void
	{
		$query = "select * from users where users.id = (?)";
		$stmt = $mysqli->prepare($query);
		$id = $id;
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
	* Push the current user obj into the db
	*
	* TODO: desc
	*
	* @param mysqli $mysqli db object
	* @return void
	*/
	public function push(mysqli $mysqli): void
	{
		$query = "update users(userName, firstName, lastName, email, passwd) set (?,?,?,?,?) where users.id = (?)";
		$stmt = $mysqli->prepare($query);
		$id = $this->id;
		$userName = $this->userName;
		$fistName = $this->firstName;
		$lastName = $this->lastName;
		$email = $this->email;
		$passwd = $this->passwd;
		$types = "sssssi";
		$stmt->bind_param($types, $userName, $fistName, $lastName, $email, $passwd, $id);
		$stmt->execute();
	}
}
?>
