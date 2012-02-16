<?php
class MP_Newsletter_scheduler_post extends MP_newsletter_scheduler_post_
{
	public $id = 'post';

	function get_meta_key()
	{
		return '_MailPress_published';
	}
}
new MP_Newsletter_scheduler_post(__('Each post', MP_TXTDOM));