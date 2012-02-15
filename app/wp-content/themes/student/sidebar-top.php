<p>Join 150,000 others: Sign up for our daily or weekly newsletters so you won't miss the latest and greatest</p>
<?php if ( is_active_sidebar( 'subscribe-sidebar' ) ) { ?>
<?php if ( !dynamic_sidebar('subscribe-sidebar') ) : ?>
    <?php endif; ?>
<?php } else { ?>
<?php get_sidebar(); ?>
<?php } ?>