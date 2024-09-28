<?php
/**
 * Provides input validation for user input
 *
 * NOTE: should these funcs return bools & we make another trait for cleaning
 * input?
 */
trait Validation
{
	/**
	 * Provides input validation for user string input
	 * WARN: not implemented
	 *
	 * @param string $str string input to be verified
	 * @return string $str validated string
	 */
	function validate_str_input(string $str): string
	{
		// TODO: validate user input
		return $str;
	}

	/**
	 * Provides input validation for user integer input
	 * WARN: not implemented
	 *
	 * @param integer $int integer input to be verified
	 * @return integer $int validated integer
	 */
	function validate_int_input(int $int): int
	{
		// TODO: validate user input
		return $int;
	}

	function validate_email(string $str): string
	{
		// TODO: validate email
		// NOTE: necessary ???
		return $str;

	}
}
?>
