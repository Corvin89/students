<?php
    //Определяем тип теста - 123 или abc
    $testme_test_details = $wpdb->get_row("
            SELECT p.ID, test_type, test_only_reg, test_show_points, guid, test_name, test_done, test_user
            FROM {$wpdb->prefix}testme_tests AS t, {$wpdb->prefix}posts AS p
            WHERE p.ID = t.test_post AND t.ID = '".$_GET['testme_id']."'
        ");
		
	if ( $testme_test_details->test_only_reg == 1 && !is_user_logged_in() ) {
        print '<div class="testme_not_logged">'.get_option("testme_notice_not_reg").'</div>';
        }
	else {
		// Список результатов
		$testme_where_line = substr($_GET['testme_answers'], 0, -1);
		
		// Для тестов Абв
		if ($testme_test_details->test_type == 'abc') {
		
			$testme_score_letters = $wpdb->get_results("SELECT answer_points FROM ".$wpdb->prefix . "testme_answers
				WHERE ID IN (".$testme_where_line.")
			");

			$testme_score_array = array ();

			//Получаем строку
			foreach ($testme_score_letters as $letters) {
				$testme_letters = $letters->answer_points;
				$testme_one_answer = explode(",", $testme_letters);
				$testme_score_array = array_merge($testme_score_array, $testme_one_answer);
			}

			$testme_score_array_count = array_count_values ($testme_score_array);
			arsort ($testme_score_array_count);
			$testme_score = key ($testme_score_array_count);


			//Получение результата теста
			$testme_result = $wpdb->get_row("SELECT ID, result_title, result_text, result_image, result_image_position
			FROM {$wpdb->prefix}testme_results WHERE result_test_relation = {$_GET['testme_id']}
			AND result_letter = '{$testme_score}' "); 
			
			if (!$testme_result) $testme_result_error = "Опс! Ошибка в тесте, результата не найдено.";
			
		}
		
		// Для тестов 123
		else {
			// Набрано баллов
		    $testme_score = $wpdb->get_var("
            SELECT SUM(answer_points)
            FROM ".$wpdb->prefix . "testme_answers
            WHERE ID IN (".$testme_where_line.")
			");
			
			// Результат теста
			$testme_result = $wpdb->get_row("SELECT ID, result_title, result_text, result_image, result_image_position
			FROM {$wpdb->prefix}testme_results WHERE result_test_relation = {$_GET['testme_id']}
			AND {$testme_score} >= result_point_start AND {$testme_score} <= result_point_end LIMIT 1");
			
			if (!$testme_result) $testme_result_error = "Опс! Ошибка в тесте, результата не найдено.";
			else {
			
        //Получение максимального результата, если надо
		    if ($testme_test_details->test_show_points == 1)   {

            $testme_max_score = $wpdb->get_var("SELECT SUM(max_points_temp) as max_points FROM 
			(SELECT MAX(ROUND(answer_points)) as max_points_temp FROM {$wpdb->prefix}testme_answers AS a, {$wpdb->prefix}testme_questions AS q WHERE answer_question_relation = q.ID AND q.question_test_relation = {$_GET['testme_id']} GROUP BY answer_question_relation) as pp"); 
                
            // Создаем надпись о количестве баллов
            // Функция родительного падежа и числительного
                    function Num_and_Padezh ($number, $array)
                    {
                    $last1 = substr($number, -1, 1);
                    if (strlen($number) > 1) $last2 = substr($number, -2, 1);

                    $let = array (5,6,7,8,9,0);

                    if (in_array ($last1 ,$let) ) $line = $array[0];
                    elseif ($last2 AND $last2 == 1) $line = $array[0];
                    elseif ($last1 == 1) $line = $array[1];
                    else $line = $array[2];

                    return $line;
                    }


            //Собственно, надпись
            $testme_array_ball = array ('баллов', 'балл','балла');
            $testme_array_otvet = array ('ответов', 'ответ','ответа');
            $testme_array_vopros = array ('вопросов', 'вопрос','вопроса');

			$testme_your_score_notice = '';
            $testme_your_score_notice = get_option("testme_notice_got_points");
            $testme_your_score_notice = str_replace("%got%", $testme_score, $testme_your_score_notice);
            $testme_your_score_notice = str_replace("%total%", $testme_max_score, $testme_your_score_notice);
            $testme_your_score_notice = str_replace("%балл%", Num_and_Padezh($testme_score, $testme_array_ball), $testme_your_score_notice);
            $testme_your_score_notice = str_replace("%ответ%", Num_and_Padezh($testme_score, $testme_array_otvet), $testme_your_score_notice);
            $testme_your_score_notice = str_replace("%вопрос%", Num_and_Padezh($testme_score, $testme_array_vopros), $testme_your_score_notice);
            $testme_your_score_notice = '<div class="testme_your_score">'.$testme_your_score_notice.'</div>';

			}		
			}				
		}
	


// Вывод результатов
if (isset ($testme_result_error)) print '<div class="testme_error">'.$testme_result_error.$testme_score.'</div>';
else {
?>
<div class="testme_result_block">
<?php
 if (get_option("testme_show_results_notice")== 'yes')  print '<div class="testme_before_results">'.get_option("testme_notice_before_results").'</div>'; 
    if (isset ($testme_your_score_notice)) print $testme_your_score_notice;
    if ($testme_result->result_title != '') print '<h3 class="testme_result_title">'.$testme_result->result_title.'</h3>';
    if ($testme_result->result_image != '') print '<img src="'.$testme_result->result_image.'" class="testme_result_image '.$testme_result->result_image_position.'" alt="'.$testme_result->result_title.'" />';
    if ($testme_result->result_text != '')  print '<div class="testme_result_text">'.nl2br($testme_result->result_text).'</div>';
?>
</div>
<div style="clear:both;"></div>

<?php  
	// Добавляем одно прохождение
	$testme_done = $testme_test_details->test_done +1;
	$wpdb->query("UPDATE {$wpdb->prefix}testme_tests SET test_done = '".$testme_done."' WHERE ID = {$_GET['testme_id']} ");
        
    //Добавляем данные в таблицу статистики
if (get_option('testme_stat_allow') == 'yes') {        
    $wpdb->query("INSERT INTO {$wpdb->prefix}testme_stats(stat_time, stat_result, stat_ip, stat_test_relation, stat_user, stat_points)
    VALUES (NOW(), '{$testme_result->ID}', '{$_SERVER['REMOTE_ADDR']}', '{$_GET['testme_id']}', '{$current_user->ID}', '{$testme_score}');");        
}

    //Коды для форумов и блогов
    // -- для форумов
    if (get_option("testme_code_for_forum")== 'yes') {
	?>
<div class='testme_code'><p>Код для форумов:</p>
<textarea>
Результаты теста [URL=<?php print get_permalink( $testme_test_details->ID ); ?>]<?php print $testme_test_details->test_name; ?>[/URL]
<?php
if ($testme_result->result_title != '') print "[B]{$testme_result->result_title}[/B]";
if ($testme_result->result_text != '')  print $testme_result->result_text;
if ($testme_result->result_image != '') print "[IMG]{$testme_result->result_image}[/IMG]";
?>
[URL=<?php print get_permalink( $testme_test_details->ID ); ?>]Пройти этот тест[/URL]</textarea>
</div>
		<?php
    }
    // -- для блогов
    if (get_option("testme_code_for_blog")== 'yes') {
		?>
<div class='testme_code'><p>HTML-код для блогов и страниц:</p>
<textarea>
<p>Результаты теста <a href="<?php print get_permalink( $testme_test_details->ID ); ?>"><?php print $testme_test_details->test_name; ?></a></p>
<?php
if ($testme_result->result_title != '') print "<p><strong>{$testme_result->result_title}</strong></p>";
if ($testme_result->result_text != '')  print "<p>".$testme_result->result_text."</p>";
if ($testme_result->result_image != '') print "<p><img src=\"".$testme_result->result_image."\" /></p>";
?>
<p><a href="<?php print get_permalink( $testme_test_details->ID ); ?>">Пройти этот тест</a></p></textarea>
</div>
		<?php
    }
} // -- конец вывода существующих результатов ?>

<?php
	}
?>
<p class="testme_result_close"><a href="">Закрыть результат</a></p>