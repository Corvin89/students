<?php get_header(); ?>
<div id="conteiner">
    <div class="boxer">
    <div class="box-post">
        <?php query_posts('posts_per_page=1'); ?>
        <?php while (have_posts()) : the_post(); ?>
        <div class="title"><a href="<?php the_permalink();?>"><?php the_category(); ?></a></div>
        <div class="black">
            <p><a href="<?php the_permalink();?>" class="title"><?php the_title(); ?></a></p>

            <p><a href="<?php the_permalink();?>" class="more">Подробнее...</a></p>
        </div>
        <?php the_post_thumbnail(); ?>
        </div>
        <div class="news">
            <p><span class="date"><?php  the_date('d:m:y'); ?></span></p>

            <?php list($teaser, $junk) = explode('<!--more', $post->post_content);
            echo apply_filters('the_content', $teaser); ?>

            <div class="soc"><a href="<?php the_permalink();?>" class="more">Подробнее...</a>

                <div class="likes">
                    <img src="<?php bloginfo('template_directory'); ?>/img/like.png" alt="" title=""/>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
        <div class="news">
            <ul class="posts">
                <?php query_posts('posts_per_page=1'); ?>
                <?php while (have_posts()) : the_post(); ?>
                <li>
                    <div class="small">
                        <a href="<?php the_permalink();?>"><?php the_post_thumbnail(); ?></a>

                        <div class="title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></div>
                    </div>
                    <div class="top-cat">
                        <span class="date"><?php the_date('d:m:y') ?></span>
                        <a href="#" class="tags">Style & Design </a>
                    </div>
                    <p>Little Printer enables users to set up subscriptions to a range of publications, which it then
                        prints as one miniature newspaper.</p>

                    <p><a href="#" class="more">Подробнее...</a></p>

                    <div class="soc-like">
                        <img src="<?php bloginfo('template_directory'); ?>/img/bg-like.png" alt="" title=""/>
                    </div>
                </li>
                <li>
                    <div class="small">
                        <a href="#"><img src="<?php bloginfo('template_directory'); ?>/img/small.jpg" alt="" title=""/></a>

                        <div class="title"><a href="#">Бал дебютанок Tatler</a></div>
                    </div>
                    <div class="top-cat">
                        <span class="date">08.12.11</span>
                        <a href="#" class="tags">Style & Design </a>
                    </div>
                    <p>Little Printer enables users to set up subscriptions to a range of publications, which it then
                        prints as one miniature newspaper.</p>

                    <p><a href="#" class="more">Подробнее...</a></p>

                    <div class="soc-like">
                        <img src="<?php bloginfo('template_directory'); ?>/img/bg-like.png" alt="" title=""/>
                    </div>
                </li>
                <?php endwhile; ?>
            </ul>
        </div>
        <div class="post">
            <div class="top-cat">
                <span class="date">08.12.11</span>
                <a href="#" class="tags">Style & Design </a>
            </div>
            <div class="two-box">
                <div class="post-photo">
                    <a href="#"><img src="<?php bloginfo('template_directory'); ?>/img/photo.png" alt="" title=""/></a>
                </div>
                <div class="box-text">
                    <h3><a href="#">Web-connected printer creates personalized mini newspapers</a></h3>

                    <p>Little Printer enables users to set up subscriptions to a range of publications, which it then
                        prints as one miniature newspaper.</p>
                </div>
            </div>
            <div class="soc"><a href="#" class="more">Подробнее...</a>

                <div class="likes"><img src="<?php bloginfo('template_directory'); ?>/img/like.png" alt="" title=""/>
                </div>
            </div>
        </div>
        <div class="post">
            <div class="top-cat">
                <span class="date">08.12.11</span>
                <a href="#" class="tags">Style & Design </a>
            </div>
            <div class="two-box">
                <div class="post-photo">
                    <a href="#"><img src="<?php bloginfo('template_directory'); ?>/img/photo.png" alt="" title=""/></a>
                </div>
                <div class="box-text">
                    <h3><a href="#">Web-connected printer creates personalized mini newspapers</a></h3>

                    <p>Little Printer enables users to set up subscriptions to a range of publications, which it then
                        prints as one miniature newspaper.</p>
                </div>
            </div>
            <div class="soc"><a href="#" class="more">Подробнее...</a>

                <div class="likes"><img src="<?php bloginfo('template_directory'); ?>/img/like.png" alt="" title=""/>
                </div>
            </div>
        </div>
    </div>
    <?php get_sidebar('banner'); ?>
    <div class="col-3">
        <?php get_sidebar('top'); ?>
        <?php get_sidebar('middle'); ?>
        <?php get_sidebar('bottom'); ?>
    </div>
</div>
</div>
<?php get_footer(); ?>