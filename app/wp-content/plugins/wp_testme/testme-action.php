<?php

### Include wp-config.php
$wp_root = '../../..';
if (file_exists($wp_root . '/wp-load.php')) {
    require_once($wp_root . '/wp-load.php');
} else {
    require_once($wp_root . '/wp-config.php');
}

header('Content-Type: text/html; charset=utf-8');

// Нажатие кнопки "Готово"
if (isset($_GET['task']) && $_GET['task'] == 'testready' && current_user_can('manage_options')) {
    $test_start_day = date("Y-m-d");
    if ($wpdb->query("UPDATE {$wpdb->prefix}testme_tests SET test_start_day = '{$test_start_day}', test_status = 4,
	test_moder_id = '{$current_user->ID}', test_moder_time = '{$test_start_day}', test_moder_comment = ''
	WHERE ID = {$_GET['testme_id']} LIMIT 1;")) {

        // Создаем запись
        // Получаем данные из таблицы тестов
        $testme_test_details = $wpdb->get_row("SELECT test_name, test_description, test_user
			FROM {$wpdb->prefix}testme_tests WHERE ID = {$_GET['testme_id']}");
        if ($testme_test_details->test_description != '')
            $testme_exerpt = trim(strip_tags($testme_test_details->test_description));
        else
            $testme_exerpt = '';

        // Добавление записи
        $wpdb->query("INSERT INTO {$wpdb->prefix}posts (post_author, post_date, post_date_gmt, 
			post_content, post_title, post_excerpt, post_status, 
			post_modified, post_modified_gmt, guid) VALUES ('{$testme_test_details->test_user}', DATE_SUB(NOW(), INTERVAL " . get_option("gmt_offset") . " HOUR), NOW(),  
			'[TESTME {$_GET['testme_id']}]', '{$testme_test_details->test_name}', '{$testme_exerpt }', 'draft', 
			DATE_SUB(NOW(), INTERVAL " . get_option("gmt_offset") . " HOUR), NOW(), '') ;");
        $testme_post_id = $wpdb->insert_id;
        // Добавление рубрики
        $wpdb->query("INSERT INTO {$wpdb->prefix}term_relationships (object_id, term_taxonomy_id) VALUES ('{$testme_post_id}', '" . get_option("testme_edit_category") . "') ;");
        // Добавление картинки, если есть
        $testme_image = preg_match_all('/http:\/\/[a-z0-9A-Z.]+(?(?=[\/])(.*))(\.jpg|\.gif|\.png)/', $testme_test_details->test_description, $testme_image_links);
        if (isset($testme_image_links[0][0]))
            $wpdb->query("INSERT INTO {$wpdb->prefix}postmeta (post_id, meta_key, meta_value) 
			VALUES ('{$testme_post_id}', 'Image', '{$testme_image_links[0][0]}') ;");
        // Добавление номера записи в таблицу с тестом
        $wpdb->query("UPDATE {$wpdb->prefix}testme_tests SET test_post = '{$testme_post_id}'
			WHERE ID = {$_GET['testme_id']} LIMIT 1;");

        print '<div class="testme_step4_status4">Тест одобрен, соответствующая запись создана. Теперь ее надо отредактировать и опубликовать.</div>';
    }
    else
        print '<span class="testme_error">Не удалось выполнить операцию. Обновите страницу и попробуйте еще раз.</span>';
}

// Добавление нового теста
if (isset($_GET['task']) && $_GET['task'] == 'newtest' && current_user_can('manage_options')) {
    //print '<tr><td colspan="6">Новый тест. '.$_GET['testme_title'].'</td></tr>';

    $test_start_day = date("Y-m-d");
    $test_start_day_eur = date("d.m.Y");
    $wpdb->query("INSERT INTO {$wpdb->prefix}testme_tests (test_name, test_start_day, test_user)
	VALUES ('" . $_GET['testme_title'] . "', '{$test_start_day}', '{$current_user->ID}') ;");
    $testme_id = $wpdb->insert_id;

    print "<tr>\n";
    print "<td>{$testme_id}</td>";
    print "<td>" . $_GET['testme_title'] . "</td>";
    print "<td>" . $test_start_day_eur . "</td>";
    print "<td class=\"testme_admin_img_col\">";
    print "<a href=\"?page=testme-edit&amp;task=edit&amp;testme_id={$testme_id}\" title=\"Изменить\"><img src=\"" . WP_PLUGIN_URL . "/wp_testme/images/edit_16.gif\" alt=\"Изменить\" title=\"Редактировать\" /></a>";
    print "<a href=\"?page=testme-edit&amp;task=delete&amp;testme_id={$testme_id}\" title=\"Удалить\" class=\"testme_delete\"><img src=\"" . WP_PLUGIN_URL . "/wp_testme/images/del_16.gif\" alt=\"Удалить\" title=\"Удалить\" /></a><input name=\"testme_del_id\" type=\"hidden\" value=\"" . $testme_id . "\" />";
    print "<a href=\"?page=testme-edit&amp;task=edit&amp;testme_id={$testme_id}&amp;step=4\" title=\"Просмотр теста\"><img src=\"" . WP_PLUGIN_URL . "/wp_testme/images/srch_16.gif\" alt=\"Просмотр теста\" title=\"Просмотр теста\" /></a>";
    print "<img src=\"" . WP_PLUGIN_URL . "/wp_testme/images/chart_16_grey.gif\" alt=\"Статистика пока недоступна\" title=\"Статистика пока недоступна\" /></a>";
    print "</td>";
    print "<td><a href=\"profile.php\">" . $current_user->display_name . "</a></td>";
    print "<td>Черновик</td>";
    print "</tr>";
}

// Удаление теста
if (isset($_GET['task']) && $_GET['task'] == 'deltest' && current_user_can('manage_options')) {
    // Проверяем, можно ли удалить этот тест
    $testme_test_details = $wpdb->get_row("SELECT test_user, test_status, guid FROM " . $wpdb->prefix . "testme_tests t
	LEFT JOIN " . $wpdb->prefix . "posts ON " . $wpdb->prefix . "posts.ID = t.test_post 
	WHERE t.ID = {$_GET['testme_id']}");
    if ($testme_test_details) {
        if (($testme_test_details->test_user == $current_user->ID && ($testme_test_details->test_status == 1 || $testme_test_details->test_status == 3)) || (current_user_can('manage_options') && $testme_test_details->guid == '')) {
            print "ok";
            // *** Само удаление ***
            // ответы
            $wpdb->query("DELETE FROM {$wpdb->prefix}testme_answers WHERE answer_question_relation IN (SELECT q.ID from test__testme_questions q WHERE question_test_relation = {$_GET['testme_id']})");
            // вопросы
            $wpdb->query("DELETE FROM {$wpdb->prefix}testme_questions WHERE  question_test_relation = {$_GET['testme_id']}");
            // результаты 
            $wpdb->query("DELETE FROM {$wpdb->prefix}testme_results WHERE  result_test_relation = {$_GET['testme_id']}");
            // статистику
            $wpdb->query("DELETE FROM {$wpdb->prefix}testme_stats WHERE  stat_test_relation = {$_GET['testme_id']}");
            // сам тест
            $wpdb->query("DELETE FROM {$wpdb->prefix}testme_tests WHERE  ID = {$_GET['testme_id']} LIMIT 1");
        } else {
            print "У вас нет прав для удаления этого теста.";
        }
    }
    else
        print "Такого теста не существует.";
}


// Результат теста
if (isset($_GET['task']) && $_GET['task'] == 'testresults') {
    include (WP_PLUGIN_DIR . '/wp_testme/testme_show_results.php');
}

?>