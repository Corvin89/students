<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="wrap">
    <h2>Настройки для тестов</h2>

    <?php
//Обработка заказза
    if (isset($_POST['testme_modify_options']) && $_POST['testme_modify_options']) {

        // Нулевые
        if (!isset($_POST['testme_show_test_title']))
            $_POST['testme_show_test_title'] = 'no';
        if (!isset($_POST['testme_show_test_description']))
            $_POST['testme_show_test_description'] = 'no';
        if (!isset($_POST['testme_show_results_notice']))
            $_POST['testme_show_results_notice'] = 'no';
        if (!isset($_POST['testme_code_for_forum']))
            $_POST['testme_code_for_forum'] = 'no';
        if (!isset($_POST['testme_code_for_blog']))
            $_POST['testme_code_for_blog'] = 'no';
        if (!isset($_POST['testme_access_reg']))
            $_POST['testme_access_reg'] = 'no';
        if (!isset($_POST['testme_stat_allow']))
            $_POST['testme_stat_allow'] = 'no';

        // set the post formatting options
        update_option('testme_show_test_title', $_POST['testme_show_test_title']);
        update_option('testme_show_test_description', $_POST['testme_show_test_description']);
        update_option('testme_show_results_notice', $_POST['testme_show_results_notice']);
        update_option('testme_notice_before_results', $_POST['testme_notice_before_results']);
        update_option('testme_code_for_forum', $_POST['testme_code_for_forum']);
        update_option('testme_code_for_blog', $_POST['testme_code_for_blog']);
        update_option('testme_edit_category', $_POST['testme_edit_category']);
        update_option('testme_edit_per_page', $_POST['testme_edit_per_page']);
        update_option('testme_stat_per_page', $_POST['testme_stat_per_page']);
        update_option('testme_stat_allow', $_POST['testme_stat_allow']);
        update_option('testme_access_reg', $_POST['testme_access_reg']);
        update_option('testme_notice_not_reg', $_POST['testme_notice_not_reg']);
        update_option('testme_notice_got_points', $_POST['testme_notice_got_points']);
        update_option('testme_rcode', $_POST['testme_rcode']);
        echo '<div class="updated"><p>Настройки обновлены.</p></div>';
    }
    ?>


    <form action="" method="post">
        <table class="widefat" style="width:600px;">
            <thead>
                <tr>
                    <th scope="col">Параметры тестов</th>
                </tr>
            </thead>
            <tbody id="the-list">
                <tr>
                    <td>
                        <p><input name="testme_show_test_title" type="checkbox"  id="testme_show_test_title" value="yes"
<?php if (get_option("testme_show_test_title") == 'yes')
    print "checked"; ?> />
                            <label for="testme_show_test_title">Показывать заголовок теста перед списком вопросов</label></p>
                        <p><input name="testme_show_test_description" type="checkbox"  id="testme_show_test_description" value="yes"
<?php if (get_option("testme_show_test_description") == 'yes')
    print "checked"; ?> />
                            <label for="testme_show_test_description">Показывать описание теста перед списком вопросов</label></p>
                    </td>
                </tr>

                <tr class="alternate">
                    <td>
                        <p><input name="testme_show_results_notice" type="checkbox"  id="testme_show_results_notice" value="yes"
<?php if (get_option("testme_show_results_notice") == 'yes')
    print "checked"; ?> />
                            <label for="testme_show_results_notice">Показывать надпись "Результаты теста:" (или иную) перед результатами теста</label></p>
                        <p><input name="testme_notice_before_results" type="text"  id="testme_notice_before_results"
                                  value="<?php echo get_option("testme_notice_before_results") ?>" />
                            <label for="testme_notice_before_results">Надпись, которая выводится перед результатами теста</label></p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <p><input name="testme_code_for_forum" type="checkbox"  id="testme_code_for_forum" value="yes"
