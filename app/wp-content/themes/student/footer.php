<div id="footer">
    <div class="cntr">
        <?php wp_nav_menu($args = array(
            'menu' => 'bottom',
            'container' => 'div',
            'container_class' => 'menu',
            'menu_class' => 'menu',
            'echo' => true,
            'depth' => 1,
        )
    );?>
        <div class="last">
            <div class="copy">
                <div class="logo"><a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/img/divlogo.png" alt=""
                                                   title=""/></a></div>
                <p>Студенческий журнал IStudent.kz © 2011, Все права защищены.</p>
            </div>
            <div class="soc">
                <h6>Мы в сети:</h6>
                <ul class="soc-icon">
                    <li><a href="<?php echo get_option('student_vk');?>"><img src="<?php bloginfo('template_directory'); ?>/img/small1.png" alt="" title="" /></a></li>
                    <li><a href="<?php echo get_option('student_mail');?>"><img src="<?php bloginfo('template_directory'); ?>/img/small2.png" alt="" title="" /></a></li>
                    <li><a href="<?php echo get_option('student_twitter');?>"><img src="<?php bloginfo('template_directory'); ?>/img/small3.png" alt="" title="" /></a></li>
                    <li><a href="<?php echo get_option('student_google');?>"><img class="fece-img" src="<?php bloginfo('template_directory'); ?>/img/small4.png" alt="" title="" /></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>
