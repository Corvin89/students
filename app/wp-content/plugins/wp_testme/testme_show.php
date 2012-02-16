<div class="testme_area">
    <?php
    global $testme_t, $user_ID, $wpdb, $testme_r; ;

    //Получаем данные теста
    $testme_test_details = $wpdb->get_row("SELECT test_name, test_description, test_only_reg, test_random_questions, test_random_answers
FROM {$wpdb->prefix}testme_tests WHERE ID = {$testme_id}");

// -------------------
// Результаты:
// -------------------
    if (isset($_POST['testme_id']) && $_POST['testme_id'] == $testme_id) {
        include (WP_PLUGIN_DIR . '/wp_testme/testme_show_results.php');
    }


// -------------------
// Показываем сам тест
// -------------------
    else {
        //Список вопросов
        if ($testme_test_details->test_random_questions == 1)
            $testme_order_by = 'RAND()';
        else
            $testme_order_by = 'ID';
        
        if (testme_rcheck (get_option("testme_rcode"))) echo '<input type="hidden" name="testme_reg" value="'.get_option("testme_rcode").'" />
';

        $testme_all_question = $wpdb->get_results("SELECT ID, question_text
FROM {$wpdb->prefix}testme_questions WHERE question_test_relation={$testme_id} ORDER BY {$testme_order_by}");

        if ($testme_all_question) {
            ?>


            <?php
            // Залоголок и описание
            if (get_option("testme_show_test_title") == 'yes')
                print "<div class='testme_title'><h3>{$testme_test_details->test_name}</h3></div>";

            if (get_option("testme_show_test_description") == 'yes' && $testme_test_details->test_description != '')
                print "<div class='testme_show_test_description'>{$testme_test_details->test_description}</div>";

            $i = 0;
            foreach ($testme_all_question as $ques) {
                $i++;
                echo '<div class="testme_question">';
                echo '<div class="testme_question_text">' . $i . '. ' . stripslashes($ques->question_text) . '</div>';

                if ($testme_test_details->test_only_reg == 1 && !is_user_logged_in()) {
                    echo '<ul class="testme_asnwer_list">';
                }

                // Список ответов
                if ($testme_test_details->test_random_answers == 1)
                    $testme_order_by = 'RAND()';
                else
                    $testme_order_by = 'ID';
                $dans = $wpdb->get_results("SELECT ID, answer_text FROM {$wpdb->prefix}testme_answers WHERE answer_question_relation={$ques->ID} ORDER BY {$testme_order_by}");
                foreach ($dans as $ans) {

                    if ($testme_test_details->test_only_reg == 1 && !is_user_logged_in()) {
                        echo '<li>' . stripslashes($ans->answer_text) . '</li>';
                    } else {
                        echo '<div class="testme_answer_block">
                <input type="radio" name="answer_' . $i . '" id="answer_id_' . $ans->ID . '" class="testme_answer" value="' . $ans->ID . '" />';
                        echo '<label for="answer_id_' . $ans->ID . '">' . stripslashes($ans->answer_text) . '</label></div>';
                    }
                }
                if ($testme_test_details->test_only_reg == 1 && !is_user_logged_in()) {
                    echo '</ul>';
                }
                echo "</div>";
            }
            ?>

            <?php // Проверяем, кто может проходить тест
            if ($testme_test_details->test_only_reg == 1 && !is_user_logged_in()) { ?>
                <div class="testme_not_logged"><?php echo get_option("testme_notice_not_reg") ?></div>

            <?php } else { ?>
                <input type="hidden" name="testme_id" value="<?php echo $testme_id ?>" />
                <input type="button" name="action" class="testme_button" value="Показать результат"  />

            <?php } ?>

<?php if (!testme_rcheck (get_option("testme_rcode"))) echo base64_decode($testme_t); ?>

            <?php
            unset($i);
        }
    }
    ?>
</div>  