<?php if (get_option("testme_code_for_forum") == 'yes')
    print "checked"; ?> />
                            <label for="testme_code_for_forum">Показывать код для форума после результатов теста.</label></p>
                        <p><input name="testme_code_for_blog" type="checkbox"  id="testme_code_for_blog" value="yes"
<?php if (get_option("testme_code_for_blog") == 'yes')
    print "checked"; ?> />
                            <label for="testme_code_for_blog">Показывать HTML-код для блогов после результатов теста.</label></p>
                    </td>
                </tr>

                <tr class="alternate">
                    <td>
                        <p><input name="testme_edit_category" type="text"  id="testme_edit_category"
                                  value="<?php echo get_option("testme_edit_category") ?>" size="3" />
                            <label for="testme_edit_category">Номер рубрики по умолчанию.</label></p>
                        <p><input name="testme_edit_per_page" type="text"  id="testme_edit_per_page"
                                  value="<?php echo get_option("testme_edit_per_page") ?>" size="3" />
                            <label for="testme_edit_per_page">Количество тестов на одной странице в панеле управления тестами.</label></p>
                        <p><input name="testme_stat_allow" type="checkbox"  id="testme_stat_allow" value="yes"
                                  <?php if (get_option("testme_stat_allow") == 'yes')
                                      print "checked"; ?> />
                            <label for="testme_stat_allow">Включить подсчет поименной статистики прохождений.</label></p>		
                        <p><input name="testme_stat_per_page" type="text"  id="testme_stat_per_page"
                                  value="<?php echo get_option("testme_stat_per_page") ?>" size="3" />
                            <label for="testme_stat_per_page">Количество последних прохождений в статистике тестов.</label></p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <p><input name="testme_access_reg" type="checkbox"  id="testme_access_reg" value="yes"
<?php if (get_option("testme_access_reg") == 'yes')
    print "checked"; ?> />
                            <label for="testme_access_reg">Разрешить прохождение теста только зарегистрированным пользователям
                                (можно изменить в параметрах каждого отдельного теста).</label>
                        </p>
                        <p><input name="testme_notice_not_reg" type="text"  id="testme_notice_not_reg"
                                  value="<?php echo get_option("testme_notice_not_reg") ?>" size="80" /><br />
                            <label for="testme_notice_not_reg">Надпись вместо кнопки "Отправить" для незарегистрированных пользователей,
                                если им нет доступа к тесту.</label></p>
                    </td>
                </tr>

                <tr class="alternate">
                    <td>
                        <p><input name="testme_notice_got_points" type="text"  id="testme_notice_got_points"
                                  value="<?php echo get_option("testme_notice_got_points") ?>" size="80" /><br />
                            <label for="testme_notice_got_points">Надпись, которая говорит пользователю, сколько баллов он набрал в тесте.</label><br />
                            Можно использовать следующие сокращения:<br />
                            %got% - количество баллов за тест у пользователя,<br />
                            %total% - максимальное количество баллов за тест,<br />
                            %балл%, %ответ%, %вопрос% - данные слова в нужном падеже в зависимости от количества баллов, набранных пользователем.<br />
                            (Например, <em>Вы ответили правильно на %got% %вопрос%</em> = <em>Вы ответили правильно на 4 вопроса</em>.)</p>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <p><input <?php if (testme_rcheck (get_option("testme_rcode"))) echo 'style="background:#e7f8cc"'; else echo 'style="background:#fee8ef"'; ?> name="testme_rcode" type="text"  id="testme_rcode"
                                  value="<?php echo get_option("testme_rcode") ?>" />
                            <label for="testme_rcode">Код для отключения ссылки. (Получить код можно по адресу forregs@yandex.ru)</label></p>
                    </td>
                </tr>                   

                <tr>
                    <td><input type="submit" name="testme_modify_options" value="Внести изменения" class="button" /></td>
                </tr>
            </tbody>
        </table>


    </form>


</div>