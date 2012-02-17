<?php get_header(); ?>
<div id="conteiner">
    <div class="boxer width">
        <div class="title">
            <h1 class="title"><?php echo single_term_title(); ?></h1>
        </div>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="post">
            <div class="top-cat">
                <span class="date"><?php the_time('d.m.y');?></span>
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
                    <a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a>
                </div>
                <div class="box-text">
                    <h3><a href="<?php the_permalink() ?>"><?php the_title();?></a></h3>
                    <?php the_content();?>
                </div>
            </div>
            <div class="soc"><a href="<?php the_permalink();?>" class="more">Подробнее...</a>

                <?php do_shortcode('[social_likes]'); ?>
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