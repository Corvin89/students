<?php
add_theme_support('post-thumbnails');

if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
}

function the_thumbnail_src() {
    $image_url = wp_get_attachment_image_src( get_post_thumbnail_id() );
    echo $image_url[0];
}

require_once "functions/menu.php";
require_once "functions/opengraph.php";