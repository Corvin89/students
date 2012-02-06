<?php
class MP_Autoresponder_events extends MP_options_
{
	var $path = 'autoresponder/events';

	function __construct()
	{
		parent::__construct();
		do_action('MailPress_load_Autoresponders_events');
	}

	public static function get_all()
	{
		return apply_filters('MailPress_autoresponder_events_register', array());
	}
}