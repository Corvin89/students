<?php get_header(); ?>
<div id="conteiner">
    <div class="boxer width">
        <div class="orang">
	         <?php
			while (have_posts()) : the_post(); ?>
			 <h1><?php the_title(); ?></h1> 
			<?php 
			the_content();
			endwhile;
			echo do_shortcode('[contact-form-7 id="65" title="Форма для контакта 1"]');
			?>

        </div>
    </div>
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
</div>
<?php get_footer(); ?>