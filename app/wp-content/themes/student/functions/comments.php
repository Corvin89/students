<?php

function mytheme_comment($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>">
        <div class="coment">
            <div class="ava">
                <div class="commentlist">
                    <ul>
                        <li>
							<div class="comment">
	                  			<div class="ava"><?php echo get_avatar($comment,$size='48',$default='<path_to_url>' ); ?></div>
	                            <div class="boxers">
	                                <p><a href="#" class="name"><?php printf(__('%s'), get_comment_author_link()) ?></a><span class="date"><?php printf(__('%1$s at %2$s'), get_comment_date('d.m.Y'),  get_comment_time( 'h:i')); ?>
	                   </span> <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></p>
	                                <?php if ($comment->comment_approved == '0') : ?>
	                                <p><?php _e('Your comment is awaiting moderation.') ?></p>
	                                <?php endif; ?>
	                                <?php comment_text() ?>
	                                <div class="reply">
	                                    <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	                                </div>
	                            </div>
							</div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
<?php
}