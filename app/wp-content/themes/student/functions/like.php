<?php
function shortcode_social_likes($atts, $content = null) {
    extract(shortcode_atts(array(
        'size' => 'full'
    ), $atts));
    if($size == 'full'):
        ?>
        <div class="likes-col-1">
    <div class="social_likes <?php echo $size ?>">
        <g:plusone href="<?php the_permalink(); ?>" class="social_like_button" size="medium"></g:plusone>
    </div>
        <div id="vk_like_<?php the_ID(); ?>" class="social_like_button"></div>

        <div class="fb-like social_like_button" data-href="<?php the_permalink(); ?>"
             data-send="false" data-layout="button_count" data-width="200" data-show-faces="false" data-action="recommend"></div>
    </div>

    <script type="text/javascript">VK.Widgets.Like("vk_like_<?php the_ID(); ?>", {type: "mini", width:205, pageUrl: '<?php the_permalink(); ?>', verb: 1, pageImage: '<?php the_thumbnail_src(); ?>'});</script>
    <?php elseif($size == 'mini'): ?>

    <?php endif;
//    <div class="likes-col-1">-->
//    <!--                        <!--tweet button-->
//    <!--                        <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>-->
//    <!--                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>-->
//    <!--                    </div>-->
//    <!--                    <div class="likes-col-3">-->
//    <!--                        <!--button mail.ru like-->
//    <!--                        <a target="_blank" class="mrc__plugin_uber_like_button" href="http://connect.mail.ru/share?share_url=http%3A%2F%2F" data-mrc-config="{'type' : 'button', 'caption-mm' : '1', 'caption-ok' : '0', 'counter' : 'true', 'text' : 'true', 'width' : '100%'}">Нравится</a>-->
//    <!--                        <script src="http://cdn.connect.mail.ru/js/loader.js" type="text/javascript" charset="UTF-8"></script>-->
//    <!--                    </div>-->
}

add_shortcode('social_likes', 'shortcode_social_likes');