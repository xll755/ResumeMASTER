<?php
include 'check_login.php'; 
class pdf_parser
{

	private $resume_contents;

	/*
	 * @param Resume $resume resume object to parse
	 */
	public function __construct(Resume $resume)
	{
		if ($resume == null || $resume->get_contents() == null) {
			echo 'NOTHING TO WORK WITH';
			exit();
		}

		$this->resume_contents = $resume->get_contents();
	}

	/*
	 * Extract the contents from a PDF between two headers.
	 *
	 * Provides functionality to extract a section of text between two words,
	 * exclusively ( words not included ).
	 * Meant to extract a given section from a PDF doc's contents.
	 *
	 * @param string $start string demarking beginning of section to extract
	 * @param string $end string demarking end of section to extract
	 * @return string $section extracted section between above demarkers ||
	 * empty string on failure
	 */
	public function get_section_between(string $start, string $end): string
	{
		if ($this->resume_contents == null) {
			echo 'NO CONTENTS';
			exit();
		}

		$section = ' ' . $this->resume_contents;
		$init = strpos($section, $start);
		if ($init == 0) return '';
		$init += strlen($start);
		$len = strpos($section, $end, $init) - $init;

		return substr($section, $init, $len);
	}

	/*
	 * Extract the contents from a PDF before a header.
	 *
	 * Provides functionality to extract a section of text before a given word
	 * exclusively ( word not included ).
	 * Meant to extract from beginning of a PDF doc's contents to a given section.
	 *
	 * @param string $end string demarking end of section to extract
	 * @return string $section extracted section between the start of the file's
	 * contents and the above demarker || empty string on failure
	 */
	public function get_section_before(string $end): string
	{
		if ($this->resume_contents == null) {
			echo 'NO CONTENTS';
			exit();
		}

		$section = ' ' . $this->resume_contents;
		$pos = strpos($section, $end);
		if ($pos == false) return '';

		return substr($section, 0, $pos);
	}

	/*
	 * Extract the contents from a PDF after a header.
	 *
	 * Provides functionality to extract a section of text after a given word
	 * exclusively ( word not included ).
	 * Meant to extract from a given section to the end of the PDF doc's
	 * contents.
	 *
	 * @param string $start string demarking beginning of section to extract
	 * @return string $section extracted section between the provided string and
	 * the end of the PDF doc's contents || empty string on failure
	 */
	public function get_section_after(string $start): string
	{
		if ($this->resume_contents == null) {
			echo 'NO CONTENTS';
			exit();
		}

		$section = ' ' . $this->resume_contents;
		$pos = strpos($section, $start);
		if ($pos == false) return '';

		return substr($section, $pos + strlen($start));
	}
}
