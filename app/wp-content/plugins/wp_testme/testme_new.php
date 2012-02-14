    <h3>Добавление нового теста</h3>
    
    <form name="post" action="options-general.php?page=wp_testme/testme_edit.php&task=edit&testme_id=new" method="post" id="post">
    <div id="poststuff">
        
        <div class="postbox" id="titlediv">
            <h3 class="hndle"><span>Название теста</span></h3>
            <div class="inside">
                <input type='text' name='test_name' id='title'  value='' />
        </div></div>
        
        <div id="<?php echo user_can_richedit() ? 'postdivrich' : 'postdiv'; ?>" class="postarea postbox">
            <h3 class="hndle"><span>Описание теста</span> (публикуется перед списком вопросов)</h3>
            <div class="inside">

<?php
	// conditions here
	wp_enqueue_script( 'common' );
	wp_enqueue_script( 'jquery-color' );
	wp_print_scripts('editor');
	if (function_exists('add_thickbox')) add_thickbox();
	wp_print_scripts('media-upload');
	if (function_exists('wp_tiny_mce')) wp_tiny_mce();
	wp_admin_css();
	wp_enqueue_script('utils');
	do_action("admin_print_styles-post-php");
	do_action('admin_print_styles');
?>

<?php the_editor('', 'test_description'); ?>

        </div></div>

        <div class="postbox" id="titlediv">
            <h3 class="hndle"><span>Прочие параметры</span></h3>
            <div class="inside">
            <p><input type='text' name='test_start_day' value='<?php echo date("Y-m-d") ?>' /> Дата создания или публикации теста в формате гггг-мм-дд.
            Для статистики.</p>
            <p><input name="test_only_reg" id="test_only_reg" type="checkbox"  value="1"
            <?php if (get_option("testme_access_reg")== 'yes') print 'checked="checked"'; ?> /> <label for="test_only_reg">
            Только зарегистрированные пользователи могут проходить этот тест.</label></p>
            <p><input name="test_show_points" id="test_show_points" type="checkbox"  value="1" /> <label for="test_show_points">
            Показывать пользователю, сколько именно он набрал баллов в тесте (только для тестов типа 123).</p>
        </div></div>

        <div class="postbox" id="titlediv">
            <h3 class="hndle"><span>Технические параметры (их уже нельзя будет изменить)</span></h3>
            <div class="inside">
            <p><input type='text' name='test_questions' value='10' /> Максимальное количество вопросов в тесте</p>
            <p><input type='text' name='test_answers' value='4' /> Максимальное количество ответов на каждый вопрос</p>
            <p><input type='text' name='test_results' value='4' /> Максимальное количество возможных результатов</p>
            <p><select name='test_type' style="width:60px;"><option value='123'>123</option><option value='abc'>abc</option></select>
            Тип теста. 123 - это тест, где каждому ответу присваивается некоторое колличество баллов, и результат зависит от суммы.
            Abc - это тест, где каждому ответу присваивается буква или цифра, и результат зависит от того, каких букв (цифр) больше.
            (Например, А - холерик, B - сангвиник, С - флегматик и т.д.)</p>
        </div></div>
    
    
<p class="submit">
<span id="autosave"></span>
<input type="hidden" name="testme_id" value="new" />
<input type="submit" name="submit" value="Сохранить" style="font-weight: bold;" tabindex="4" />
</p>

</div>
</form>