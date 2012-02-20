jQuery(function($){
    $('#comment-form').submit(function(){
        var have_error = false,
            $form = $(this);
        var $name = $('#author', $form),
            $email = $('#email', $form),
            $comment = $('#comment', $form);

        $name.css('border', 'none');
        $email.css('border', 'none');
        $comment.css('border', 'none');
        $('.comment-error').remove();
        
        if (!$name.val()) {
            $name.css('border','2px solid red');
            $name.parent().before($('<p>Это поле не может быть пустым</p>')
                .css({'color': 'red', 'text-align': 'right',
                    'margin-right': '150px'})
                .addClass('comment-error'));
            have_error = true;
        }
        if (!$comment.val()) {
            $comment.css('border','2px solid red');
            $comment.parent().before($('<p>Это поле не может быть пустым</p>')
                .css({'color': 'red', 'text-align': 'right',
                    'margin-right': '210px'})
                .addClass('comment-error'));
            have_error = true;
        }
        if (!$email.val()) {
            $email.css('border','2px solid red');
            $email.parent().before($('<p>Это поле не может быть пустым</p>')
                .css({'color': 'red', 'text-align': 'right',
                    'margin-right': '150px'})
                .addClass('comment-error'));
            have_error = true;
        } else {
            reg = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
            if (!$email.val().match(reg)) {
                $email.css('border','2px solid red');
                $email.parent().before($('<p>Вы не правильно ввели e-mail адрес</p>')
                    .css({'color': 'red', 'text-align': 'right',
                        'margin-right': '150px'})
                    .addClass('comment-error'));
                have_error = true;
            }
        }

        if (have_error) {
            return false;
        }
    });
});

$(window).load(function(){
    if( $.isFunction($.fn.inFieldLabels) ) {
        $("div.disk label").inFieldLabels({
            fadeOpacity:0
        });
        $("div.email label").inFieldLabels({
            fadeOpacity:0
        });
    }
});
