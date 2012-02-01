<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Chocaloca</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="keywords"/>
    <meta name="description" content="description"/>
    <meta http-equiv="content-language" content="en"/>
    <meta name="language" content="en"/>
    <meta http-equiv="imagetoolbar" content="no"/>
    <link href="css/all.css" rel="stylesheet" type="text/css" media="all"/>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/all.css"/>
    <!--[if IE 8]>
    <link rel="stylesheet" type="text/css" href="css/ie8.css" media="screen"/><![endif]-->
    <!--[if gte IE 9]>
    <script type="text/javascript"> Cufon.set('engine', 'canvas'); </script> <![endif]-->
    <?php wp_head(); ?>
</head>
<body>
<div id="page">
    <div id="header">
        <div class="top">
            <a href="#" id="logo"></a>

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