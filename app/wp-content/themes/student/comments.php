<?php
/**
* Template Name: Comments Template
* Description: Comments
*/
?>
<div class="comments-wrap">
<?php // Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>
    <p class="nocomments">This post is password protected. Enter the password to view comments.</p>
        <?php
return;
}
    ?>

    <?php if ('open' == $post->comment_status) : ?>

<div class="respond">
    <div class="cancel-comment-reply">
        <small><?php cancel_comment_reply_link(); ?></small>
    </div>

    <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
    <p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode

    (get_permalink()); ?>">logged in</a> to post a comment.</p>

    <?php else : ?>

    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id='comment-form'>

        <?php if ( $user_ID ) : ?>

        <p>Вы вошли как <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>.

            <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Выйти с аккаунта">Выход &raquo;</a></p>

        <?php else : ?>
        <div class="item">
            <em>Поля, отмеченные *, обязательны для заполнения.</em>
        </div>
        <div class="item">
            <label for="author"><?php _e('Name'); ?> <em>*</em></label>
            <input type="text" name="author" id="author" class="text" value="<?php echo $comment_author; ?>" size="28" />

        </div>

        <div class="item">
            <label for="3"><?php _e('E-mail'); ?> <em>*</em></label>
            <input type="text" name="email" id="email" class="text" value="<?php echo $comment_author_email; ?>" size="28" tabindex="2"  />
        </div>
        <div class="item">
            <label for="url"><?php _e('Город'); ?></label>
            <input type="text" name="url" id="url" value="" size="28" tabindex="3" class="text requre" />
        </div>
        <?php endif; ?>
        <div class="item">
            <label for="comment"><?php _e('Коментарий'); ?></label>
            <textarea name="comment" id="comment" cols="60" rows="10" tabindex="4" class="textarea requre"></textarea>
        </div>
        <div class="item">
            <input name="submit" id="submit" type="submit" tabindex="5" value="<?php _e('Отправить'); ?>" class="cbutton" />
            <?php comment_id_fields(); ?>
        </div>
        <?php do_action('comment_form', $post->ID); ?>
    </form>
    <?php  //show_manual_subscription_form(); ?>
    <?php endif; ?>
</div>
<!-- You can start editing here. -->
<?php // Begin Comments & Trackbacks ?>
<?php if ( have_comments() ) : ?>
    <div class="commentlist">
        <ul>
            <?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
        </ul>
    </div>
    <div class="pagenawi">
        <?php paginate_comments_links(); ?>
    </div>

    <?php // End Comments ?>

    <?php else : // this is displayed if there are no comments so far ?>

    <?php if ('open' == $post->comment_status) : ?>
        <!-- If comments are open, but there are no comments. -->

        <?php else : // comments are closed ?>
        <!-- If comments are closed. -->
        <p><?php _e('Sorry, the comment form is closed at this time.'); ?></p>

        <?php endif; ?>
    <?php endif; ?>


<?php else : // Comments are closed ?>
<p><?php _e('Sorry, the comment form is closed at this time.'); ?></p>
<?php endif; ?>
</div>

