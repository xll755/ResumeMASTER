<?php
trait text2html
{
	/*
	* @param array $info k/v array containing name, addr, & contact info
	*/
	private function personal_data(array $info): string
	{
		$data = "<p style=\"text-align: center;\">" . $info["name"] . "</p>";
		$data .= "<p style=\"text-align: center;\">" . $info["addr"] . "</p>";
		$data .= "<p style=\"text-align: center;\">" . $info["contact"] . "</p>";

		return $data;
	}

	/*
	* @param array $work_exper k/v array containing job title, job dates, &
	* experience
	*/
	private function work_expreience(int $exper_num, array $work_exper): string
	{
		$data = "<h2>Work Experience</h2>";
		for ($i = 0; $i  < $exper_num; $i++) {
			$data .= "<div><table width=\"100%\"><tr>";
			$data .= "<td align=\"left\"><b>" . $work_exper["job_title"] . "</b></td>";
			$data .= "<td align=\"right\"><b>" . $work_exper["job_dates"] . "</b></td>";
			$data .= "</tr></table>";
			$data .= "<p>" . $work_exper["job_exper"] . "</p>";
			$data .= "<hr></div>";
		}

		return $data;
	}

	/*
	* @param array $school_exper k/v array containg school & degree
	*/
	private function edu_expereince(array $school_exper): string
	{
		$data = "<h2>Eduction</h2><div>";
		$data .= "<table width=\"100%\"><tr><td align=\"left\">";
		$data .= "<b>" . $school_exper["school"] . "</b></td></tr></table>";
		$data .= "<p align=\"left\">". $school_exper["degree"] . "</p>";
		$data .= "<hr></div>";

		return $data;
	}

	/*
	* @param string $info additional info
	*/
	private function additional_info(string $info): string
	{
		$data = "<h3>Additional Information</h3>";
		$data .= "<div><p align=\"left\">" . $info . "</p></div>";

		return $data;
	}
}
