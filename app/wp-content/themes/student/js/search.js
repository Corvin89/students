jQuery(document).ready(function () {
    jQuery("#searchsubmit").click(function () {
            if (!jQuery("#s").val()) {
                alert('Введите текст');
                return false;
            }
        }
    )
})