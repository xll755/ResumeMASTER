<?php
// TODO: error handling, specifically in regards to the db
//
//
require_once __DIR__ . '/../../../app/vendor/autoload.php';

class Resume implements DB_functions
{
	protected int $id; // or private?
	public int $userId;
	public string $name;
	public string $contents;

	public function setID(int $id):void { $this->id = $id; } // for testing & creation only rn  TODO: repair
	public function getID():int { return $this->id; } // for testing & creation only rn  TODO: repair
	public function get_contents():string { return $this->contents; }
	public function print():void { echo $this->contents; } // for testing & creation only rn  TODO: repair

	/**
	 * Create a db entry for the current resume obj
	 *
	* TODO: desc
	*
	* @param mysqli $mysqli db object
	* @return void
	 */
	public function create(mysqli $mysqli): int
	{
		$query = "insert into resumes(userId, name) values (?,?)";
		$stmt = $mysqli->prepare($query);
		$userId = $this->userId;
		$name = $this->name;
		// TODO: insert pdf blob
		$types = "ss";
		$stmt->bind_param($types, $userId, $name);
		$stmt->execute();
	}

	/**
	* Delete the resume who's resume obj this is from db
	*
	* TODO: desc
	*
	* @param mysqli $mysqli db object
	* @return void
	*/
	public function delete(mysqli $mysqli): void
	{
		$query = "delete from resumes where resumes.id = (?)";
		$stmt = $mysqli->prepare($query);
		$id = this->id;
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
		// TODO: fetch pdf blob and/or other fields
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
		$query = "update resmues(userId, name) set (?,?) where resumes.id = (?)";
		$stmt = $mysqli->prepare($query);
		$id = $this->id;
		$userId = $this->userId;
		$name = $this->name;
		$types = "ssi";
		$stmt->bind_param($types, $userId, $name, $id);
		$stmt->execute();
	}

	public function import(string $path): void
	{
		$parser = new \Smalot\PdfParser\Parser();
		$pdf = $parser->parseFile($path);
		$text = $pdf->getText();
		$this->contents = $text;
	}
}
?>
