<?php
include "./back_end/text-to-html.php";
include "./back_end/resume-styles.php";
class pdf_render
{
	use text2html;
	private Resume $r;

	public function render($info): string
	{
		return match(resume_styes::custom){
			resume_styes::custom => $this->render_custom(resume_styes::custom->get_style_layout(), $info),
			resume_styes::user_def => $this->render(),
		};
	}

	private function render_custom(array $headers, array $info): string
	{
		$render = "<style> h1, h2 { text-align: center; } </style>";
		$render .= "<html><body>";
		$render .= $this->personal_data($headers[0], info: $info['personal_info']);
		$render .= $this->work_expreience($headers[1], work_exper: $info['work_info']);
		$render .= $this->edu_expereince($headers[2], school_exper: $info['edu_info']);
		$render .= $this->additional_info($headers[3], $info['add_info']);
		$render .= "</body></html>";
		return $render;
	}
}
