<?php
class MP_Dashboard_widgets extends MP_options_
{
	var $path = 'dashboard/widgets';

	function __construct()
	{
		parent::__construct();
		do_action('MailPress_load_Dashboard_widgets'); 
	}
}