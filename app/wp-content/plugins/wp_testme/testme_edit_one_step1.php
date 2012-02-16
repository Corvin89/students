<form name="post" action="" method="post" id="post">
    <div id="poststuff">

        <div class="postbox" id="testme_title_div">
            <h3 class="hndle"><span>Название теста</span></h3>
            <div class="inside">
                <input type='text' name='test_name' class='testme_title'  value='<?php echo $testme_test_details->test_name ?>' />
            </div></div>

        <div class="postbox">
            <h3 class="hndle"><span>Описание теста</span> (публикуется перед списком вопросов)</h3>
            <div class="inside">
                <p>Небольшое описание теста и картинка.</p>

                <?php
                // conditions here
                wp_enqueue_script('common');
                wp_enqueue_script('jquery-color');
                wp_print_scripts('editor');
                if (function_exists('add_thickbox'))
                    add_thickbox();
                wp_print_scripts('media-upload');
                if (function_exists('wp_tiny_mce'))
                    wp_tiny_mce();
                wp_admin_css();
                wp_enqueue_script('utils');
                do_action("admin_print_styles-post-php");
                do_action('admin_print_styles');
                ?>

<?php the_editor($testme_test_details->test_description, 'test_description'); ?>

            </div></div>


        <div class="postbox" id="titlediv">
            <h3 class="hndle"><span>Тип теста (выбирайте внимательно)</span></h3>
            <div class="inside">
                <p><input type="radio" name="test_type" value="abc" id="testme_abc" <?php if ($testme_test_details->test_type == 'abc')
    print 'checked="checked"'; ?> /> <label for="testme_abc"><strong>Абв</strong> - тест, где каждому ответу присваивается буква или цифра, и результат зависит от того, каких букв (цифр) будет больше среди ответов. (Например, А - холерик, Б - сангвиник, В - флегматик и т.д.) Подходит к тестам типа "Кто ты".</label></p>
                <p><input type="radio" name="test_type" value="123" id="testme_123" <?php if ($testme_test_details->test_type == '123')
    print 'checked="checked"'; ?> /> <label for="testme_123"><strong>123</strong> - тест, где каждому ответу присваивается некоторое колличество баллов, и результат зависит от суммы. Этот тип теста подходит к тестам, нде надо измерить степень какого-то качества, например "Насколько ты ревнива" или "Ты смелая или стеснительная".</label></p>

            </div></div>	


        <div class="postbox" id="testme_params_div">
            <h3 class="hndle"><span>Параметры теста</span></h3>
            <div class="inside">		

                <p><input name="test_only_reg" id="test_only_reg" type="checkbox"  value="1"
                    <?php if ($testme_test_details->test_only_reg == 1)
                        print 'checked="checked"'; ?>
                          /> <label for="test_only_reg">
                        Только зарегистрированные пользователи могут проходить этот тест.</label></p>
                <p><input name="test_random_questions" id="test_random_questions" type="checkbox"  value="1"
<?php if ($testme_test_details->test_random_questions == 1)
    print 'checked="checked"'; ?>
                          /> <label for="test_random_questions">
                        Выводить вопросы теста в случайном порядке.</label></p>			
                <p><input name="test_random_answers" id="test_random_answers" type="checkbox"  value="1"
<?php if ($testme_test_details->test_random_answers == 1)
    print 'checked="checked"'; ?>
                          /> <label for="test_random_answers">
                        Выводить ответы к вопросам в случайном порядке.</label></p>	

                <p><input name="test_show_points" id="test_show_points" type="checkbox"  value="1"
<?php if ($testme_test_details->test_show_points == 1)
    print 'checked="checked"'; ?>
                          /> <label for="test_show_points">
                        Показывать пользователю, сколько именно он набрал баллов в тесте. (Только для тестов 123.)</p>			

            </div></div>	


        <p class="submit">
            <input type="hidden" name="testme_id" value="<?php echo $testme_id ?>" />
            <input type="hidden" name="testme_form_step" value="<?php echo $testme_step ?>" />
            <input type="submit" name="submit" value="Сохранить" style="font-weight: bold;" tabindex="4" />
        </p>	

    </div>
</form>
