<?php
if (class_exists('MailPress') && !class_exists('MailPress_upload_media') && (is_admin()))
{
/*
Plugin Name: MailPress_upload_media
Plugin URI: http://www.mailpress.org/wiki/index.php?title=Add_ons:Upload_media
Description: This is just an add-on for MailPress to allow upload media button on MailPress write admin page
Version: 5.2.1
*/

class MailPress_upload_media
{
	function __construct()
	{
		add_filter('MailPress_upload_media', 	array(__CLASS__, 'upload_media'), 8, 1);
	}

	public static function upload_media($x)
	{
		return true;
	}
}
new MailPress_upload_media();
}