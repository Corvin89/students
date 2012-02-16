<?php
function shortcode_social_likes($atts, $content = null)
{?>
<div class="soc-block">
    <div class="soc-line">
        <div class="likes-col-1">
            <!--google+1button-->
            <g:plusone href="<?php the_permalink(); ?>" class="social_like_button" size="medium"></g:plusone>
        </div>
        <div class="likes-col-2">
            <!--tweet button-->
            <iframe allowtransparency="true" frameborder="0" scrolling="no"
                    src="http://platform.twitter.com/widgets/tweet_button.1329256447.html#_=1329391666893&amp;_version=2&amp;count=horizontal&amp;enableNewSizing=false&amp;id=twitter-widget-0&amp;lang=en&amp;original_referer=http%3A%2F%2Fstudent.dev%2F&amp;size=m&amp;text=IStudent%20-&amp;url=http%3A%2F%2Fstudent.dev%2F"
                    class="twitter-share-button twitter-count-horizontal" style="height: 20px; width: 110px; "
                    title="Twitter Tweet Button"></iframe>
            <script>!function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (!d.getElementById(id)) {
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//platform.twitter.com/widgets.js";
                    fjs.parentNode.insertBefore(js, fjs);
                }
            }(document, "script", "twitter-wjs");</script>
        </div>

        <div class="likes-col-3">
            <!--button mail.ru like-->
            <span style="position: relative; left: 0; top: 0; margin: 0; padding: 0; visibility: visible;"><iframe
                frameborder="0"
                style="background-color: transparent; width: 100%; height: 21px; border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(255, 255, 0); border-right-color: rgb(255, 255, 0); border-bottom-color: rgb(255, 255, 0); border-left-color: rgb(255, 255, 0); border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-image: initial; "
                scrolling="no"
                src="http://connect.mail.ru/share_button?uber-share=1&amp;type=button&amp;caption-mm=1&amp;caption-ok=0&amp;counter=true&amp;text=true&amp;width=100%25&amp;domain=student.dev&amp;url=http%3A%2F%2F&amp;buttonID=4098066&amp;faces_count=10&amp;height=21&amp;caption=%D0%9D%D1%80%D0%B0%D0%B2%D0%B8%D1%82%D1%81%D1%8F&amp;wid=6576917&amp;app_id=-1&amp;host=http%3A%2F%2Fstudent.dev"
                allowtransparency="true" name="6576917" id="6576917"></iframe></span><a target="_blank"
                                                                                        class="mrc__plugin_uber_like_button"
                                                                                        href="http://connect.mail.ru/share?share_url=http%3A%2F%2F"
                                                                                        data-mrc-config="{'type' : 'button', 'caption-mm' : '1', 'caption-ok' : '0', 'counter' : 'true', 'text' : 'true', 'width' : '100%'}"
                                                                                        type="uber_like_button"
                                                                                        style="display: none; ">Нравится</a>
            <script src="http://cdn.connect.mail.ru/js/loader.js" type="text/javascript" charset="UTF-8"></script>
        </div>
        <div class="likes-col-4">
            <!--vk like button-->
            <div id="vk_like_<?php the_ID(); ?>" class="social_like_button"></div>

    <div class="soc-line">
        <div class="likes">
            <!--facebook button-->
            <div class="fb-like social_like_button" data-href="<?php the_permalink(); ?>"
        </div>
    </div>
</div>

<?php}

add_shortcode('social_likes', 'shortcode_social_likes');