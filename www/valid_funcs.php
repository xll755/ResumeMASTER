<?php
/*
* Validates the authenticity of a username input
*
* Usernames must be alphanumeric, 1-15 chars in length
* Regex from: https://regex101.com/library/qB2bB4?orderBy=RELEVANCE&search=username
*/
function is_valid_uname(string $uname = null) {
	$pattern = '/^(?=.*[a-zA-Z]{1,})(?=.*[\d]{0,})[a-zA-Z0-9]{1,15}$/';
	return (bool)preg_match($pattern, $uname);
}

/*
* Validates the authenticity of a email input
*
* Emails are checked against RFC 822
*/
function is_valid_email(string $email = null) {
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/*
* Validates the authenticity of a email input
*
* Passwords must:
*   - be >= 8 chars
*   - contain >= 1 lowercase letter
*   - contain >= 1 uppercase letter
*   - contain >= 1 digit
* Regex from: https://stackoverflow.com/questions/8141125/regex-for-password-php
*/
function is_valid_pwd(string $pwd = null) {
	$pattern = '^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$';
	return (bool)preg_match($pattern, $pwd);
}

/*
* Validates the authenticity of general user input
*
*/
function is_valid_input(string $in = null) {
	$pattern = '';
	return (bool)preg_match($pattern, $in);

}
?>
