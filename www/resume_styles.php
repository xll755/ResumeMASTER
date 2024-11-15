<?php

enum resume_styes: string
{
	case federal = "federal";
	case user_def = "user_def";

	/*
	 * @return array of resume style's headers
	 * Special case: user_def.
	 */
	public function get_style_layout(): array
	{
		return match($this) {
			resume_styes::federal => ["Objective", "Skills & Training", "Professional Expereince", "Education", "Additional Information"],
			resume_styes::user_def => [],
		};
	}
}
?>
