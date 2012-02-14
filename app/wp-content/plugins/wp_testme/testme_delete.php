    <h3>Удаление теста</h3>

<?php
//Удаление теста
    if (!$_GET['testme_id'] && $_POST['testme_id_for_deletion']) {
        //Получаем список вопросов к тесту
            $testme_question_ids = $wpdb->get_results(" SELECT ID FROM " . $wpdb->prefix . "testme_questions
        WHERE question_test_relation = {$_POST['testme_id_for_deletion']}");

            if ($testme_question_ids) {
                foreach ($testme_question_ids as $testme_q_id) $testme_question_ids_array[] = $testme_q_id->ID;
                $testme_question_list = implode(",", $testme_question_ids_array);
                //Удаляем ответы к этим вопросами
                $wpdb->query("DELETE FROM {$wpdb->prefix}testme_answers WHERE  answer_question_relation IN ({$testme_question_list})");
                //Удаляем вопросы
                $wpdb->query("DELETE FROM {$wpdb->prefix}testme_questions WHERE  question_test_relation = {$_POST['testme_id_for_deletion']}");
            }
        //Удаляем результаты  и статистику
        $wpdb->query("DELETE FROM {$wpdb->prefix}testme_results WHERE  result_test_relation = {$_POST['testme_id_for_deletion']}");
        $wpdb->query("DELETE FROM {$wpdb->prefix}testme_stats WHERE  stat_test_relation = {$_POST['testme_id_for_deletion']}");

        //Удаляем сам тест
        $wpdb->query("DELETE FROM {$wpdb->prefix}testme_tests WHERE  ID = {$_POST['testme_id_for_deletion']}");

        print "<div class=\"updated\"><p>Тест удален.</p></div>";
    }

//Получаем ИД теста
if (!$testme_id && $_GET['testme_id']) $testme_id = $_GET['testme_id'];
//Проверяем, есть ли строка с таким ИД
$testme_test_details = $wpdb->get_row("SELECT ID, test_name
    FROM {$wpdb->prefix}testme_tests WHERE ID = {$testme_id}");

//Если нет такого теста
if (!$testme_test_details->ID)
print "<p>Тест с данным ID не найден. Возможно, он уже удален или еще не создан.</p>
<p><a href='options-general.php?page=wp_testme/testme_edit.php'>Перейти к списку тестов</a>.</p>";
// А если есть, то редактируем его
else {
    

?>
 <p>Вы собираетесь удалить тест с ID <?php echo $testme_test_details->ID ?> <strong>"<?php echo $testme_test_details->test_name ?>"</strong>.</p>

<p>Обратите внимание, что при этом будут удалены все вопросы к этому тесту, все варианты ответов, 
все записи с результатами, а также статистика прохождения этого теста посетителями. Эти данные нельзя будет восстановить.</p>
<p>Если вы просто хотите, чтобы тест не показывался на страницах сайта, то удалите код [TESTME <?php echo $testme_test_details->ID ?>]
из соотствующей записи блога.<p>

<form name="post" action="options-general.php?page=wp_testme/testme_edit.php&task=delete" method="post" id="post">
<p>

<input type="hidden" name="testme_id_for_deletion" value="<?php echo $testme_test_details->ID ?>" />
<input type="submit" name="submit" value="Я действительно хочу удалить этот тест" style="font-weight: bold;" class="button" tabindex="4" />
</p>
</form>
<?php
}
?>