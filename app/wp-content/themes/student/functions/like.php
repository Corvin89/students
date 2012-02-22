<?php
function shortcode_social_likes()
{
    ?>
<div class="soc-block">
    <div class="soc-line">
        <div class="likes-col-1">
            <?php googleButton();?>
        </div>
        <div class="likes-col-2">
            <?php tweet();?>
        </div>
        <div class="likes-col-3">
            <?php mailru(); ?>
        </div>
        <div class="likes-col-4">
            <?php vklike();  ?>
            <script type="text/javascript">VK.Widgets.Like("vk_like_<?php the_ID(); ?>", {type:"button", width:205, pageUrl: '<?php the_permalink(); ?>', verb: 1, pageImage: '<?php the_thumbnail_src(); ?>'});</script>
        </div>
        <div class="likes-col-5">
            <?php facebook(); ?>
        </div>
    </div>
</div>
<?php
}

add_shortcode('social_likes', 'shortcode_social_likes');


function shortcode_social_likes_loop()
{
    ?>
<div class="soc-like">
    <div class="likes">
        <?php googleButton();?>
    </div>
    <div class="likes-col-2">
        <?php tweet();?>
    </div>
    <div class="likes-col-3">
        <?php mailru(); ?>
    </div>
    <div class="likes-col-3">
        <?php vklike();  ?>
        <script type="text/javascript">VK.Widgets.Like("vk_like_<?php the_ID(); ?>", {type:"button", width:205, pageUrl: '<?php the_permalink(); ?>', verb: 1, pageImage: '<?php the_thumbnail_src(); ?>'});</script>
    </div>
    <div class="likes-col-4-1">
        <?php facebook(); ?>
    </div>
</div>
<?php
}

add_shortcode('social_likes_loop', 'shortcode_social_likes_loop');

function googleButton()
{
    ?>
<!--google+1button-->
<g:plusone href="<?php the_permalink(); ?>" class="social_like_button" size="medium"></g:plusone>

<?php
}

function tweet()
{
    ?>
<!--tweet button-->
<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>"
   data-text="<?php the_permalink(); ?>" data-lang="ru">Твитнуть</a>
<?php
}

function mailru()
{
    ?>
<!--button mail.ru like-->
<span style="position: relative; left: 0; top: 0; margin: 0; padding: 0; visibility: visible;"><iframe
    frameborder="0"
    style="background-color: transparent; width: 100%; height: 21px; border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(255, 255, 0); border-right-color: rgb(255, 255, 0); border-bottom-color: rgb(255, 255, 0); border-left-color: rgb(255, 255, 0); border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-image: initial; "
    scrolling="no"
    src="http://connect.mail.ru/share_button?uber-share=1&amp;type=button&amp;caption-mm=1&amp;caption-ok=0&amp;counter=true&amp;text=true&amp;width=100%25&amp;domain=<?php the_permalink(); ?>&amp;url=<?php the_permalink(); ?>&amp;buttonID=5693409&amp;faces_count=10&amp;height=21&amp;caption=%D0%9D%D1%80%D0%B0%D0%B2%D0%B8%D1%82%D1%81%D1%8F&amp;wid=3048932&amp;app_id=-1&amp;host=http%3A%2F%2F<?php the_permalink(); ?>"
    allowtransparency="true"></iframe></span>
<?php
}

function vklike()
{
    ?>
<!--vk like button-->
<!--<div id="vk_like_--><?php //the_ID(); ?><!--" class="social_like_button"></div>-->
<div id="vk_like_<?php the_ID(); ?>" class="social_like_button"></div>
<!--<script type="text/javascript">VK.Widgets.Like("vk_like_--><?php //the_ID(); ?><!--", {type: "mini", width:205, pageUrl: '--><?php //the_permalink(); ?><!--', verb: 1, pageImage: '--><?php //the_thumbnail_src(); ?><!--'});</script>-->

<?php
}

function facebook()
{
    ?>
<!--facebook button-->
<div class="fb-like social_like_button" data-href="<?php the_permalink(); ?>"
     data-send="false" data-layout="button_count" data-width="200" data-show-faces="false"
     data-action="recommend"></div>

<?php }



