<?php
include "./text2html.php";
include "./resume_styles.php";
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

	// TODO: decide on this
	// public function __construct(Resume $r)
	// {
	// 	$this->r = $r;
	// }

	// NOTE: better to take in obj in constructor or in func???

	public function render($info): string
	{
		// return match($this->r->get_style()){
		// TODO: implement
		return match(resume_styes::custom){
			// resume_styes::federal => $this->render_federal(resume_styes::federal->get_style_layout(), $info),  // WARN: ?????
			resume_styes::custom => $this->render_custom(resume_styes::custom->get_style_layout(), $info),  // WARN: ?????
			resume_styes::user_def => $this->render(),
		};
	}
	
	// NOTE: maybe just have a singular, flexible func that can handle all
	// cases???
	
	private function render_custom(array $headers, array $info): string
	{
		// $get = new parse_federal($this->r);


		$render = "<style> h1, h2, h3, h4 { text-align: center; } </style>";
		$render .= "<html><body>";
		$render .= $this->personal_data($headers[0], info: $info['personal_info']);
		$render .= $this->work_expreience($headers[1], work_exper: $info['work_info']);
		$render .= $this->edu_expereince($headers[2], school_exper: $info['edu_info']);
		$render .= $this->additional_info($headers[3], $info['add_info']);
		$render .= "</body></html>";
		return $render;
	}
}
