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
		$get = new pdf_parser($r);
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
