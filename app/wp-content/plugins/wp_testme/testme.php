<?php

/*
  Plugin Name: TESTME - Плагин для создания тестов
  Plugin URI: http://makemoney.kalaydina.ru/archives/126
  Description: Плагин позволяет добавить тесты в записи вордпресса
  Author: Татьяна Калайдина <forregs@yandex.ru>
  Author URI: http://www.kalaydina.ru
  Version: 1.3
 */

/*  Copyright 2009  Татьяна Калайдина/Tatiana Kalaydina  (email : forregs@yandex.ru)

  Плагин TESTME распространяется бесплатно. Вы имеете полное право
  распространять его дальше или вносить любые изменения в исходный код.
  Я надеюсь, что плагин окажется полезен, но не гарантирую, что он
  полностью подойдет для ваших целей. На мне не лежит никаких обязанностей
  по дальнейшей модификации плагина с целью его наибольшего соответствия
  пожеланиям других пользователей.

 */
global $testme_current_ver;
$testme_current_ver = 1.3;

// Опции
function testme_add_options() {
    global $testme_current_ver;
    add_option('testme_show_test_title', 'no');
    add_option('testme_show_test_description', 'yes');
    add_option('testme_show_results_notice', 'yes');
    add_option('testme_notice_before_results', 'Результаты теста:');
    add_option('testme_code_for_forum', 'yes');
    add_option('testme_code_for_blog', 'yes');
    add_option('testme_edit_category', '1');
    add_option('testme_edit_per_page', '30');
    add_option('testme_stat_per_page', '10');
    add_option('testme_stat_allow', 'yes');
    add_option('testme_access_reg', 'no');
    add_option('testme_notice_not_reg', 'Только зарегистрированные пользователи могут проходить этот тест.');
    add_option('testme_notice_got_points', 'Вы набрали %got% %балл% из %total%.');
    add_option('testme_built', $testme_current_ver);
}

