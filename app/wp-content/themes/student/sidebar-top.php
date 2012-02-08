<?php
    $mail_flag = false;
    $mail = 'Напишите Ваш E-mail...';
    if (isset($_POST['subscribe'])) {
        $mail_flag = true;
        if (isset($_POST['email']) && filter_var($_POST['email'],
                FILTER_VALIDATE_EMAIL)) {
            global $wpdb;
            $query = array('email' => $_POST['email'],
                'active' => 1,
                'date' => date('Y-m-d'),
                'ip' => $_SERVER['REMOTE_ADDR']);
            $wpdb->insert($wpdb->prefix . 'subscribe2', $query, array(
                '%s', '%d', '%s', '%s'));
            $mail_flag = 'save';
        } else {
            $mail = $_POST['email'];
        }

        global $wpdb;
    }
?>
<div class="top-orang">Подпишитесь бесплатно</div>
<form action="" method="post">
    <div class="white">
        <p>Join 150,000 others: Sign up for our daily or weekly newsletters so you won't miss the latest and greatest</p>
        <script type="text/javascript">
            <?php if ($mail_flag === true) : ?>
                alert('Проверьте введенный Вами e-mail');
            <?php elseif ($mail_flag == 'save') : ?>
                alert('Вы были подписаны на рассылку!');
            <?php endif; ?>
        </script>
        <div class="email">
            <input type="text" class="text" name="email" value="<?php echo $mail; ?>" />
            <input type="submit" class="submit" name="subscribe" value="" />
        </div>
        <p><strong>Анонимность данных гарантируем!</strong></p>
    </div>
</form>