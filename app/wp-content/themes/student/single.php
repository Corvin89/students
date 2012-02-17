<?php get_header(); ?>
<div id="conteiner">
    <div class="boxer width">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="pages">
                <?php $categories = get_the_category($post->ID); ?>
        <?php
        foreach ($categories as $category) {
            $array_categories[] = $category->term_id;
        }
        ?>
        <h1><?php the_title();?></h1>
        <img
            src="<?php bloginfo('url') ?>/resize.php?src=<?= wp_get_attachment_url(get_post_thumbnail_id($post->ID)) ?>&#38;h=349&#38;w=561&#38;zc=1"
            alt=""/>
        <?php the_content(); ?>

        <div class="news">
            <p><span class="date"><?php the_time('d.m.y');?></span></p>

            <div class="soc">
                <?php do_shortcode('[social_likes]'); ?>
            </div>
        </div>
        <div class="list-url">
            <ul>
                <li><a href="#">Email to a Friend</a></li>
                <li><a href="#" class="print" onclick="print()">Print</a></li>
            </ul>
            <div class="url">
                <span>ссылка URL:</span>
                <input type="text" class="url"
                       value="<?php echo $now = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?> "/>
            </div>
        </div>
        <?php endwhile; ?>
        <?php endif; ?>
    </div>
        <div class="comentars">
            <h3>Комментарии</h3>
            <?php comments_template('', true); ?>
        </div>
        <div class="three-post">
            <h3>Related Ideas</h3>
            <ul>
                <?php query_posts(array('category__in' => $array_categories,
                'posts_per_page' => 3));
                ?>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <li>
                    <div class="small">
                        <a href="<?php the_permalink(); ?>"><img
                            src="<?php bloginfo('url') ?>/resize.php?src=<?= wp_get_attachment_url(get_post_thumbnail_id($post->ID)) ?>&#38;h=125&#38;w=175&#38;zc=1"
                            alt=""/></a>

                        <div class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></div>
                    </div>
                </li>
                <?php endwhile; ?>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
            </ul>
        </div>
    </div>
    <div class="col-3">
        <?php get_sidebar('top');?>
        <?php get_sidebar('bottom');?>
    </div>
</div>
</div>
<?php get_footer(); ?>