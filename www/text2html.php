<?php
trait text2html
{
	/*
	* @param array $info k/v array containing name, addr, & contact info
	*/
	private function personal_data(string $header, array $info): string
	{
		$data = "<p style=\"text-align: center;\">" . $info["name"] . "</p>";
		$data .= "<p style=\"text-align: center;\">" . $info["location"] . "</p>";
		$data .= "<p style=\"text-align: center;\">" . $info["contact"] . "</p>";
		$data .= "<h3>" . $header . "</h3>";
		$data .= "<p style=\"text-align: center;\">" . $info["obj"] . "</p>";

		return $data;
	}

	/*
	* @param array $work_exper k/v array containing job title, job dates, &
	* experience
	*/
	private function work_expreience(string $header, array $work_exper): string
	{
		$data = "<h2>" . $header . "</h2>";
		foreach ($work_exper as $job) {
			$data .= "<div><table width=\"100%\"><tr>";
			$data .= "<td align=\"left\"><b>" . $job["job_title"] . "</b></td>";
			$data .= "<td align=\"right\"><b>" . $job["job_dates"] . "</b></td>";
			$data .= "</tr></table>";
			$data .= "<p>" . $job["job_exper"] . "</p>";
			$data .= "<hr></div>";
		}

		return $data;
	}

	/*
	* @param string $school_exper
	*/
	private function edu_expereince(string $header, string $school_exper): string
	{
		$data = "<h2>" . $header . "</h2><div>";
			$data .= "<p>" . $school_exper . "</p>";
		$data .= "<hr></div>";

		return $data;
	}
	// TODO: decide on "flow" ( single arg or array? )
	// above or below?
	//
	// /*
	// * @param array $school_exper k/v array containg school & degree
	// */
	// private function edu_expereince(array $school_exper): string
	// {
	// 	$data = "<h2>Eduction</h2><div>";
	// 	$data .= "<table width=\"100%\"><tr><td align=\"left\">";
	// 	$data .= "<b>" . $school_exper["eduction"] . "</b></td></tr></table>";
	// 	$data .= "<p align=\"left\">". $school_exper["degree"] . "</p>";
	// 	$data .= "<hr></div>";
	//
	// 	return $data;
	// }

	/*
	* @param string $info additional info
	*/
	private function additional_info(string $header, string $info): string
	{
		$data = "<h3>" . $header . "</h3>";
		$data .= "<div><p align=\"left\">" . $info . "</p></div>";

		return $data;
	}
}