// Таблицы
function testme_add_tables() {
    global $wpdb;

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    $table_name = $wpdb->prefix . "testme_tests";
    $sql = "CREATE TABLE " . $table_name . " (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `test_name` varchar(250) DEFAULT 'Без имени',
  `test_type` varchar(3) NOT NULL DEFAULT '123',
  `test_done` int(10) NOT NULL DEFAULT '0',
  `test_description` text,
  `test_start_day` date DEFAULT NULL,
  `test_only_reg` tinyint(1) NOT NULL DEFAULT '0',
  `test_show_points` tinyint(1) NOT NULL DEFAULT '0',
  `test_random_questions` tinyint(1) NOT NULL DEFAULT '0',
  `test_random_answers` tinyint(1) NOT NULL DEFAULT '0',
  `test_user` bigint(20) NOT NULL DEFAULT '1',
  `test_status` tinyint(1) NOT NULL DEFAULT '1',
  `test_moder_id` int(11) NOT NULL DEFAULT '0',
  `test_moder_time` date DEFAULT NULL,
  `test_moder_comment` text,
  `test_post` bigint(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
    dbDelta($sql);

    $table_name = $wpdb->prefix . "testme_questions";
    $sql = "CREATE TABLE " . $table_name . " (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `question_text` text,
  `question_test_relation` int(10) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;";
    dbDelta($sql);

    $table_name = $wpdb->prefix . "testme_answers";
    $sql = "CREATE TABLE " . $table_name . " (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `answer_text` text,
  `answer_points` varchar(10) DEFAULT NULL,
  `answer_question_relation` int(10) DEFAULT NULL,
  PRIMARY KEY (`ID`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
    dbDelta($sql);

    $table_name = $wpdb->prefix . "testme_results";
    $sql = "CREATE TABLE " . $table_name . " (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `result_title` varchar(250) DEFAULT NULL,
  `result_text` text,
  `result_image` varchar(250) DEFAULT NULL,
  `result_image_position` varchar(100) DEFAULT NULL,
  `result_point_start` int(5) DEFAULT NULL,
  `result_point_end` int(5) DEFAULT NULL,
  `result_letter` varchar(1) DEFAULT NULL,
  `result_test_relation` int(10) DEFAULT NULL,
  PRIMARY KEY (`ID`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;";
    dbDelta($sql);

    $table_name = $wpdb->prefix . "testme_stats";
    $sql = "CREATE TABLE " . $table_name . " (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `stat_time` datetime DEFAULT NULL,
  `stat_result` varchar(5) DEFAULT NULL,
  `stat_user` bigint(20) NOT NULL DEFAULT '0',
  `stat_points` varchar(7) DEFAULT NULL,
  `stat_ip` varchar(20) DEFAULT NULL,
  `stat_test_relation` int(10) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;";
    dbDelta($sql);
}

// Активация плагина
if (function_exists('register_activation_hook')) {
    register_activation_hook(__FILE__, 'testme_add_tables');
    register_activation_hook(__FILE__, 'testme_add_options');
}

// * Апгрейд *
// 
if (isset($_GET['action']) && ($_GET['action']) == 'upgrade' && $_GET['plugin'] == basename(__FILE__) && get_option('testme_built') != $testme_current_ver) {
    testme_upgrade();
}

function testme_upgrade() {
    global $testme_current_ver;
    global $wpdb;

    //обновление опций и таблиц до версии 1.3
    add_option('testme_edit_category', '1');
    add_option('testme_stat_allow', 'yes');

    $wpdb->query("ALTER TABLE " . $wpdb->prefix . "testme_tests CHANGE `ID` `ID` INT( 10 ) NOT NULL AUTO_INCREMENT ,
        CHANGE `test_only_reg` `test_only_reg` TINYINT( 1 ) NOT NULL DEFAULT '0',
        CHANGE `test_show_points` `test_show_points` TINYINT( 1 ) NOT NULL DEFAULT '0',
        DROP `test_questions` ,
        DROP `test_answers` ,
        DROP `test_results`,
        ADD `test_random_questions` TINYINT( 1 ) NOT NULL DEFAULT '0',
        ADD `test_random_answers` tinyint(1) NOT NULL DEFAULT '0',
        ADD `test_user` bigint(20) NOT NULL DEFAULT '1',
        ADD `test_status` tinyint(1) NOT NULL DEFAULT '1',
        ADD `test_moder_id` int(11) NOT NULL DEFAULT '0',
        ADD `test_moder_time` date DEFAULT NULL,
        ADD `test_moder_comment` text,
        ADD `test_post` bigint(20) NOT NULL
        ");

    $wpdb->query("ALTER TABLE " . $wpdb->prefix . "testme_questions CHANGE `ID` `ID` INT( 10 ) NOT NULL AUTO_INCREMENT ,
        CHANGE `question_test_relation` `question_test_relation` INT( 10 ) NULL DEFAULT NULL ");
    $wpdb->query("ALTER TABLE " . $wpdb->prefix . "testme_answers CHANGE `ID` `ID` INT( 10 ) NOT NULL AUTO_INCREMENT ,
        CHANGE `answer_question_relation` `answer_question_relation` INT( 10 ) NULL DEFAULT NULL  ");
    $wpdb->query("ALTER TABLE " . $wpdb->prefix . "testme_results CHANGE `ID` `ID` INT( 10 ) NOT NULL AUTO_INCREMENT ,
        CHANGE `result_test_relation` `result_test_relation` INT( 10 ) NULL DEFAULT NULL  ");
    $wpdb->query("ALTER TABLE " . $wpdb->prefix . "testme_stats CHANGE `ID` `ID` INT( 10 ) NOT NULL AUTO_INCREMENT ,
        CHANGE `stat_test_relation` `stat_test_relation` INT( 10 ) NULL DEFAULT NULL ");

    // Link old tests to related posts and mark them as approved
    $testme_link_to_posts = $wpdb->get_results("SELECT t.ID as test_id, t.test_name, p.ID as post_id 
        FROM " . $wpdb->prefix . "testme_tests t, " . $wpdb->prefix . "posts p
        WHERE p.post_content LIKE CONCAT( '%[TESTME ', t.ID , ']%') 
        AND p.post_status IN ('publish', 'future', 'draft')");
    if ($testme_link_to_posts) {
        foreach ($testme_link_to_posts as $testme_update_test) {
            $wpdb->query("UPDATE {$wpdb->prefix}testme_tests 
            SET test_post = '{$testme_update_test->post_id}', test_status = 4
            WHERE ID = {$testme_update_test->test_id} LIMIT 1;");
        }
    }

    update_option('testme_built', $testme_current_ver);
    echo '<div class="updated"><p>Плагин TESTME обновлен.</p></div>';
}

//Добавляем ссылку для обновления в меню с плагинами, если надо
function testme_plugin_actions($links, $file) {
    $plugin_file = basename(__FILE__);
    global $testme_current_ver;

    //print "ggg:".$testme_current_ver;
    if (get_option('testme_built') != $testme_current_ver) {
        if (basename($file) == $plugin_file) {
            $settings_link = '<a href="plugins.php?plugin=' . $plugin_file . '&action=upgrade">' . __('Обновить', 'testme') . '</a>';
            array_unshift($links, $settings_link);
        }
    }
    return $links;
}

add_filter('plugin_action_links', 'testme_plugin_actions', 10, 2);





/* === Меню в панеле администратора === */

//Добавляем пункты меню
add_action('admin_menu', 'testme_menu');

function testme_menu() {

    if (function_exists('add_menu_page')) {
        add_menu_page('TESTME', 'TESTME', 'manage_options', 'testme-edit', '', WP_PLUGIN_URL . '/wp_testme/images/testme-logo.png');
    }
    if (function_exists('add_submenu_page')) {
        add_submenu_page('testme-edit', 'Тесты', 'Тесты', 'manage_options', 'testme-edit', 'testme_edit_func');
        add_submenu_page('testme-edit', 'Настройки', 'Настройки', 'manage_options', 'testme-options', 'testme_options_func');
    }
}

function testme_edit_func() {
    global $wpdb, $current_blog;
    include (WP_PLUGIN_DIR . '/wp_testme/testme_edit.php');
}

function testme_options_func() {
    global $wpdb, $current_blog;
    include (WP_PLUGIN_DIR . '/wp_testme/testme_options.php');
}

/* === Добавление таблицы стилей === */
add_action('admin_enqueue_scripts', 'testme_css_admin');

function testme_css_admin($hook_suffix) {
    global $text_direction;
    $testme_admin_pages = array('testme-edit', 'testme-new', 'testme-stat', 'testme-options');

    $testme_hook_suffix = str_replace('toplevel_page_', '', $hook_suffix);

    if (in_array($testme_hook_suffix, $testme_admin_pages)) {
        wp_enqueue_style('testme-admin', plugins_url('wp_testme/testme_style_admin.css'), false, '1.0', 'all');
    }
}

add_action('wp_head', 'testme_css_theme');

function testme_css_theme() {
    print '<link rel="stylesheet" id="testme-style-css"  href="' . plugins_url('wp_testme/testme_style.css') . '" type="text/css" media="all" /> ';
}

// jQuary in head
add_action('wp_head', 'testme_scripts_theme');

function testme_scripts_theme() {
    wp_print_scripts('jquery');
    //wp_print_scripts('testme-js', plugins_url('wp_testme/js/testme.js'), array('jquery'), '2.50', true);
    print '<script type="text/javascript" src="' . plugins_url('wp_testme/js/testme.js') . '"></script>';
}

function testme_rcheck($str) {
    if (substr(md5($_SERVER['SERVER_NAME'] . 'tk'), strpos($_SERVER['SERVER_NAME'], '.'), 7) == $str)
        return TRUE;
    else
        return FALSE;
}

// Вывод теста в записи
add_filter('the_content', 'testme_scan_content');

function testme_scan_content($body) {
    if (strpos($body, 'TESTME') !== false) {

        if (preg_match('/(<!--|\[)\s*TESTME\s*(\d+)\s*(\]|-->)/', $body, $matches)) {

            $testme_id = $matches[2];

            if (is_numeric($testme_id)) {
                ob_start();
                include (WP_PLUGIN_DIR . '/wp_testme/testme_show.php');
                $contents = ob_get_contents();
                ob_end_clean();

                $body = str_replace($matches[0], $contents, $body);
            }
        }
    }
    return $body;
}

$testme_t = 'PGRpdiBjbGFzcz0idGVzdG1lX2JhY2tsaW5rIj4mIzEwNTc7JiMxMDg3OyYjMTA4NjsmIzEwODU7JiMxMDg5OyYjMTA4NjsmIzEwODg7ICYjMTA4NzsmIzEwODM7JiMxMDcyOyYjMTA3NTsmIzEwODA7JiMxMDg1OyYjMTA3Mjs6IDxhIGhyZWY9Imh0dHA6Ly90cmlra3kucnUiIHRhcmdldD0iX2JsYW5rIiBmb2xsb3c9ImRvZm9sbG93Ij4mIzEwNTg7JiMxMDc3OyYjMTA4OTsmIzEwOTA7JiMxMDk5OyAmIzEwNzY7JiMxMDgzOyYjMTEwMzsgJiMxMDc2OyYjMTA3NzsmIzEwNzQ7JiMxMDg2OyYjMTA5NTsmIzEwNzc7JiMxMDgyOzwvYT48L2Rpdj4=';
$testme_r = 'PGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0idGVzdG1lX3JlZyIgdmFsdWU9InlvdXJfdGVzdCIgLz4=';
?>