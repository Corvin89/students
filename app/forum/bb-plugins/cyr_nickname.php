<?php
/*
Plugin Name: CyrNickName
Plugin URI: http://bbpress.ru/downloads/plugins/
Description: Этот плагин позволяет использовать символы кириллицы в именах пользователей.
Author: Alex
Author URI: http://bbpress.ru/
Version: 0.21
*/ 

function sanitize_user_cyr( $raw_username, $username, $strict = false ) {
	$raw_username = $username;

	$username = strip_tags($username);
	// Kill octets
	$username = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '', $username);
	$username = preg_replace('/&.+?;/', '', $username); // Kill entities

	// If strict, reduce to ASCII for max portability.
//	if ( $strict )
//		$username = preg_replace('|[^a-z0-9 _.\-@]|i', '', $username);
		
	return apply_filters('sanitize_user_cyr', $username, $raw_username, $strict);
}

add_action('sanitize_user', 'sanitize_user_cyr', 0, 3);
?>
