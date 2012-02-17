<?php get_header(); ?>
<div id="conteiner">
    <div class="boxer width">
        <div class="orang">
            <?php
            while (have_posts()) : the_post(); ?>
                <h1><?php the_title(); ?></h1>
                <?php
                the_content();
            endwhile;
            echo do_shortcode('[contact-form-7 id="65" title="Форма для контакта 1"]');
            ?>

        </div>
    </div>
    <div class="col-3">
        <?php get_sidebar('top');?>
        <?php get_sidebar('bottom');?>
    </div>
</div>
</div>
<?php get_footer(); ?>