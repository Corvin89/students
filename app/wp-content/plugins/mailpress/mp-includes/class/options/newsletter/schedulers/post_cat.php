<?php
class MP_Newsletter_scheduler_post_cat extends MP_newsletter_scheduler_post_
{
	public $id = 'post_cat';

	function get_meta_key()
	{
		return '_MailPress_published_category_' . $this->newsletter['params']['cat_id'];
	}
}
new MP_Newsletter_scheduler_post_cat(__('Per post/category', MP_TXTDOM));