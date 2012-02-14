<form name="post" action="" method="post" id="post">
    <div id="poststuff">	
	
       <div class="postbox" id="testme_questions_div">
	   
            <h3 class="hndle"><span>Вопросы и варианты ответов на них</span></h3>
            <div class="inside">

    <?php
    if ($testme_test_details->test_type == 'abc') print "<p>В зеленом поле напишите букву (цифру), которая обозначит результат. Можно к одному ответу написать несколько букв, в этом случае их надо писать через запятую без пробелов. Например, <em>а,б,г</em> или <em>a,d</em> или <em>2,4,5</em>.</p>";

    elseif ($testme_test_details->test_type == '123') print "<p>В зеленом поле напишите количество баллов, которое можно получить за ответ.</p>";
	
	print "<p>Чтобы удалить вопрос или вариант ответа, просто удалите соотвествующий текст.</p>";

    //Получаем список уже имеющихся вопросов
    $testme_questions = $wpdb->get_results(" SELECT ID, question_text FROM " . $wpdb->prefix . "testme_questions
                                                    WHERE question_test_relation = {$testme_id} ORDER BY ID");
													
    $i = 0;
    if ($testme_questions) {
        foreach ($testme_questions as $question) {
            $i++;
            print "\n\n<div class='testme_question_block' id='testme_q_old-{$question->ID}'>\n<p><strong>Вопрос {$i}:</strong> <input type='text' name='question_text_old[{$question->ID}]' value='{$question->question_text}'
                                style='width:80%;font-weight:bold;' /></p>";

            //Получаем список ответов для каждого вопроса
            $testme_answers = $wpdb->get_results(" SELECT ID, answer_points, answer_text FROM " . $wpdb->prefix . "testme_answers
                                                            WHERE answer_question_relation = {$question->ID} ORDER BY ID");

            if ($testme_answers) {
                foreach ($testme_answers as $answer) {
                    print "\n<p><input type='text' size='5' name='answer_points_old[{$answer->ID}]' value='{$answer->answer_points}'
                                style='background-color:#e7ffe7' />
                                \n<input type='text' name='answer_text_old[{$answer->ID}]' value='{$answer->answer_text}'
                                style='width:60%;' /></p>";
                }
            }
			
			print "<p class='testme_add_answer_old' id='testme_add_answer-{$question->ID}'><a href='#' onclick='testme_add_answer_q_old({$question->ID});return false;' >Новый ответ</a></p>";
		print "\n</div>";
        }
		
    }

    //Если нет ни одного вопроса в таблице, то берем пустые значения
    else {
        for ($i=1; $i<= 2; $i++) {
			?>
<div class="testme_question_block" id="testme_q_new-<?php print $i; ?>"><p><strong>Вопрос <?php print $i; ?>:</strong> <input type="text" name="question_text_new[<?php print $i; ?>]" style="width:80%;font-weight:bold;" /></p><p class="testme_answer"><input type="text" size="5" name="answer_points_new[<?php print $i; ?>][]" style="background-color:#e7ffe7" /> <input type="text" name="answer_text_new[<?php print $i; ?>][]"  style="width:60%;" /></p><p class="testme_answer"><input type="text" size="5" name="answer_points_new[<?php print $i; ?>][]" style="background-color:#e7ffe7" /> <input type="text" name="answer_text_new[<?php print $i; ?>][]"  style="width:60%;" /></p> <p class="testme_add_answer"><a href="#">Новый ответ</a></p></div>
            <?php
        }
		?>


<?php        
}        
?>      
        <p class="testme_add_question"><a href="#"><strong>Добавить вопрос</strong></a></p>

    	<?php
   // }
    ?>

        </div></div>

		
        <p class="submit">
            <input type="hidden" name="testme_id" value="<?php echo $testme_id ?>" />
			<input type="hidden" name="testme_form_step" value="<?php echo $testme_step ?>" />
            <input type="submit" name="submit" value="Сохранить" style="font-weight: bold;" tabindex="4" />
        </p>

    </div>
</form>

<script type="text/javascript">

function testme_add_answer_q_old(q_id) {
		var anum = jQuery("#testme_q_old-"+q_id+" p.testme_answer_for_old").length + 1;
		jQuery("#testme_add_answer-"+q_id).before("<p class=\"testme_answer_for_old\"><input type='text' size='5' name='answer_points_for_old["+q_id+"]["+anum+"]' style='background-color:#e7ffe7' /> <input type='text' name='answer_text_for_old["+q_id+"]["+anum+"]'  style='width:60%;' /></p>");
		//$('div.testme_question_block:eq(0)').css('border','3px solid black');
		//alert("#testme_add_answer-"+q_id+" "+anum);
		return false;
}

jQuery(document).ready(function($) {

	$("p.testme_add_question").click(function(){
		var qnum = $('div.testme_question_block').length + 1;
		$(this).before("<div class=\"testme_question_block\" id=\"testme_q_new-"+qnum+"\"><p><strong>Вопрос "+qnum+":</strong> <input type=\"text\" name=\"question_text_new["+qnum+"]\" style=\"width:80%;font-weight:bold;\" /></p><p class=\"testme_answer\"><input type=\"text\" size=\"5\" name=\"answer_points_new["+qnum+"][]\" style=\"background-color:#e7ffe7\" /> <input type=\"text\" name=\"answer_text_new["+qnum+"][]\"  style=\"width:60%;\" /></p><p class=\"testme_answer\"><input type=\"text\" size=\"5\" name=\"answer_points_new["+qnum+"][]\" style=\"background-color:#e7ffe7\" /> <input type=\"text\" name=\"answer_text_new["+qnum+"][]\"  style=\"width:60%;\" /></p> <p class=\"testme_add_answer\"><a href=\"#\">Новый ответ</a></p></div>");
		return false;
	});	
	
	
	$("p.testme_add_answer").live('click', function (){
		var anum = $(this).parent('div.testme_question_block').index('div.testme_question_block')+1;
		//$(this).parent('div.testme_question_block').css('border','3px solid black');
		$(this).before("<p class=\"testme_answer\"><input type='text' size='5' name='answer_points_new["+anum+"][]' style='background-color:#e7ffe7' /> <input type='text' name='answer_text_new["+anum+"][]'  style='width:60%;' /></p>");
		//$('div.testme_question_block:eq(0)').css('border','3px solid black');
		//alert(anum);
		return false;
	});	
		

});

</script>
