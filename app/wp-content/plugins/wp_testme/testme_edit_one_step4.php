    <div id="poststuff">

        <div class="postbox" id="testme_results_div">
            <h3 class="hndle"><span>Публикация теста</span></h3>
            <div class="inside">
			
<?php
if ($testme_test_details->test_status == 1 ) {
print '<div class="testme_step4_status1">Внимательно еще раз проверьте все данные теста, вопросы, ответы и результаты. Если все в порядке, то внизу под тестом нажмите кнопку [Тест готов].</div>';
}
elseif ($testme_test_details->test_status == 4 ) {
print '<div class="testme_step4_status4">Тест одобрен.</div>';
}
?>
<p>Код теста: [TESTME <?php print $testme_id ?>]</p>
<p>Тип: <?php print $testme_test_details->test_type ?><br />
Только зарегистрированные пользователи могут проходить этот тест: <?php if ($testme_test_details->test_only_reg == 1) print "Да"; else print "Нет"; ?><br />
Выводить вопросы теста в случайном порядке: <?php if ($testme_test_details->test_random_questions == 1) print "Да"; else print "Нет"; ?><br />
Выводить ответы к вопросам в случайном порядке: <?php if ($testme_test_details->test_random_answers == 1) print "Да"; else print "Нет"; ?><br />
<?php if ($testme_test_details->test_type == '123') { ?>Показывать пользователю, сколько он набрал баллов в тесте: <?php if ($testme_test_details->test_show_points == 1) print "Да"; else print "Нет"; ?><?php } ?>
</p>

<p>Название: <span class="testme_4_title"><?php print $testme_test_details->test_name ?></span></p>	

<p>Описание:</p>
<div class="testme_4_desc">
	<?php print $testme_test_details->test_description ?>
</div>
<div class="testme_clear"></div>

<h3>Вопросы:</h3>

<?php

    //Список вопросов
    $testme_questions 	= $wpdb->get_results("SELECT ID, question_text FROM ".$wpdb->prefix."testme_questions WHERE question_test_relation= {$testme_id} ORDER BY ID");
	
    if ($testme_questions) {

		$i = 0;
	   foreach ($testme_questions as $ques) {
	   $i++;
        echo '<p><strong>'.$i.'. '. stripslashes($ques->question_text) . '</strong><br />';

        $testme_dans = $wpdb->get_results("SELECT ID, answer_text, answer_points FROM {$wpdb->prefix}testme_answers WHERE answer_question_relation={$ques->ID} ORDER BY ID");
		if (isset ($testme_dans)) {
        foreach ($testme_dans as $ans)             
                echo '['.$ans->answer_points.'] ' . stripslashes($ans->answer_text) . '<br />';
		}		

        echo '</p>';
		}
	}
	else print "Вопросов нет";
?>

<h3>Результаты:</h3>
<?php	
include (WP_PLUGIN_DIR .'/wp_testme/testme_edit_one_res.php');

    //Список результатов
    $testme_results = $wpdb->get_results(" SELECT * FROM " . $wpdb->prefix . "testme_results
                                                    WHERE result_test_relation = {$testme_id} ORDER BY ID");

    
    if ($testme_results) {
	
	//print_r ($testme_results);
	$i=0;
        foreach ($testme_results as $result) {
            $i++;
			print '<div class="testme_4_result">';
            //print '<p><strong>Результат '.$i.':</strong></p>';

            // Символ или баллы в зависимости от типа теста
            if ($testme_test_details->test_type == 'abc')
            print '<p>Символ: '.$result->result_letter.'';
            elseif ($testme_test_details->test_type == '123')
            print '<p>Баллы от '.$result->result_point_start.' до '.$result->result_point_end.'</p>';	

            //Название и прочие поля

			if ($result->result_title != '') print '<h4>'.$result->result_title.'</h4>';
			if ($result->result_image != '') print '<img src="'.$result->result_image.'" class="testme_'.$result->result_image_position.'" alt="'.$result->result_title.'" />';
			if ($result->result_text != '')  print "<p>".nl2br($result->result_text)."</p>";	
			print '</div><div class="testme_clear"></div>';
            
            }
        }
		else print "Результатов нет";
?>

<?php // Кнопка Тест готов для авторов теста при статусе 1 и 3
if ( ($testme_test_details->test_status == 1 || $testme_test_details->test_status == 3) && $testme_test_details->test_user == $current_user->ID ) { 

    if ($testme_questions && $testme_results) {
?>
	
        <div id="testme_step4_action_area" class="submit">
            <input type="button" id="testme_step4_ready" name="submit" value="Тест готов" style="font-weight: bold;" tabindex="4" />
        </div>


<script type="text/javascript">

jQuery(document).ready(function($) {

	$("#testme_step4_ready").click(function(){
	
	//$(current_div).find('table').addClass('row_delete');
	//alert ('ку-ку');	
	$("#testme_step4_action_area").html('<img src="<?php echo plugins_url('wp_testme/images/loading4.gif') ?>" alt="" />');
	
		jQuery.ajax({
			url: '<?php echo plugins_url('wp_testme/testme-action.php') ?>?task=testready&testme_id=<?php echo $testme_id ?>',  // указываем URL
			method: 'GET',
			success: function (html) { 
				//alert ('yes '+current_page_id);
				$("#testme_step4_action_area").html(html);
			},
			error : function () { 
				alert ('Не удалось выполнить операцию');
			}
		});


	return false;
	});		

});

</script>
<?php
	} // -- если есть и вопросы и результаты
	else { ?>
        <div id="testme_step4_action_area" class="submit">
            [Сначала добавьте вопросы и (или) результаты теста.]
        </div>		
	<?php
	}

 } // -- Конец Кнопка Тест готов для авторов теста при статусе 1 и 3


?>
</div>