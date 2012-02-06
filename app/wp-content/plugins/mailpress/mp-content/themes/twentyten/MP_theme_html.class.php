<?php
class MP_theme_html
{
	const HEADER_IMAGE_WIDTH = 700;
	const HEADER_IMAGE_HEIGHT = 147;

	public static function header_image($default, $post_id = false)
	{
		if (!is_numeric($post_id)) $post_id = false;
		switch (true)
		{
			case ( $post_id && function_exists('has_post_thumbnail') && function_exists('get_post_thumbnail_id') && function_exists('wp_get_attachment_image_src') && $post_id && has_post_thumbnail( $post_id ) && ($image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'post-thumbnail')) && ($image[1] >= self::HEADER_IMAGE_WIDTH) ) :
				echo $image[0];
			break;
			case ( function_exists('get_header_image') && get_header_image() ) :
				echo get_header_image();
			break;
			default:
				echo $default;
			break;
		}
	}
//
	public static function comments_popup_link_attributes($attrs = '')
	{
		return $attrs . ' style="color:#888;" ';
	}

	public static function the_category($thelist, $separator, $parents)
	{
		return str_replace(array('a href=', 'rel="category"'), array('a style="color:#888;" href=', ''), $thelist );
	}

	public static function term_links_post_tag($term_links)
	{
		foreach($term_links as $k => $v)
			$term_links[$k] = str_replace('a href=', 'a style="color:#888;" href=', $v );
		return $term_links;
	}
}