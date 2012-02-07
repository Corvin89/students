<div class="top-orang">Подпишитесь бесплатно</div>
<form action="" method="post">
    <div class="white">
        <p>Join 150,000 others: Sign up for our daily or weekly newsletters so you won't miss the latest and greatest</p>
        <div class="email">
            <input type="text" class="text" value="Напишите вашу E-mail..." />
            <input type="submit" class="submit" value="" />
        </div>
        <p><strong>Анонимность данных гарантируем!</strong></p>
    </div>
    <form role="search" method="get" id="searchform" action="<?php bloginfo('siteurl'); ?>">
        <div>
            <label class="screen-reader-text" for="s">Ищем:</label>
            <input type="text" value="" name="s" id="s" />
            in <?php wp_dropdown_categories( 'show_option_all=All Categories' ); ?>
            <input type="submit" id="searchsubmit" value="Искать" />
        </div>
    </form>
</form>