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
<!--        --><?php //wp_nav_menu($args = array(
//            'menu' => 'Top',
//            'container' => 'div',
//            'container_class' => 'fgmenu',
//            'menu_class' => '',
//            'menu_id' => '',
//            'echo' => true,
//            'fallback_cb' => 'wp_page_menu',
//            'depth' => 0,
//        )
//    );?>
        <div class="menu">

            <ul>
                <li><a href="#"><span>Главная</span></a></li>
                <li><a href="#"><span>О нас</span></a></li>
                <li class="activ"><a href="#"><span>База  идей</span></a>

                    <div class="submenu">
                        <ul>
                            <li><a href="#">Eco & Sustainability</a></li>
                            <li><a href="#">Eco & Sustainability</a></li>
                            <li><a href="#">Eco & Sustainability</a></li>
                            <li><a href="#">Eco & Sustainability</a></li>
                        </ul>
                        <div class="bottom"></div>
                    </div>
                </li>
                <li><a href="#"><span>Новости</span></a></li>
                <li><a href="#"><span>Контакты</span></a></li>
            </ul>
            <form action="" method="post">
                <div class="serc">
                    <input type="text" class="text" value="Поиск по сайту"/>
                    <input type="submit" class="sub" value=""/>
                </div>
            </form>
        </div>
    </div>