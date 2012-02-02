<?php get_header();?>
    <div id="conteiner">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="boxer width">
            <div class="pages">
                <h1><?php the_title();?></h1>
                <p><?php the_content();?></p>
                <div class="news">
                    <p><span class="date"><?php the_time('d.m.y');?></span></p>
                    <div class="soc">
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
                <div class="list-url">
                    <ul>
                        <li><a href="#">Email to a Friend</a></li>
                        <li><a href="#" class="print">Print</a></li>
                        <li><a href="#" class="pdf">PDF</a></li>
                    </ul>
                    <div class="url">
                        <span>ссылка URL:</span>
                        <input type="text" class="url" value="http://www.springwise.com" />
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <?php endif; ?>
            <div class="comentars">
                <h3>Комментарии</h3>
                <div class="comments-wrapt">
                    <div class="commentlist">
                        <ul>
                            <li>
                                <div class="comment">
                                    <div class="ava">
                                        <img src="<?php bloginfo('template_directory'); ?>/img/ava.gif" alt="">
                                    </div>
                                    <div class="boxers">
                                        <p><a href="#" class="name">Nauman Lodhi</a> <span class="date">19/09/2011 10:22:33</span></p>
                                        <div class="reply"><a href="#">Ссылка на комментарий</a> | <a href="#">Ответ на комментарий</a></div>
                                        <p>Car sharing is well established here in Belgium but ride sharing needs work and co-operation from insurance companies and ways to vet the people who offer to share there car. </p>
                                        <p><a href="#" class="more">Ответить...</a></p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="respond">
                        <form action="" method="post">
                            <div class="item">
                                <label>Комментировать с помощью </label>
                                <ul>
                                    <li><input type="radio" /> <a href="#"><img src="<?php bloginfo('template_directory'); ?>/img/v.gif" title="" alt="" /></a></li>
                                    <li><input type="radio" /> <a href="#"><img src="<?php bloginfo('template_directory'); ?>/img/mail.gif" title="" alt="" /></a></li>
                                    <li><input type="radio" /> <a href="#"><img src="<?php bloginfo('template_directory'); ?>/img/t.gif" title="" alt="" /></a></li>
                                </ul>
                            </div>
                            <div class="item">
                                <textarea>Введите комментарий...</textarea>
                            </div>
                            <div class="item">
                                <input type="submit" class="orang" value="Отправить" />
                                <input type="submit" class="blue" value="Отмена" />
                                <span class="soc"><input type="checkbox" class="check" /> Опубликовать запись в Twitter</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="three-post">
                <h3>Related Ideas</h3>
                <ul>
                    <li>
                        <div class="small">
                            <a href="#"><img src="<?php bloginfo('template_directory'); ?>/img/photo.jpg" alt="" title="" /></a>
                            <div class="title"><a href="#">Бал дебютанок Tatler</a></div>
                        </div>
                    </li>
                    <li>
                        <div class="small">
                            <a href="#"><img src="<?php bloginfo('template_directory'); ?>/img/photo.jpg" alt="" title="" /></a>
                            <div class="title"><a href="#">Бал дебютанок Tatler</a></div>
                        </div>
                    </li>
                    <li>
                        <div class="small">
                            <a href="#"><img src="<?php bloginfo('template_directory'); ?>/img/photo.jpg" alt="" title="" /></a>
                            <div class="title"><a href="#">Бал дебютанок Tatler</a></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-3">
            <?php get_sidebar('top');?>
            <?php get_sidebar('bottom');?>
        </div>
    </div>
</div>
<?php get_footer();?>