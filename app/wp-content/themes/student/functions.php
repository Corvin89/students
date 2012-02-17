<?php

session_start();
// Load main options panel file
require_once "functions/admin-menu.php";

function hls_set_query() {
    $query  = attribute_escape(get_search_query());

    if(strlen($query) > 0){
        echo '
      <script type="text/javascript">
        var hls_query  = "'.$query.'";
      </script>
    ';
    }
}

function hls_init_jquery() {
    wp_enqueue_script('jquery');
}

add_action('init', 'hls_init_jquery');
add_action('wp_print_scripts', 'hls_set_query');

function kama_excerpt($args=''){
    global $post;
    if(is_array($args)){
        $i=$args;
    } else {
        parse_str($args, $i);
    }

    $maxchar     = isset($i['maxchar']) ?  (int)trim($i['maxchar'])     : 350;
    $text        = isset($i['text']) ?          trim($i['text'])        : '';
    $save_format = isset($i['save_format']) ?   trim($i['save_format'])         : false;
    $echo        = isset($i['echo']) ?          false                   : true;
    $out = '';
    if (!$text){
        $out = $post->post_excerpt ? $post->post_excerpt : $post->post_content;
        $out = preg_replace ("!\[/?.*\]!U", '', $out ); //убираем шоткоды, например:[singlepic id=3]
        //для тега <!--more-->
        if( !$post->post_excerpt && strpos($post->post_content, '<!--more-->') ){

            $out = str_replace("\r", '', trim($match[1], "\n"));
            $out = preg_replace( "!\n\n+!s", "</p><p>", $out );
            $out = "<p>". str_replace( "\n", "<br />", $out ) ."</p>";
            if ($echo)
                return print $out;
            return $out;
        }
    }

    $out = $text.$out;
    if (!$post->post_excerpt)
        $out =$out;

    if ( iconv_strlen($out, 'utf-8') > $maxchar ){
        $out = iconv_substr( $out, 0, $maxchar, 'utf-8' );
        $out = preg_replace('@(.*)\s[^\s]*$@s', '\\1 ...', $out); //убираем последнее слово, ибо оно в 99% случаев неполное
    }

    if($save_format){
        $out = str_replace( "\r", '', $out );
        $out = preg_replace( "!\n\n+!", "</p><p>", $out );
        $out = "<p>". str_replace ( "\n", "<br />", trim($out) ) ."</p>";
    }

    if($echo) return print $out;
    return $out;
}

add_theme_support('post-thumbnails');

if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
}

function the_thumbnail_src() {
    $image_url = wp_get_attachment_image_src( get_post_thumbnail_id() );
    echo $image_url[0];
}

if ( function_exists('register_sidebar') )
    register_sidebar();

if ( function_exists('register_sidebar') ){
register_sidebar(array(
    'name' => 'Подписка',
    'id' => 'subscribe-sidebar',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<div class="top-orang">',
    'after_title' => '</div>',
));
}

add_theme_support( 'menu' );

register_nav_menus(array(
    'head_menu' => 'Верхнее меню',            //Название месторасположения меню в шаблоне
    'bottom' => 'Нижнее меню'   //Название другого месторасположения меню в шаблоне
));

function head_menu()
{
    echo '<ul class="nav">';

    $menu_loc = 'head_menu';
    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_loc ] ) )
    {
        $menu = wp_get_nav_menu_object( $locations[ $menu_loc ] );
        $n = 0;
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        $last_item = count($menu_items);
        foreach($menu_items as $key=>$first_menu)
        {

            if($first_menu->menu_item_parent == 0)
            {
                print '<li ';
                if($n+1 == $last_item) print 'class="last-item"';
                $item_parent = 0;
                foreach($menu_items as $key1=>$sec_lvl)
                {
                    if($sec_lvl->menu_item_parent==$first_menu->ID)
                    {
                        $item_parent++;
                        if($item_parent == 1)print 'class="nav-level"';
                    }
                }


                print '><a href="'.$first_menu->url.'">'.$first_menu->title.'</a>';
                $n++;
                $i=0;
                foreach($menu_items as $key1=>$sec_lvl)
                {
                    if($sec_lvl->menu_item_parent==$first_menu->ID)
                    { $i++;
                        if ($i == 1)
                        {
                            print '<div class="submenu"><ul>';
                        }

                        print '<li><a href="'.$sec_lvl->url.'">'.$sec_lvl->title.'</a></li>';
                    }
                }
                if($i!=0)
                {
                    print '</ul>
<div class="bottom"></div>
</div>';
                }

                print '</li>';
            }
        }
    }

    echo '</ul>';
}

require_once "functions/opengraph.php";
require_once "functions/comments.php";
require_once "functions/like.php";
error_reporting(5);
