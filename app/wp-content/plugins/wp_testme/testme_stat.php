<div class="wrap">
    <h3>Статистика тестов</h3>

    <?php
    global $current_user;

// Статистика 1 теста
    if (isset($_GET['testme_id'])) {

//Получаем ИД теста
        $testme_id = $_GET['testme_id'];
//Проверяем, есть ли строка с таким ИД
        $testme_query = "SELECT t.ID, test_name, DATE_FORMAT(test_start_day,GET_FORMAT(DATE,'EUR')) AS test_start_day, test_user, test_status, test_post, display_name, guid, post_status, test_done, p.comment_count
	FROM {$wpdb->prefix}users AS u, {$wpdb->prefix}testme_tests AS t 
        LEFT JOIN test__posts AS p ON p.ID = t.test_post
        WHERE u.ID = t.test_user AND t.ID = {$testme_id}
	";

        $testme_test_stat = $wpdb->get_row($testme_query);

//Если нет такого теста
        if (!isset($testme_test_stat->ID) || ($testme_test_stat->test_user != $current_user->ID && !current_user_can('edit_others_posts') ))
            print "Теста с таким ID не найдено, либо статистика для него еще недоступна.";
// А если есть, то выводим статистику
        else {
            print '<p>Статистика для теста с ID: ' . $_GET['testme_id'] . '</p>';
            print '<h3>' . $testme_test_stat->test_name . '</h3>';


            print '<p>';
            if ($testme_test_stat->post_status == 'publish')
                print '<a href="' . $testme_test_stat->guid . '" target="_blank">Запись с тестом</a>.<br />';
            else
                print 'Тест еще не опубликован<br />';
            print '<strong>' . $testme_test_stat->test_start_day . '</strong> - дата создания.<br />';
            print '<strong>' . $testme_test_stat->test_done . '</strong> раз прошли тест.<br />';
            if ($testme_test_stat->comment_count >0 )$testme_comment_count = $testme_test_stat->comment_count;
            else $testme_comment_count = 0;
            print '<strong>' . $testme_comment_count . '</strong> комментариев.<br />';
            print '</p>';
        }

// Статистика прохождений
        if (get_option('testme_stat_allow') == 'yes') {
            
            // Получаем кол-во прохождений по статистике
           $testme_stat_done = $wpdb->get_var("SELECT COUNT(Id) 
                FROM " . $wpdb->prefix . "testme_stats 
                WHERE stat_test_relation = " . $testme_id . "");
            
            //Получаем данные по ответам:
            $testme_stats = $wpdb->get_results(" SELECT result_title, result_text, result_image , COUNT(" . $wpdb->prefix . "testme_stats.Id) AS NUM
FROM " . $wpdb->prefix . "testme_results
LEFT JOIN " . $wpdb->prefix . "testme_stats ON " . $wpdb->prefix . "testme_results.Id = " . $wpdb->prefix . "testme_stats.stat_result
WHERE " . $wpdb->prefix . "testme_results.result_test_relation = " . $testme_id . "
GROUP BY " . $wpdb->prefix . "testme_results.Id
ORDER BY " . $wpdb->prefix . "testme_results.Id");

            // Если тест существует
            if ($testme_stats) {
                ?>
                <table class="widefat" style="width:600px;">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align:right; width:320px">Вариант ответа</th>
                            <th scope="col" style="text-align:center; width:40px;">##</th>
                            <th scope="col" style="width:200px">График</th>
                            <th scope="col" style="width:40px">%</th>
                        </tr>
                    </thead>
                    <tbody id="the-list">
                        <?php
// массив с цветами для графиков:
                        $testme_colors = array('#f59fbc', '#8dcff4', '#facd8a', '#a4e0b7', '#c8a46d', '#c0bfe4', '#fff99d', '#77cbac', '#bc515f', '#43b7e5');

                        $i = 0;
                        foreach ($testme_stats as $stat) {

                            //выбираем, что печатать в заголовке...
                            if ($stat->result_title != '')
                                $testme_title = $stat->result_title;
                            else if ($stat->result_text != '') {
                                if (function_exists(mb_strtolower))
                                    $testme_title = mb_substr($stat->result_text, 0, 70) . " ...";
                                else
                                    $testme_title = substr($stat->result_text, 0, 70) . " ...";
                            }
                            else
                                $testme_title = "<img src=\"" . $stat->result_image . "\" alt=\"\" />";

                            //Если тест уже проходили хотя бы 1 раз
                            if ($testme_stat_done > 0) {
                                $testme_percent = round($stat->NUM * 100 / $testme_stat_done);
                                $testme_graph_width = 180 * $testme_percent / 100 + 5;
                            }
                            // и если еще ни разу не проходили
                            else {
                                $testme_percent = "-";
                                $testme_graph_width = 5;
                            }
                               $class= '';
                            $class = ('alternate' == $class) ? '' : 'alternate';
                            print "<tr class='$class'>\n";
                            print "<td style=\"text-align:right;\">{$testme_title}</td>";
                            print "<td style=\"text-align:center;\">{$stat->NUM}</td>";
                            print "<td style=\"vertical-align:middle;\"><div style=\"width:" . $testme_graph_width . "px; height:10px; background-color:" . $testme_colors[$i] . ";\"></div></td>";
                            print "<td>" . $testme_percent . "%</td>";
                            print "</tr>";

                            $i++;
                            if ($i > 9)
                                $i = 0;
                        }
                        unset($i);
                        ?>
                    </tbody>
                </table>

                <h3>Статистика по пользователям</h3>

                <table class="widefat" style="width:600px;">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align:right; width:30px">№</th>
                            <th scope="col" style="text-align:center; width:350px;">Пользователь</th>
                            <th scope="col" style="text-align:center; width:60px">Итог</th>
                            <th scope="col" style="text-align:center; width:160px">Дата</th>
                        </tr>
                    </thead>
                    <tbody id="the-list">
                        <?php
// Получаем N последних прошедших
                        $testme_limit = get_option("testme_stat_per_page");
                        if (!$testme_limit || $testme_limit < 1)
                            $testme_limit = 10;

                        $testme_stats_2 = $wpdb->get_results(" 
SELECT stat_time, stat_result, stat_user, stat_ip, stat_points, display_name
FROM " . $wpdb->prefix . "testme_stats
LEFT JOIN " . $wpdb->prefix . "users ON " . $wpdb->prefix . "testme_stats.stat_user = " . $wpdb->prefix . "users.ID
WHERE " . $wpdb->prefix . "testme_stats.stat_test_relation = " . $testme_id . "
ORDER BY stat_time DESC LIMIT " . $testme_limit);

                        if ($testme_stats_2) {
                            $i = 0;
                            foreach ($testme_stats_2 as $stat) {
                                $i++;
// Получаем имя пользователя
                                if ($stat->stat_user > 0 && $stat->display_name != "")
                                    $testme_user = '<a href="user-edit.php?user_id=' . $stat->stat_user . '">' . $stat->display_name . '</a>';
                                else
                                    $testme_user = 'Гость (IP: ' . $stat->stat_ip . ')';
                                $class = ('alternate' == $class) ? '' : 'alternate';
                                print "<tr class='$class'>\n";
                                print "<td style=\"text-align:right;\">{$i}</td>";
                                print "<td style=\"text-align:left;\">{$testme_user}</td>";
                                print "<td style=\"text-align:center;\">{$stat->stat_points}</td>";
                                print "<td>{$stat->stat_time}</td>";
                                print "</tr>";
                            }
                            unset($i);
                        }
                        ?>
                    </tbody>
                </table>

                <?php
            }
        }
        ?>

        <p><a href="?page=testme-edit">Вернуться к таблице со списком тестов.</a></p>

    <?php } ?>

</div>
