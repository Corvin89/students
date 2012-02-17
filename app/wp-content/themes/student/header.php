<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php bloginfo('name'); ?> - <?php wp_title(); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="keywords"/>
    <meta name="description" content="description"/>
    <meta http-equiv="content-language" content="en"/>
    <meta name="language" content="en"/>
    <meta http-equiv="imagetoolbar" content="no"/>
    <link href="css/all.css" rel="stylesheet" type="text/css" media="all"/>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.infieldlabel.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/main.js"></script>
    <link rel="stylesheet" media="screen" href="<?php bloginfo('template_directory'); ?>/css/all.css"/>
    <!--[if IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/ie8.css" media="screen"/><![endif]-->
    <!--[if gte IE 9]>
    <script type="text/javascript"> Cufon.set('engine', 'canvas'); </script> <![endif]-->
    <link rel="stylesheet" type="text/css" media="print" href="<?php bloginfo('template_directory'); ?>/css/print.css"/>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/google.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/search.js"></script>
    <script type="text/javascript" src="http://userapi.com/js/api/openapi.js?47"></script>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
    <script src="http://cdn.connect.mail.ru/js/loader.js" type="text/javascript" charset="UTF-8"></script>
    <script type="text/javascript">
        VK.init({apiId:2784828, onlyWidgets:true});
    </script>
    <?php wp_head(); ?>
</head>
<body>
<div id="fb-root"></div>
<script>(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="page">
    <div id="header">
        <div class="top">
            <a href="<?php bloginfo('url'); ?>" id="logo"></a>

            <div class="banner"><a href="<?php echo get_option('top_banner_url');?>"><img
                src="<?php echo get_option('top_banner_path');?>" alt=""
                title=""/></a></div>
        </div>
		<div class="menu">
			<?php 
	             head_menu() ;
	        ?>
			<div class="serc">				
				<form role="search" method="get" id="searchform" action="<?php echo get_bloginfo("siteurl"); ?>"><div class="disk"><label for="s">Поиск по сайту</label><input type="text" class="text" value="" name="s" id="s" /><input type="submit" class="sub" id="searchsubmit" value="" /></div></form>
			</div>
		</div>
    </div>