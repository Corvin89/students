<?php if ( is_active_sidebar( 'subscribe-sidebar' ) ) { ?>
<?php if ( !dynamic_sidebar('subscribe-sidebar') ) : ?>
    <?php endif; ?>
<?php } else { ?>
<?php get_sidebar(); ?>
<?php } ?>