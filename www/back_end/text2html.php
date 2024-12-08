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
		$data .= "<p style=\"text-align: left;\"><b>" . $header . ": </b>" . $info["obj"] . "</p>";
		// $data .= "<p style=\"text-align: left;\">" . $info["obj"] . "</p>";

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
			if ($job["job_title"] != null) {
				$data .= "<div><table width=\"100%\"><tr>";
				$data .= "<td align=\"left\"><b>" . $job["job_title"] . "</b></td>";
				$data .= "<td align=\"right\"><b>" . $job["job_dates"] . "</b></td>";
				$data .= "</tr></table>";
				$data .= "<p>" . nl2br($job["job_exper"]) . "</p>";
				$data .= "<hr></div>";
			}
		}

		return $data;
	}

	/*
	* @param string $school_exper
	*/
	private function edu_expereince(string $header, string $school_exper): string
	{
		$data = "<h2>" . $header . "</h2><div>";
		$data .= "<p>" . nl2br($school_exper) . "</p>";
		$data .= "</div>";

		return $data;
	}

	/*
	* @param string $info additional info
	*/
	private function additional_info(string $header, string $info): string
	{
		$data = '';
		if ($info != null) {
			$data = "<hr>";
			$data .= "<h3>" . $header . "</h3>";
			$data .= "<div><p align=\"left\">" . nl2br($info) . "</p></div>";
		}

		return $data;
	}
}
