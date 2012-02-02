<?php

// Load main options panel file
require_once "functions/admin-menu.php";

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

require_once "functions/menu.php";