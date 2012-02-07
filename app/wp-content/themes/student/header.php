<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="keywords"/>
    <meta name="description" content="description"/>
    <meta http-equiv="content-language" content="en"/>
    <meta name="language" content="en"/>
    <meta http-equiv="imagetoolbar" content="no"/>
    <link href="css/all.css" rel="stylesheet" type="text/css" media="all"/>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/main.js"></script>
    <link rel="stylesheet" media="screen" href="<?php bloginfo('template_directory'); ?>/css/all.css"/>
    <!--[if IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/ie8.css" media="screen"/><![endif]-->
    <!--[if gte IE 9]>
    <script type="text/javascript"> Cufon.set('engine', 'canvas'); </script> <![endif]-->
    <link rel="stylesheet" type="text/css" media="print" href="<?php bloginfo('template_directory'); ?>/css/print.css"/>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/google.js"></script>
    <script type="text/javascript" src="http://userapi.com/js/api/openapi.js?47"></script>
    <script type="text/javascript">
        VK.init({apiId: 2784828, onlyWidgets: true});
    </script>
    <?php wp_head(); ?>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="page">
    <div id="header">
        <div class="top">
            <a href="<?php bloginfo('url'); ?>" id="logo"></a>

            <div class="banner"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/img/banner.gif" alt=""
                                                 title=""/></a></div>
        </div>
        <?php wp_nav_menu($args = array(
            'menu' => 'Top',
            'container' => 'div',
            'container_class' => 'menu',
            'menu_class' => 'menu',
            'echo' => true,
            'walker' => new My_Walker_Nav_Menu
             )
        );?>

    </div>