<?php
//phpinfo();

global $current_user;

//Добавление нового теста
if (isset($_POST['testme_id']) && $_POST['testme_id']=='new')
{

}
//Изменение в уже существующем тесте
else if (isset($_POST['testme_id'])&& $_POST['testme_id']>0) {

// Проверяем, имеет ли пользователь право изменять этот тест
// Т.е. имеет право редактировать ИЛИ тест пользователя и еще не опубликован
$testme_test_access_data = $wpdb->get_row("SELECT test_user, test_status  FROM {$wpdb->prefix}testme_tests 
WHERE {$wpdb->prefix}testme_tests.ID = ".$_POST['testme_id']);


if ( ($testme_test_access_data->test_user == $current_user->ID && ($testme_test_access_data->test_status == 1  || $testme_test_access_data->test_status == 3 ) )  || current_user_can( 'edit_others_posts') ) {

// 1. Изменяем шапку  - название теста, описание, дату, доступ и баллы
if (isset($_POST['testme_form_step']) && $_POST['testme_form_step'] == 1) {
    if (!isset($_POST['test_name']) || trim($_POST['test_name']) == "") $test_name = "Без имени"; else $test_name = trim($_POST['test_name']);
	if (!isset ($_POST['test_only_reg'])) $_POST['test_only_reg'] = 0;
	if (!isset ($_POST['test_show_points'])) $_POST['test_show_points'] = 0;
	if (!isset ($_POST['test_random_questions'])) $_POST['test_random_questions'] = 0;
	if (!isset ($_POST['test_random_answers'])) $_POST['test_random_answers'] = 0;

    $wpdb->query("UPDATE {$wpdb->prefix}testme_tests SET test_name = '{$test_name}', test_description = '{$_POST['test_description']}',
test_only_reg = '{$_POST['test_only_reg']}', test_show_points = '{$_POST['test_show_points']}',
test_random_questions = '{$_POST['test_random_questions']}', test_random_answers = '{$_POST['test_random_answers']}', 
test_type = '{$_POST['test_type']}'
WHERE ID = {$_POST['testme_id']} ");

    print "<div class=\"updated\"><p>Изменения внесены. Вы можете продолжить редактирование параметров или перейти к шагу 2.</p></div>";
}	// -- 1.

// 2. Изменение вопросов и ответов
elseif (isset($_POST['testme_form_step']) && $_POST['testme_form_step'] == 2) {

	// Старые ответы
	if ( isset($_POST['answer_text_old']) ) {
        foreach  ($_POST['answer_text_old'] as $num=>$answer )    {
			if (trim($answer) == "") $wpdb->query("DELETE FROM {$wpdb->prefix}testme_answers WHERE ID = {$num}");
			else {
				// Получаем баллы
				if (!is_int($_POST['answer_points_old'][$num]) and function_exists('mb_strtolower') ) $points = mb_strtolower($_POST['answer_points_old'][$num]); 
				else $points = $_POST['answer_points_old'][$num];
				// Записываем новые данные
            	$wpdb->query("UPDATE {$wpdb->prefix}testme_answers SET answer_text = '{$answer}', answer_points = '{$points}' WHERE ID = {$num}");
			}
        }
	}
	// Старые вопросы
	if ( isset($_POST['question_text_old']) ) {		
        foreach  ($_POST['question_text_old'] as $num=>$question )    {
			if (trim($question) == "") {
				$wpdb->query("DELETE FROM {$wpdb->prefix}testme_answers WHERE answer_question_relation = {$num}");
				$wpdb->query("DELETE FROM {$wpdb->prefix}testme_questions WHERE ID = {$num}");
				}
            else {
				//-- новые ответы к старым вопросам
				if ( isset($_POST['answer_text_for_old'][$num]) ) {
					foreach  ($_POST['answer_text_for_old'][$num] as $a_num=>$answer )    {
						if (trim($answer) == "") { 	}
						else {
						// Получаем баллы
						if (!is_int($_POST['answer_points_for_old'][$num][$a_num]) && function_exists('mb_strtolower') ) $points = mb_strtolower($_POST['answer_points_for_old'][$num][$a_num]); 
						else $points = $_POST['answer_points_old'][$num][$a_num];
						// Записываем новые данные
						$wpdb->query("INSERT INTO {$wpdb->prefix}testme_answers (answer_text,answer_points,answer_question_relation) 
						VALUES ('{$answer}', '{$points}', '{$num}')");	
						}					
					}
				}
				// сам вопрос
				$wpdb->query("UPDATE {$wpdb->prefix}testme_questions SET question_text = '{$question}' WHERE ID = {$num}");
				}
        }
	}
	// Новые вопросы
	if (isset ($_POST['question_text_new'])) {
	
		foreach  ($_POST['question_text_new'] as $num=>$value ) {
            //вопрос
            if ($value != '') {
                $wpdb->query("INSERT INTO {$wpdb->prefix}testme_questions(question_text,question_test_relation)
    VALUES('{$value}','{$_POST['testme_id']}')");
                $testme_question_id = $wpdb->insert_id;

                // ответы
                $testme_answer_code = $_POST['answer_text_new'][$num];
				
                $testme_points_code = $_POST['answer_points_new'][$num];
                foreach ($testme_answer_code as $num_ans=>$answer_value) {
                    if ($answer_value != '') {
                        //обработка пойнтов
                                    $points = $testme_points_code[$num_ans];
                                    $points = str_replace(" ", "", $points);
                    $wpdb->query("INSERT INTO {$wpdb->prefix}testme_answers(answer_text,answer_points,answer_question_relation)
    VALUES('{$answer_value}','{$points}','{$testme_question_id}')");
                    }
                }
            }
		}	
	}
    print "<div class=\"updated\"><p>Изменения внесены. Вы можете продолжить редактирование вопросов или перейти к шагу 3.</p></div>";
	
}	// -- 2.

// 3. Изменение результатов
elseif (isset($_POST['testme_form_step']) && $_POST['testme_form_step'] == 3) {

    //-- уже бывших результатов
	if (isset ($_POST['result_letter']) || isset ($_POST['result_point_start']) ) {
 
		// Абв
		if (isset ($_POST['result_letter']) ) {
			foreach  ($_POST['result_letter'] as $num=>$value )
			if  ( (trim($value)) != '' && !($_POST['result_title'][$num] == '' && $_POST['result_image'][$num] == '' && $_POST['result_text'][$num]=='') )
            { 
			$wpdb->query("UPDATE {$wpdb->prefix}testme_results SET result_title = '{$_POST['result_title'][$num]}',
			result_text = '{$_POST['result_text'][$num]}', result_image = '{$_POST['result_image'][$num]}',
			result_image_position = '{$_POST['result_image_position'][$num]}', result_test_relation = '{$_POST['testme_id']}', 
			result_letter = '{$value}' WHERE ID = {$num}");
			}
			else {
			$wpdb->query("DELETE FROM {$wpdb->prefix}testme_results WHERE ID = {$num}");			
			}
		}
		// 123
		if (isset ($_POST['result_point_start']) ) {
			foreach  ($_POST['result_point_start'] as $num=>$value )
			if  ( (trim($value)) != '' && !($_POST['result_title'][$num] == '' && $_POST['result_image'][$num] == '' && $_POST['result_text'][$num]=='') )
            { 
			$wpdb->query("UPDATE {$wpdb->prefix}testme_results SET result_title = '{$_POST['result_title'][$num]}',
			result_text = '{$_POST['result_text'][$num]}', result_image = '{$_POST['result_image'][$num]}',
			result_image_position = '{$_POST['result_image_position'][$num]}', result_test_relation = '{$_POST['testme_id']}', 
			result_point_start = '{$value}', result_point_end = '{$_POST['result_point_end'][$num]}' WHERE ID = {$num}");
			}
			else {
			$wpdb->query("DELETE FROM {$wpdb->prefix}testme_results WHERE ID = {$num}");			
			}			
		}		
		
    }	
	

    //-- новых результатов
    if (isset ($_POST['result_letter_new']) || isset ($_POST['result_point_start_new']) ) {
 
		// Абв
		if (isset ($_POST['result_letter_new']) ) {
			foreach  ($_POST['result_letter_new'] as $num=>$value )
			if  ( (trim($value)) != '' && !($_POST['result_title_new'][$num] == '' && $_POST['result_image_new'][$num] == '' && $_POST['result_text_new'][$num]=='') )
            { 
			$wpdb->query("INSERT INTO {$wpdb->prefix}testme_results(result_title,result_text,result_image,
			result_image_position, result_test_relation, result_letter)
			VALUES('{$_POST['result_title_new'][$num]}','{$_POST['result_text_new'][$num]}','{$_POST['result_image_new'][$num]}','{$_POST['result_image_position_new'][$num]}', '{$_POST['testme_id']}', '{$value}' )");
			}
		}
		// 123
		if (isset ($_POST['result_point_start_new']) ) {
			foreach  ($_POST['result_point_start_new'] as $num=>$value )
			if  ( (trim($value)) != '' && !($_POST['result_title_new'][$num] == '' && $_POST['result_image_new'][$num] == '' && $_POST['result_text_new'][$num]=='') )
            { 
			$wpdb->query("INSERT INTO {$wpdb->prefix}testme_results(result_title,result_text,result_image,
			result_image_position, result_test_relation, result_point_start, result_point_end)
			VALUES('{$_POST['result_title_new'][$num]}','{$_POST['result_text_new'][$num]}','{$_POST['result_image_new'][$num]}','{$_POST['result_image_position_new'][$num]}', '{$_POST['testme_id']}', '{$value}',  '{$_POST['result_point_end_new'][$num]}')");
			}
		}		
		
    }
	
    print "<div class=\"updated\"><p>Изменения внесены. Вы можете продолжить редактирование результатов или перейти к шагу 4.</p></div>";	

}	// -- 3.


	} // -- конец редактирования
	
	
// Если тест на модерации
elseif ($testme_test_access_data->test_status == 2) {
	print "<p class='testme_error'>У вас нет права редактировать этот тест, так как он находится на модерации.</p>";
	}
// Если тест уже опубликован	
elseif ($testme_test_access_data->test_status == 4) {
	print "<p class='testme_error'>У вас нет права редактировать этот тест, так как он уже одобрен.</p>";
	}	
	
// Если нельзя редактировать - все остальные случаи
else {
	print "<p class='testme_error'>У вас нет права редактировать этот тест.</p>";
	}	
	
}
?>

<h3>Редактирование теста</h3>

<?php 
//Получаем ИД теста
if (!isset($testme_id) && isset($_GET['testme_id']) ) $testme_id = $_GET['testme_id'];
//Проверяем, есть ли строка с таким ИД
$testme_test_details = $wpdb->get_row("SELECT ID, test_name, test_type, test_description, test_start_day,
test_only_reg,  test_show_points, test_user, test_random_questions, test_random_answers, test_status,
test_moder_comment, DATE_FORMAT(test_moder_time,GET_FORMAT(DATE,'EUR')) AS test_moder_time
FROM {$wpdb->prefix}testme_tests WHERE ID = {$testme_id}");

//Если нет такого теста
if (!$testme_test_details->ID || ($testme_test_details->test_user != $current_user->ID  && !current_user_can( 'edit_others_posts') ) )
print "Теста с таким ID не найдено.";
// А если есть, то редактируем его
else {

    // Общая часть
	
if (isset ($_GET['step']) ) $testme_step = $_GET['step'];
else $testme_step = 1;

?>

<div class="testme_edit_menu <?php if ($testme_step == 1) print "testme_edit_menu_active"; ?>"><a href="?page=testme-edit&amp;task=edit&amp;testme_id=<?php print $testme_id; ?>">Шаг 1 - Описание</a></div>
<div class="testme_edit_menu <?php if ($testme_step == 2) print "testme_edit_menu_active"; ?>"><a href="?page=testme-edit&amp;task=edit&amp;testme_id=<?php print $testme_id; ?>&amp;step=2">Шаг 2 - Вопросы</a></div>
<div class="testme_edit_menu <?php if ($testme_step == 3) print "testme_edit_menu_active"; ?>"><a href="?page=testme-edit&amp;task=edit&amp;testme_id=<?php print $testme_id; ?>&amp;step=3">Шаг 3 - Результаты</a></div>
<div class="testme_edit_menu <?php if ($testme_step == 4) print "testme_edit_menu_active"; ?>"><a href="?page=testme-edit&amp;task=edit&amp;testme_id=<?php print $testme_id; ?>&amp;step=4">Шаг 4 - Публикация</a></div>

<div class="testme_edit_one">

<?php 
if ($testme_step == 1) include ('testme_edit_one_step1.php'); 
elseif ($testme_step == 2) include ('testme_edit_one_step2.php'); 
elseif ($testme_step == 3) include ('testme_edit_one_step3.php'); 
elseif ($testme_step == 4) include ('testme_edit_one_step4.php'); 
?>

</div>



<?php 
}
?>