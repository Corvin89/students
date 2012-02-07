<?php get_header(); ?>

<h2 class="pagetitle">Результат
    поиска <?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e('<span class="search-terms">'); echo $key; _e('</span>'); _e(' &mdash; '); echo $count . ' '; _e('articles'); wp_reset_query(); ?></h2>

<div id="conteiner">
    <?php $posts = query_posts($query_string . '&posts_per_page=-1'); ?>
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <div class="boxer width">
            <div class="post">
                <div class="top-cat">
                    <span class="date"><?php the_time('d.m.y');?></span>
                    <a href="#" class="tags">Style & Design </a>
                </div>
                <div class="two-box">
                    <div class="post-photo">
                        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a>
                    </div>
                    <div class="box-text">
                        <h3><a href="<?php the_permalink() ?>"><?php the_title();?></a></h3>

                        <p><?php the_excerpt() ?></p>
                    </div>
                </div>
                <div class="soc"><a href="<?php the_permalink();?>" class="more">Читать далее</a>

                    <div class="likes">
                        <!--google+1button-->
                        <g:plusone size="medium"></g:plusone>
                    </div>
                    <div class="likes">
                        <!--tweet button-->
                        <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                    </div>
                    <div class="likes">
                        <!--button mail.ru like-->
                        <a target="_blank" class="mrc__plugin_uber_like_button" href="http://connect.mail.ru/share?share_url=http%3A%2F%2F" data-mrc-config="{'type' : 'button', 'caption-mm' : '1', 'caption-ok' : '0', 'counter' : 'true', 'text' : 'true', 'width' : '100%'}">Нравится</a>
                        <script src="http://cdn.connect.mail.ru/js/loader.js" type="text/javascript" charset="UTF-8"></script>
                    </div>
                    <div class="likes">
                        <!--vk like button-->
                        <div id="vk_like"></div>
                        <script type="text/javascript">
                            VK.Widgets.Like("vk_like", {type: "button", height: 20});
                        </script>
                    </div>
                    <div class="likes">
                        <!--facebook button-->
                        <div class="fb-like" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    <?php endif; ?>

    <div class="col-3">
        <div class="top-orang">Подпишитесь бесплатно</div>
        <form action="" method="post">
            <div class="white">
                <p>Join 150,000 others: Sign up for our daily or weekly newsletters so you won't miss the latest and
                    greatest</p>

                <div class="email">
                    <input type="text" class="text" value="Напишите вашу E-mail..."/>
                    <input type="submit" class="submit" value=""/>
                </div>
                <p><strong>Анонимность данных гарантируем!</strong></p>
            </div>
        </form>
        <div class="top-green-big">Мы в сети</div>
        <ul class="soc-icon">
            <li><a href="#"><img src="img/icon1.gif" alt="" title=""/></a></li>
            <li><a href="#"><img src="img/icon2.gif" alt="" title=""/></a></li>
            <li><a href="#"><img src="img/icon3.gif" alt="" title=""/></a></li>
            <li><a href="#"><img src="img/icon4.gif" alt="" title=""/></a></li>
        </ul>
    </div>
</div>

<?php get_footer(); ?>