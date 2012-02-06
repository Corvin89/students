<?php

/**
 * Adding Open Graph tags for social plugins
 * @author Vladislav Fedorischev <vlad_graf@mail.ru>
 */
function add_open_graph_tags() {
while (have_posts()) : the_post(); ?>
    <meta property="og:title" content="<?php
        $category = get_the_category();
        echo $category[0]->cat_name . ' - ';
        the_title()
        ?>"/>

    <meta property="og:image" content="<?php the_thumbnail_src(); ?>"/>
    <meta property="og:title" content="<?php echo strip_tags(get_the_title()) ?>"/>
    <meta property="og:description" content="<?php echo strip_tags(get_the_excerpt()) ?>"/>
    <meta property="og:site_name" content="web4life"/>
    <meta property="og:url" content="<?php the_permalink(); ?>"/>
    <meta property="og:type" content="article"/>
    <?php endwhile;
}

add_action('wp_enqueue_scripts', 'add_open_graph_tags');