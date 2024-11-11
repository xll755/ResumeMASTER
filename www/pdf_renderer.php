<?php
class pdf_render
{
	use text2html;

	/*
	 * NOTE:
	 * Goal Usage:
	 * ```php
	 * $r = new pdf_render();
	 * $out = $r->render($resume)
	 * ```
	 * or
	 * ```php
	 * $out = call_user_func(['pdf_render', 'render'], $resume);
	 * ```
	*/

	// NOTE: maybe pass in an arr of section headers to use as args?
	public function render(Resume $r): string
	{
		// $get = new pdf_parser($r);
		// TODO: figure out how to get resume contents into arrays
		// can use the extraction methods, but those only pull whole chunks of
		// text
		// can also refactor the text2hmtl methods to take args other than arrs

		$render = "<style> h1, h2, h3, h4 { text-align: center; } </style>";
		$render .= "<html><body>";
		$personal_arr = array(
			"name" => "tester",
			"addr" => "1337 tester drive",
			"contact" => "tester@tester.com",
		);
		$render .= $this->personal_data(info: $personal_arr);
		$work_arr = array(
			"job_title" => "lead tester",
			"job_dates" => "5/2020-4/2021",
			"job_exper" => "Lead a team of dedicated product testers",
		);
		$render .= $this->work_expreience(exper_num: 1, work_exper: $work_arr);
		$edu_arr = array(
			"school" => "testing universtiy",
			"degree" => "masters of testing",
		);
		$render .= $this->edu_expereince(school_exper: $edu_arr);
		$additional_info = "i am also a professional wrestler & studio musician!";
		$render .= $this->additional_info($additional_info);

		$render .= "</body></html>";
		return $render;
	}
}
