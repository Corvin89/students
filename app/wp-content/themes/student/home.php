<?php
/**
 * Template Name: Home Page Template
 * Description: Home Page
 */
get_header(); ?>
<div id="conteiner">
    <div class="boxer">
        <?php query_posts('posts_per_page=1'); ?>
        <?php while (have_posts()) : the_post(); ?>
        <div class="box-post">
            <div class="title"><a href="<?php the_permalink();?>"><?php the_category(); ?></a></div>
            <div class="black">
                <p><a href="<?php the_permalink();?>" class="title"><?php the_title(); ?></a></p>

                <p><a href="<?php the_permalink();?>" class="more">Подробнее...</a></p>
            </div>
            <?php the_post_thumbnail(); ?>
        </div>
        <div class="news">
            <p><span class="date"><?php the_time('d:m:y'); ?></span></p>

            <?php $a=get_the_content(); kama_excerpt(array("maxchar" => 380, "text" => $a));?>

            <div class="soc"><a href="<?php the_permalink();?>" class="more">Подробнее...</a>

                <div class="likes">
                    <img src="<?php bloginfo('template_directory'); ?>/img/like.png" alt="" title=""/>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
        <?php wp_reset_query(); ?>
        <div class="news">
            <ul class="posts">
                <?php query_posts('posts_per_page=2&offset=1'); ?>
                <?php while (have_posts()) : the_post(); ?>
                <li>
                    <div class="small">
                        <a href="<?php the_permalink();?>"><?php the_post_thumbnail(); ?></a>

                        <div class="title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></div>
                    </div>
                    <div class="top-cat">
                        <span class="date"><?php the_time('d:m:y'); ?></span>
                        <a href="<?php the_permalink();?>" class="tags"><?php
                            $posttags = get_the_tags();
                            if ($posttags) {
                                foreach ($posttags as $tag) {
                                    echo $tag->name . ' ';
                                }
                            }
                            ?>
                        </a>
                    </div>
                    <?php $a=get_the_content(); kama_excerpt(array("maxchar" => 380, "text" => $a));?>

                    <p><a href="<?php the_permalink();?>" class="more">Подробнее...</a></p>

                    <div class="soc-like">
                        <img src="<?php bloginfo('template_directory'); ?>/img/bg-like.png" alt="" title=""/>
                    </div>
                </li>
                <?php endwhile; ?>
                <?php wp_reset_query(); ?>
            </ul>
        </div>
        <?php query_posts('posts_per_page=2&category_name=studwiki'); ?>
        <?php while (have_posts()) : the_post(); ?>
        <div class="post">
            <div class="top-cat">
                <span class="date"><?php the_time('d:m:y'); ?></span>
                <a href="<?php the_permalink();?>" class="tags"><?php
                    $posttags = get_the_tags();
                    if ($posttags) {
                        foreach ($posttags as $tag) {
                            echo $tag->name . ' ';
                        }
                    }
                    ?>
                </a>
            </div>
            <div class="two-box">
                <div class="post-photo">
                    <a href="<?php the_permalink();?>"><?php the_post_thumbnail(); ?></a>
                </div>
                <div class="box-text">
                    <h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>

                    <?php $a=get_the_content(); kama_excerpt(array("maxchar" => 380, "text" => $a));?>

                </div>
            </div>
            <div class="soc"><a href="#" class="more">Подробнее...</a>

                <div class="likes"><img src="<?php bloginfo('template_directory'); ?>/img/like.png" alt="" title=""/>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
        <?php wp_reset_query(); ?>
    </div>
    <?php get_sidebar('banner'); ?>
    <div class="col-3">
        <?php get_sidebar('top'); ?>
        <?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>
        <?php //get_sidebar('middle'); ?>
        <?php endif; ?>
        <?php get_sidebar('bottom'); ?>
    </div>
</div>
</div>
<?php get_footer(); ?>