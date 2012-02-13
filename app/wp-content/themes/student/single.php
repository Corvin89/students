<?php get_header();?>
<div id="conteiner">
    <div class="boxer width">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="pages">
                <?php $categories = get_the_category($post->ID);  ?>
                <?php
                    foreach ($categories as $category){
                        $array_categories[] = $category->term_id;
                    }
                ?>
                <h1><?php the_title();?></h1>
				<img src="<?php bloginfo('url') ?>/resize.php?src=<?= wp_get_attachment_url(get_post_thumbnail_id($post->ID)) ?>&#38;h=349&#38;w=561&#38;zc=1" alt="" />
       			<?php the_content();?>
				
        <div class="news">
            <p><span class="date"><?php the_time('d.m.y');?></span></p>
            <div class="soc">
				<div class="soc-line">
					<div class="likes-col-1">
	                    <!--google+1button-->
	                    <g:plusone size="medium"></g:plusone>
	                </div>
	                <div class="likes-col-2">
	                    <!--tweet button-->
	                    <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
	                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	                </div>
	                <div class="likes-col-3">
	                    <!--button mail.ru like-->
	                    <a target="_blank" class="mrc__plugin_uber_like_button" href="http://connect.mail.ru/share?share_url=http%3A%2F%2F" data-mrc-config="{'type' : 'button', 'caption-mm' : '1', 'caption-ok' : '0', 'counter' : 'true', 'text' : 'true', 'width' : '100%'}">Нравится</a>
	                    <script src="http://cdn.connect.mail.ru/js/loader.js" type="text/javascript" charset="UTF-8"></script>
	                </div>
	                <div class="likes-col-4">
	                    <!--vk like button-->
	                    <div id="vk_like"></div>
	                    <script type="text/javascript">
	                        VK.Widgets.Like("vk_like", {type: "button", height: 20});
	                    </script>
	                </div>
				</div>
				<div class="soc-line">
					<div class="likes-col-5">
	                    <!--facebook button-->
	                    <div class="fb-like" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true"></div>
	                </div>
				</div>                          
            </div>
        </div>
        <div class="list-url">
            <ul>
                <li><a href="#">Email to a Friend</a></li>
                <li><a href="#" class="print" onclick="print()">Print</a></li>
            </ul>
            <div class="url">
                <span>ссылка URL:</span>
                <input type="text" class="url" value="
					<?php 
						$now='http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
						echo $now;
					?>
				"/>
            </div>
        </div>
        <?php endwhile; ?>
        <?php endif; ?>
    </div>
        <div class="comentars">
            <h3>Комментарии</h3>
            <?php comments_template( '', true ); ?>
        </div>
        <div class="three-post">
            <h3>Related Ideas</h3>
            <ul>
                <?php query_posts( array('category__in' => $array_categories,
                                         'posts_per_page' => 3));
                ?>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <li>
                    <div class="small">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                        <div class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></div>
                    </div>
                </li>
                <?php endwhile; ?>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
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