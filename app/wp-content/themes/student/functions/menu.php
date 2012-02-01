<?php
add_theme_support( 'menu' );

register_nav_menus(array(
    'top' => 'Верхнее меню',            //Название месторасположения меню в шаблоне
    'bottom' => 'Нижнее меню'   //Название другого месторасположения меню в шаблоне
));

class My_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class=\"submenu\"><ul>\n";
    }
    function end_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
    }
}