<?php get_header(); ?>
<div id="conteiner">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="boxer width">
            <div class="title">
                <h1 class="title"><?php the_category();?></h1>
            </div>
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

                    <div class="likes"><img src="img/like.png" alt="" title=""/></div>
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