<form name="post" action="" method="post" id="post">
    <div id="poststuff">

        <div class="postbox" id="testme_results_div">
            <h3 class="hndle"><span>Результаты теста</span></h3>
            <div class="inside">

<?php
// Скрипты для подгрузки
	wp_enqueue_script( 'common' );
	//wp_enqueue_script( 'jquery-color' );
	//wp_print_scripts('editor');
	if (function_exists('add_thickbox')) add_thickbox();
	wp_print_scripts('media-upload');
	//if (function_exists('wp_tiny_mce')) wp_tiny_mce();
	wp_admin_css();
	//wp_enqueue_script('utils');
	do_action("admin_print_styles-post-php");
	do_action('admin_print_styles');

//if ( file_exists (WP_PLUGIN_DIR.'/wp_testme/js/testme.js') ) print WP_PLUGIN_DIR.'/wp_testme/js/image-upload.js'; else print '44444444444';

include (WP_PLUGIN_DIR .'/wp_testme/testme_edit_one_res.php');

print '<p>Чтобы удалить результат, просто удалите соотвествующий символ или баллы "от" и "до".</p>';
	
    //Получаем список уже имеющихся результатов
    $testme_results = $wpdb->get_results(" SELECT * FROM " . $wpdb->prefix . "testme_results
                                                    WHERE result_test_relation = {$testme_id} ORDER BY ID");

    $i=0;
    if ($testme_results) {
        foreach ($testme_results as $result) {
            $i++;
            print "\n\n<div class='testme_result_block'>\n<p><strong>Результат {$i}:</strong></p>";

            // Буква или баллы в зависимости от типа теста
            if ($testme_test_details->test_type == 'abc')
            print "<p>Буква: <input type='text' size='3' name='result_letter[{$result->ID}]' value='{$result->result_letter}'
                                style='background-color:#e7ffe7' maxlength='1' /></p>";
            else if ($testme_test_details->test_type == '123')
            print "<p>Баллы от :
                                <input type='text' size='3' name='result_point_start[{$result->ID}]' value='{$result->result_point_start}'
                style='background-color:#e7ffe7' maxlength='3' />
                                до <input type='text' size='3' name='result_point_end[{$result->ID}]' value='{$result->result_point_end}'
                style='background-color:#e7ffe7' maxlength='3' />
                                </p>";

            //Название и прочие поля
            ?>
                <p>Заголовок результата: <input type='text' name='result_title[<?php echo $result->ID ?>]' value='<?php echo $result->result_title ?>'
                                                style='width:80%;font-weight:bold;' /></p>
				<p>Картинка: <input class="upload_image" type="text" name="result_image[<?php echo $result->ID ?>]" value="<?php echo $result->result_image ?>" style="width:500px" />
<input class="upload_image_button" type="button" value="Загрузить" /><br />						
                    Выравнивание: <select name='result_image_position[<?php echo $result->ID ?>]'>
                        <option value=''>Нет</option>
                        <option value='alignleft' <?php if ($result->result_image_position == 'alignleft') print "selected='selected'"; ?>>Слева</option>
                        <option value='aligncenter' <?php if ($result->result_image_position == 'aligncenter') print "selected='selected'"; ?>>Посередине</option>
                        <option value='alignright' <?php if ($result->result_image_position == 'alignright') print "selected='selected'"; ?>>Справа</option>
                    </select>
                </p>

                <p>Описание: <br />
                <textarea name='result_text[<?php echo $result->ID ?>]' rows='4' cols='50' style='width:100%'><?php echo $result->result_text ?></textarea></p>
                <?php
			print "\n</div>";	
            }
        }
//Для нового теста, когда еще нет результатов
else {
		
	?>
    <div class="testme_result_block">
    <p><strong>Результат 1:</strong></p>
    <p> 
    <?php if ($testme_test_details->test_type == 'abc') {?>
    Буква/Цифра</strong>: <input type="text" size="3" name="result_letter_new[]" value="" style="background-color:#e7ffe7" maxlength="1" />
    <?php } else {?>
    Баллы от : <input type="text" size="3" name="result_point_start_new[]" value="" style="background-color:#e7ffe7" maxlength="3" /> до <input type="text" size="3" name="result_point_end_new[]" value="" style="background-color:#e7ffe7" maxlength="3" />
    <?php } ?>
    </p>
	<p>Заголовок результата: <input type="text" name="result_title_new[]" value="" style="width:80%;font-weight:bold;" /></p>
	<p>Картинка: <input class="upload_image" type="text" name="result_image_new[]" value="" style="width:500px" />
<input class="upload_image_button" type="button" value="Загрузить" /><br />		
	Выравнивание: 
    <select name="result_image_position_new[]">
        <option value="">Нет</option>
        <option value="alignright">Слева</option>
        <option value="aligncenter">Посередине</option>
        <option value="alignright">Справа</option>
	</select>
    </p>
	<p>Описание: <br /> <textarea name="result_text_new[]" rows="4" cols="50" style="width:100%"></textarea></p>        
    </div>
        
<?php
}
?>
    <p class="testme_add_result"><a href="#"><strong>Добавить результат</strong></a></p>
</div></div>

		
        <p class="submit">
            <input type="hidden" name="testme_id" value="<?php echo $testme_id ?>" />
			<input type="hidden" name="testme_form_step" value="<?php echo $testme_step ?>" />
            <input type="submit" name="submit" value="Сохранить" style="font-weight: bold;" tabindex="4" />
        </p>

    </div>
</form>

<script type="text/javascript">

jQuery(document).ready(function($) {
	
	$("p.testme_add_result").click(function(){
		var rnum = $('div.testme_result_block').length + 1;
		$(this).before("<div class=\"testme_result_block\"><p><strong>Результат "+rnum+":</strong></p><p><?php if ($testme_test_details->test_type == 'abc') {?>Буква/Цифра</strong>: <input type=\"text\" size=\"3\" name=\"result_letter_new[]\" value=\"\" style=\"background-color:#e7ffe7\" maxlength=\"1\" /><?php } else {?>Баллы от : <input type=\"text\" size=\"3\" name=\"result_point_start_new[]\" value=\"\" style=\"background-color:#e7ffe7\" maxlength=\"3\" /> до <input type=\"text\" size=\"3\" name=\"result_point_end_new[]\" value=\"\" style=\"background-color:#e7ffe7\" maxlength=\"3\" /><?php } ?></p><p>Заголовок результата: <input type=\"text\" name=\"result_title_new[]\" value=\"\" style=\"width:80%;font-weight:bold;\" /></p><p>Картинка: <input class=\"upload_image\" type=\"text\" name=\"result_image_new[]\" value=\"\" style=\"width:500px\" /> <input class=\"upload_image_button\" type=\"button\" value=\"Загрузить\" /><br />Выравнивание: <select name=\"result_image_position_new[]\"><option value=\"\">Нет</option><option value=\"alignright\">Слева</option><option value=\"aligncenter\">Посередине</option><option value=\"alignright\">Справа</option></select></p><p>Описание: <br /> <textarea name=\"result_text_new[]\" rows=\"4\" cols=\"50\" style=\"width:100%\"></textarea></p></div>");
		return false;
	});		
	
jQuery('.upload_image_button').live('click',function() {
formfield = jQuery(this).prev('.upload_image');
tb_show('', 'media-upload.php?type=image&TB_iframe=true');
window.send_to_editor = function(html) {
imgurl = jQuery('img',html).attr('src');
formfield.val(imgurl);
tb_remove();
}
return false;
});	


});

</script>
