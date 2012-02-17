<?php get_header(); ?>

<h2 class="pagetitle">Результат
    поиска <?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e('<span class="search-terms">'); echo $key; _e('</span>'); _e(' &mdash; '); echo $count . ' '; _e('articles'); wp_reset_query(); ?></h2>

<div id="conteiner">
    <div class="boxer width">
    <?php $posts = query_posts($query_string . '&posts_per_page=-1'); ?>
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <div class="boxer width">
            <div class="post">
                <div class="top-cat">
                    <span class="date"><?php the_time('d.m.y');?></span>
                    <a href="#" class="tags"><?php
                        $posttags = get_the_tags();
                        if ($posttags) {
                            foreach ($posttags as $tag) {
                                echo $tag->name . ' ';
                            }
                        }
                        ?></a>
                </div>
                <div class="two-box">
                    <div class="post-photo">
                        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a>
                    </div>
                    <div class="box-text">
                        <h3><a href="<?php the_permalink() ?>"><?php the_title();?></a></h3>

                        <p><?php the_excerpt() ?></p>
                    </div>
                </div>
                <div class="soc"><a href="<?php the_permalink();?>" class="more">Подробнее...</a>
                    <?php do_shortcode('[social_likes]'); ?>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    <?php endif; ?>
    </div>
    <div class="col-3">
        <?php get_sidebar('top');?>
        <?php get_sidebar('bottom');?>
    </div>
</div>

<?php get_footer(); ?>