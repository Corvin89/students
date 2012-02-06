<?php

function the_thumbnail_src() {
    $image_url = wp_get_attachment_image_src( get_post_thumbnail_id() );
    echo $image_url[0];
}