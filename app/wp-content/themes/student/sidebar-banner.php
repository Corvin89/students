<div class="right-box">
    <div class="boxe">
        <div class="top-blue">Интервью</div>
        <div class="images">
            <?php wp_reset_query(); ?>
            <?php query_posts('posts_per_page=1&category_name=interview'); ?>
            <?php while (have_posts()) : the_post(); ?>
            <a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('url') ?>/resize.php?src=<?= wp_get_attachment_url(get_post_thumbnail_id($post->ID)) ?>&#38;w=160&#38;zc=0" alt="" /></a>
            <a href="<?php the_permalink(); ?>"><div class="title"><?php the_title(); ?></div></a>
            <?php endwhile; ?>
            <?php wp_reset_query(); ?>
        </div>
    </div>
    <div class="boxe">
        <div class="top-green">Интервью</div>
        <div class="images">
            <?php wp_reset_query(); ?>
            <?php query_posts('posts_per_page=1&offset=1&category_name=interview'); ?>
            <?php while (have_posts()) : the_post(); ?>
            <a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('url') ?>/resize.php?src=<?= wp_get_attachment_url(get_post_thumbnail_id($post->ID)) ?>&#38;w=160&#38;zc=0" alt="" /></a>
            <a href="<?php the_permalink(); ?>"><div class="title"><?php the_title(); ?></div></a>
            <?php endwhile; ?>
            <?php wp_reset_query(); ?>
        </div>
    </div>
    <div class="boxe">
        <a href="<?php echo get_option('bottom_banner_url');?>"><img
            src="<?php echo get_option('bottom_banner_path');?>" alt=""
            title=""/></a>
    </div>
</div>