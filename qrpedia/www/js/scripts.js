$(document).ajaxStart(function () {
    $('#page_ajax_loader').show();
});

$(document).ajaxComplete(function () {
    $('#page_ajax_loader').hide();
});

$(function () {

    $('.phone-row .input').live('keydown',function (event) {
        if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
            (event.keyCode == 65 && event.ctrlKey === true) ||
            (event.keyCode >= 35 && event.keyCode <= 39)) {
            return true;
        }
        else {
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();
            }
        }
    }).change(function () {
            var $row = $(this).parents('.phone-row');
            $row.find('input[type=hidden]').
                val('+7(' + $row.find('.input4').val() + ')-' + $row.find('.input2').val() + '-' + $row.find('.input31').val() + '-' + $row.find('.input32').val());
        });


    $('#advert_type_select').live('change', function () {

        var $selectedOption = $('#advert_type_select').find('option:selected');
        var selectedId = $selectedOption.val();

        $('.advert-type-block').hide();
        $('#advert_block_' + selectedId).show();

    });


    $('.gallery').find('.new-photo').live('click', function () {
        var $gallery = $(this).parents('.gallery');

        $('<input type="file" class="but" name="photos[]" title="Загрузить">').insertBefore($gallery.find('.new-photo')).customFileInput();

        return false;
    });


    $('#package_buy_submit').live('click', function () {

        var $btn = $(this);
        if ($btn.hasClass('disabled'))return false;
        $btn.addClass('disabled');

        var $loader = $btn.next();
        $loader.css('display', 'inline-block');

        var $form = $('#buy_package_form');
        var packageId = $form.find('select option:selected').val();

        $form.find('.error').hide();


        $.post('/buy_package', {id:packageId}, function (data) {
            if (data != 0) {
                $('#buy_package_form').find('.error').html(data).show();
            }
            else {
                document.location.href = '/adverts';
            }

            $btn.removeClass('disabled');
            $loader.hide();
        });

        return false;
    });


});

