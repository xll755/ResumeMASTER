<?php
class pdf_render
{
	use text2html;
	private Resume $r;

	/*
	 * NOTE:
	 * Goal Usage:
	 * $out = pdf_render($resume)::render()
	 *
	* @param Resume $r to be rendered
	*/
	public function __construct(Resume $r)
	{
		$this->r = $r;
	}

	public function render(): string
	{
		$get = new pdf_parser($this->r);
		$render = '';

		$title = $get->get_section_before(''); //TODO:
		$render .= $this->render_h1($title);
		$name = $get->get_section_between('', ''); //TODO:
		$render .= $this->render_h2($name);
		// NOTE:
		// etc
		// add sections as needed.
		// results in a large string of html that can be sent to the exporter
		// for downloading.
		// different rendering methods could render different "styles" of resume.

		return $render;
	}
}
