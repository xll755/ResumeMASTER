<?php
trait text2html
{
	private function render_section(string $section): string
	{
		return '<section>' . $section . '<\section>';
	}

	private function render_header(string $header): string
	{
		return '<header>' . $header . '<\header>';
	}

	private function render_footer(string $footer): string
	{
		return '<footer>' . $footer . '<\footer>';
	}

	private function render_h1(string $h1): string
	{
		return '<h1>' . $h1 . '<\h1>';
	}

	private function render_h2(string $h2): string
	{
		return '<h2>' . $h2 . '<\h2>';
	}

	private function render_h3(string $h3): string
	{
		return '<h2>' . $h3 . '<\h2>';
	}

	private function render_h4(string $h4): string
	{
		return '<h4>' . $h4 . '<\h4>';
	}

	private function render_h5(string $h5): string
	{
		return '<h5>' . $h5 . '<\h5>';
	}

	private function render_h6(string $h6): string
	{
		return '<h6>' . $h6 . '<\h6>';
	}

	private function render_body(string $body): string
	{
		return '<body>' . $body . '<\body>';
	}

	private function render_paragraph(string $paragraph): string
	{
		return '<p>' . $paragraph . '<\p>';
	}

	private function render_hr(string $hr): string
	{
		return '<hr>' . $hr . '<\hr>';
	}
}
