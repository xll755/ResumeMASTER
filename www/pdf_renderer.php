<?php
class pdf_render
{
	use text2html;
	private Resume $r;

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

	public function __construct(Resume $r)
	{
		$this->r = $r;
	}

	// NOTE: better to take in obj in constructor or in func???

	public function render(): string
	{
		return match($this->r->get_style()){
			resume_styes::federal => $this->render_federal(resume_styes::federal->get_style_layout()),  // WARN: ?????
			resume_styes::user_def => $this->render(),
		};
	}
	
	// NOTE: maybe just have a singular, flexible func that can handle all
	// cases???
	
	private function render_federal(resume_styes $headers): string
	{
		$get = new parse_federal($this->r);
		$headers = $headers;

		$render = "<style> h1, h2, h3, h4 { text-align: center; } </style>";
		$render .= "<html><body>";
		$personal_arr = $get->get_personal_arry($headers);
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
