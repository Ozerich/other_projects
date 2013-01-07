var old_parseFloat = parseFloat;
var parseFloat = function(val)
{
    return old_parseFloat(val.toString().replace(',','.'));
};

function rv(name) {
    var items = $('input[name="' + name + '"]');
    for (var i in items) {
        var item = items[i];
        if ($(item).attr('selected')) {
            return parseInt($(item).attr('value'));
        }
    }
    return -1;
}

function iv(name) {
    return $('[name="' + name + '"]').length ? ($('[name="' + name + '"]').val() ? parseFloat($('[name="' + name + '"]').val()) : '') : '';
}

function cv(name) {
    return $('[name="' + name + '"]').length && $('[name="' + name + '"]').attr('checked');
}

function val_or_zero(val) {
    return val.length > 0 ? parseFloat(val) : 0;
}

function num(val) {

    if (isNaN(val)) {
        return 0;
    }

    return val.length == 0 ? '' : Math.round(parseFloat(val));
}

$(function () {

    var calculators_enabled = [
        [1, 1, 1, 1, 1],
        [0, 1, 1, 1, 1]
    ];

    $("#pick-up").live('click', function (e) {
        $(".mode").fadeIn("slow");
        $(this).fadeOut();
        return false;
    });

    $('#step_1 .btn').click(function () {

        if ($(this).hasClass('active')) {
            return false;
        }

        var type = $(this).data('type');
        $('#step_3 h3').hide();
        $('#step_3 h3[data-type="' + type + '"]').show();

        $('#step_1 .btn').removeClass('active');
        $(this).addClass("active");

        $("#step-2").fadeIn("slow");
        $('.step-sum-list li').hide().filter('[data-type=' + type + ']').show();

        for (var i in calculators_enabled[type - 1])
            if (calculators_enabled[type - 1][i]) {
                $($('#calculators_buttons a').get(i)).removeClass('disabled');
            }
            else {
                $($('#calculators_buttons a').get(i)).addClass('disabled', 'disabled');
            }

        if ($('#step_3 h3[data-type=' + type + ']').length > 0) {
            $('#step_3 h3').hide().filter('[data-type=' + type + ']').show();
            $('#step_3').fadeIn(function () {
                $('#buttons').show()
            });

        }
        else {
            $('#step_3').fadeOut(function () {
                $('#buttons').hide()
            });
        }


        return false;
    });

    $("#step-1 .btn").live('click', function (e) {
        if ($('#step-2').is(':hidden')) {
            $(this).addClass("active");
            $("#step-2").fadeIn("slow");

            return false;
        }
        else {
            return false;
        }
    });


    /* ------------------- */

    $(".disabled").live('click', function (e) {
        return false;
    });


    $(".show").live("click", function () {
        $(this).parents("li.step").find(".calculation-block:last").slideDown("fast");
    });

    $(".hide").change(function () {
        $(this).parents("li.step").find(".calculation-block:last").slideUp("fast");
    });

    $(".show-nds").live("click", function () {
        $('#nds_yes_block').slideDown('down');
        $('#nds_no_block').slideUp("fast");
    });

    $(".hide-nds").change(function () {
        $('#nds_yes_block').slideUp('fast');
        $('#nds_no_block').slideDown("fast");
    });

    /////////////////////////////////
    // Скругления для IE
    /////////////////////////////////
    if (window.PIE) {
        $(".btn-green, .btn, .step, .step-block, .calculation-block, mark").each(function () {
            PIE.attach(this);
        });
    }


    var show_error = function (input, error) {
        $(input).addClass('error').parents('.field, label, .label').first().find('.ico-error').show().find('.error-box').html(error).
            css('visibility', 'visible').css('opacity', 1).animate({left:30});
    };

    var hide_error = function (input) {
        $(input).removeClass('error').parents('.field, label, .label').first().find('.ico-error').hide().find('.error-box').html('').css('left', '25px');
    };

    Number.prototype.formatMoney = function (c, d, t) {
        var n = this, c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    };


    $('.calculation input').keypress(function (event) {
        //var charCode = (evt.which) ? evt.which : evt.keyCode;
        var charCode = event.which ? event.which : event.keyCode;
        var theChar = String.fromCharCode(charCode)
        var val = $(this).val();

        hide_error(this);

        var error = '';

        if (event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || charCode == 46 ||
            // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) ||
            // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        else {

            if (theChar == '.' || theChar == ',') {
                if ($(this).data('float') == 1) {

                    if (val.length == 0)
                    {
                        $(this).val('0');
                        return true;
                    }

                    if(val.indexOf('.') == -1 && val.indexOf(',') == -1){
                        return true;
                    }
                    else
                    {
                        error = 'Уже есть точка';
                    }

                }
                else {
                    error = 'Вещественные числа запрещены.'
                }
            }

            else if (event.shiftKey || (theChar < '0' || theChar > '9')) {
                error = 'Ввод букв запрещен';
            }
        }

        if (!error) {
            var max_value = parseFloat($(this).data('max_value') || 1000000000);

            if (parseFloat($(this).val()) + (charCode - 48) > max_value) {
                error = 'Число не может быть больше ' + max_value.formatMoney(0, ' ', ' ');
            }
        }

        if(!error && ($(this).val().indexOf('.') != -1 || $(this).val().indexOf(',') != -1))
        {
            var pos = $(this).val().indexOf('.') != -1 ? $(this).val().indexOf('.') : $(this).val().indexOf(',');
            if($(this).val().length - pos > 3)
            {
                error = 'Не больше 3 цифр после запятой'
            }
        }

        if (error) {
            show_error(this, error);
            return false;
        }
    }).keyup(function(){
            if($(this).data('max'))
            {
                var max = $(this).data('max');
                if(parseFloat($(this).val()) > max)
                {
                    $(this).val(max);
                }
            }
        });

    $('.calculator-link').click(function () {
        $(this).attr('href', $(this).attr('href') +
            ($('#step_1 .btn.active').data('type') ? '&type=' + $('#step_1 .btn.active').data('type') : ''));
        return true;
    });


    $('input[type=text]').each(function () {
        $(this).parents('.field, label, .label').first().append('<span class="ico-error" style="display: none"><div class="error-box"></div></span>');
    });

    $('input[type=text]').blur(function () {
        hide_error(this);
    });


    $('.label').find('span').click(function(){
        var radio = $(this).parents('.label ,li').first().find('input[type=radio]');

        $('input[type=radio]').not(radio).removeClass('clicked-1').removeClass('clicked-2');

        if($(radio).hasClass('clicked-2')){return false;}
        radio.trigger('click').trigger('change').change();
        if($(radio).hasClass('clicked-1'))$(radio).addClass('clicked-2');

        $(radio).addClass('clicked-1');
        $(this).click();
    });


    $('.label').find('input[type=text]').change(function(){
        var radio = $(this).parents('.label ,li').first().find('input[type=radio]');

        radio.trigger('click');
    });

    $('.label').find('input[type=text]').focus(function(){
        var radio = $(this).parents('.label ,li').first().find('span').click();

    });
});



