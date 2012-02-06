<div id="footer">
    <div class="cntr">
        <ul class="menu">
            <li><a href="#">Главная</a></li>
            <li><a href="#">О нас</a></li>
            <li><a href="#">База идей</a></li>
            <li><a href="#">Новости</a></li>
            <li><a href="#">Контакты</a></li>
        </ul>
        <div class="last">
            <div class="copy">
                <div class="logo"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/img/divlogo.png" alt=""
                                                   title=""/></a></div>
                <p>Студенческий журнал IStudent.kz © 2011, Все права защищены.</p>
            </div>
            <div class="soc">
                <h6>Мы в сети:</h6>
                <ul class="soc-icon">
                    <li><a href="<?php echo get_option('vkontakte');?>"><img src="<?php bloginfo('template_directory'); ?>/img/icon1.gif" alt="" title="" /></a></li>
                    <li><a href="<?php echo get_option('mail');?>"><img src="<?php bloginfo('template_directory'); ?>/img/icon2.gif" alt="" title="" /></a></li>
                    <li><a href="<?php echo get_option('twitter');?>"><img src="<?php bloginfo('template_directory'); ?>/img/icon3.gif" alt="" title="" /></a></li>
                    <li><a href="<?php echo get_option('google');?>"><img src="<?php bloginfo('template_directory'); ?>/img/icon4.gif" alt="" title="" /></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>