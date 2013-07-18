$(function () {
    $('.restore-open-button').click(function () {
        $('#login_form, #restore_success_form').hide();
        $('#restore_form').show();
        return false;
    });

    $('.login-open-button').click(function () {
        $('#login_form').show();
        $('#restore_form, #register_form, #restore_success_form').hide();
        return false;
    });

    $('.register-open-button').click(function () {
        $('#restore_form, #login_form, #restore_success_form').hide();
        $('#register_form').show();
        return false;
    });



    $('#login_form input[type=submit]').click(function () {

        var email = $('#login_form input[name=login]').val();
        var password = $('#login_form input[name=password]').val();

        if (email.length > 0 && password.length > 0) {

            $.post('/login', {email:email, password:password}, function (data) {
                data = jQuery.parseJSON(data);
                if (data.success) {
                    document.location.href = data.url;
                }
                else {
                    alert('Ошибка авторизации');
                }
            });

        }

        return false;
    });

    $('#register_form input[type=submit]').click(function () {

        $('.phone-row').find('.input').removeClass('error');

       /* if ($('.phone-row .input2').val().length < 3) {
            $('.phone-row .input2').addClass('error');
        }

        $('.phone-row .input3').each(function () {
            if ($(this).val().length < 2) {
                $(this).addClass('error');
            }
        });*/

        return $('.phone-row .input.error').length == 0;
    });

    $('#restore_form input[type=submit]').click(function () {

        var email = $('#restore_form input[name=email]').val();

        $.post('/restore', {email:email}, function (data) {
            if (data == 1) {
                $('#restore_form').hide();
                $('#restore_success_form').show();
            }
            else {
                alert('Данного емейла не существует');
            }
        });

        return false;
    });
});