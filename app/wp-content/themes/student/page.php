<?php get_header();?>
<div id="conteiner">
    <div class="boxer width">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="pages">
                <h1><?php the_title();?></h1>
                <?php the_content();?>
        <?php endwhile; ?>
        <?php endif; ?>
        <div class="news">
            <p><span class="date"><?php the_time('d.m.y');?></span></p>
            <div class="soc">
                <?php do_shortcode('[social_likes]'); ?>
            </div>
        </div>

    </div>
    </div>
    <div class="col-3">
        <?php get_sidebar('top');?>
        <?php get_sidebar('bottom');?>
    </div>
</div>
</div>
<?php get_footer();?>