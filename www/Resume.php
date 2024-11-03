<?php
// TODO: error handling, specifically in regards to the db
//
//
require_once __DIR__ . '/../../../app/vendor/autoload.php';

class Resume implements DB_functions
{
	private int $id;
	private int $userId;
	private string $name;
	private string $contents; // text contents of pdf
	private string $pdf_blob; // raw ( binary ) pdf

	public function setID(int $id):void { $this->id = $id; } // for testing & creation only rn  TODO: repair
	public function getID():int { return $this->id; } // for testing & creation only rn  TODO: repair
	public function get_contents():string { return $this->contents; }
	public function print():void { echo $this->contents; } // for testing & creation only rn  TODO: repair
	public function set_userId(int $id):void { $this->userId = $id; }
	public function set_name(string $name):void { $this->name = $name; }
	public function set_blob(string $blob):void { $this->pdf_blob = $blob; }

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
		$query = "insert into resumes(userId, name, pdf) values (?,?, ?)";
		$stmt = $mysqli->prepare($query);
		$userId = $this->userId;
		$name = $this->name;
		$pdf_blob = $this->pdf_blob;
		$types = "iss";
		$stmt->bind_param($types, $userId, $name, $pdf_blob);
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
		$this->pdf_blob = $row['pdf'];
		$this->convert_blob2text();
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
		$blob = $this->pdf_blob; // WARN: prob broken like pull?
		$types = "ssib";
		$stmt->bind_param($types, $userId, $name, $id, $blob);
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

	// NOTE: still necessary?? or maybe this over blobs???
	public function import(string $path): void
	{
		$parser = new \Smalot\PdfParser\Parser();
		$pdf = $parser->parseFile($path);
		$text = $pdf->getText();
		$this->contents = $text;
	}

	/*
	* Convert the DB returned PDF binary into a 'contents' string
	*
	* Private helper function to assist the pull() method.
	* Takes the 'pdf_blob' field and converts it to a 'contents' string.
	* This requires the intermediate step of creating a tmp PDF file on the
	* server as parseFile() takes filenames, not raw bin input
	* The tmp file is removed after use.
	*
	*/
	private function convert_blob2text(): void
	{
		$parser = new \Smalot\PdfParser\Parser();
		if ($this->pdf_blob === "") {
			echo 'EMPTY PDF [ convert_blob2text() ]'; // TODO: improve error handling
			exit();
		}

		// convert raw bin to tmp file
		$tmp_file = tempnam(sys_get_temp_dir(), 'pdf-');
		file_put_contents($tmp_file, $this->pdf_blob);

		// parse the tmp file's contents to text
		$pdf = $parser->parseFile($tmp_file);
		$text = $pdf->getText();
		$this->contents = $text;
		unlink($tmp_file); // remove tmp file from server
	}
}
?>
