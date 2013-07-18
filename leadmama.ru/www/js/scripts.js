var LeadMama = {};

LeadMama.updateDatepicker = function (elem) {
    elem = elem || document;

    $(elem).find('.datepicker').datepicker({
        dateFormat:'dd.mm.yy',
        changeMonth:true,
        changeYear:true,
        dayNames:['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'], // For formatting
        dayNamesShort:['Вос', 'Пон', 'Вто', 'Сре', 'Чет', 'Пят', 'Суб'], // For formatting
        dayNamesMin:['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'], // Column headings for days starting at Sunday
        monthNames:['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
            'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'], // Names of months for drop-down and formatting
        monthNamesShort:['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
            'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'], // For formatting
        prevText:'Пред', // Display text for previous month link
        nextText:'След', // Display text for next month link
        yearRange:'1990:2013',
        firstDay:1
    });
};

LeadMama.loadCharts = function () {
    var chart = $('#chart');

    if (chart.length === 0) {
        return;
    }

    var url = chart.data('url');
    var loader = chart.prev();

    $.get(url, function (response) {
        response = jQuery.parseJSON(response);

        $(chart).kendoChart({
            theme:"default",
            legend:{position:"bottom"},
            chartArea:{background:""},
            seriesDefaults:{type:"line"},
            series:[
                {
                    name:response.label,
                    data:response.values,
                    valueAxis:{
                        labels:{
                            format:"{0}",
						},
                    }

                }
            ],
			valueAxis:{
				title: {
				  text: response.axisTitles.y,
				  color: '#e76e1d',
				}
			},
            categoryAxis:{
                categories:response.months,
				title: {
				  text: response.axisTitles.x,
				  color: '#e76e1d',
				}
            },
            tooltip:{
                visible:true,
                format:"{0} " + response.param
            }});

        loader.hide();
    });
};

LeadMama.openMilestones = function () {

    var val = $('#diary_form:visible input[name=milestones]').val();

    if (val.length) {
        var milestones = val.split(',');
        for (var i in milestones) {
            var milestone_id = parseInt(milestones[i]);
            $('#milestones_window input[data-id=' + milestone_id + ']').attr('checked', 'checked');
        }
    }

    $('#milestones_window #custom_milestone').val($('#diary_form:visible input[name=custom_milestone]').val());

    $('#add_milestone').dialog('open');
};

LeadMama.resetMilestonesForm = function () {
    $('#diary_form #milestones_list').empty();
    $('#diary_form input[name=milestones]').val('');
    $('#milestones_window input[type=checkbox]').removeAttr('checked');
};

LeadMama.runInitScripts = function (elem) {
    elem = elem || document;

    $(elem).find('.cleditor').each(function () {
        var width = $(this).parents('.popup') ? $(this).parents('.popup').data('width') - 40 : 0;


        $(this).cleditor({
            width:width,
            controls:"bold italic underline strikethrough subscript superscript | font size " +
                "style | color highlight removeformat | bullets numbering"
        });
        $(this).cleditor()[0].refresh();
		
    });
	

    $(elem).find('.datepicker').datepicker({
        dateFormat:'dd.mm.yy',
        changeMonth:true,
        changeYear:true,
        dayNames:['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'], // For formatting
        dayNamesShort:['Вос', 'Пон', 'Вто', 'Сре', 'Чет', 'Пят', 'Суб'], // For formatting
        dayNamesMin:['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'], // Column headings for days starting at Sunday
        monthNames:['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
            'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'], // Names of months for drop-down and formatting
        monthNamesShort:['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
            'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'], // For formatting
        prevText:'Пред', // Display text for previous month link
        nextText:'След', // Display text for next month link
        yearRange:'1950:2013',
        firstDay:1
    });
}

jQuery(function ($) {

    LeadMama.runInitScripts();
    $('.fancybox').fancybox();
    $('.popup').each(function () {

        var title = $(this).data('title') || '';
        var width = $(this).data('width') || 300;

        $(this).dialog({
            autoOpen:false,
            modal:true,
            title:title,
            width:width,
            resizable:false,
            draggable:false
        });

        if ($(this).data('open') == 1) {
            $(this).dialog('open');
        }

        $(this).find('.popup-close').click(function () {
            $(this).parents('.popup').dialog('close');
            return false;
        });
    });

    $('.popup-link').live('click', function () {


        var popupId = $(this).data('popup');


        var popup = $('#' + popupId);
        var form = popup.find('form');

        if (form.length > 0) {
            var url = this.href;
            if (url[url.length - 1] !== '#') {
                form.attr('action', url);
            }

            form[0].reset();
        }


        if (popup) {
            popup.dialog('open');
            LeadMama.runInitScripts(popup);
        }

        $(window).resize(function () {
            popup.dialog("option", "position", "center");
        });

        return false;
    });

    $('.ajax-popup-link').live('click',function () {
        var title = $(this).data('title') || '';
        var width = $(this).data('width') || 300;

        var url = this.href;
        var dialog = $('<div class="loading"></div>').appendTo('body');

        dialog.dialog({
            close:function (event, ui) {
                dialog.remove();
            },
            modal:true,
            title:title,
            width:width,
            resizable:false,
            draggable:false
        });

        dialog.load(
            url,
            {},
            function (responseText, textStatus, XMLHttpRequest) {
                dialog.removeClass('loading');
                dialog.dialog("option", "position", "center");
                dialog.find('.datepicker').each(function () {
                    $(this).removeAttr('id');
                });

                LeadMama.runInitScripts(dialog);
            }
        );

        $(window).resize(function () {
            dialog.dialog("option", "position", "center");
        });

        return false;
    });


    LeadMama.loadCharts();


    $("#tabs li").click(function () {
        $("#tabs li").removeClass('active');
        $(this).addClass("active");
        $(".tab_content").hide();
        var selected_tab = $(this).find("a").attr("href");
        $(selected_tab).fadeIn();
        return false;
    });


    $('#submit_milestone').click(function () {

        var form = $('.diary-form:visible');

        var res = '';
        form.find('#milestones_list').empty();

        $('#milestones_window input[type=checkbox]:checked').each(function () {
            res += $(this).data('id') + ',';
            form.find('#milestones_list').append('<li>' + $(this).parents('label').text().trim() + '</li>');
        });
        res = res.length > 0 ? res.substr(0, res.length - 1) : '';

        form.find('input[name=milestones]').val(res);

        var custom_milestone = $('#milestones_window #custom_milestone').val();
        form.find('input[name=custom_milestone]').val(custom_milestone);
        if (custom_milestone.length > 0) {
            form.find('#milestones_list').append('<li>' + custom_milestone + '</li>');
        }

        $('#milestones_window').dialog('close');
        return false;
    });

    $('#open_milestones').live('click', function () {
        LeadMama.openMilestones();
    });

    $('#new_message_button').bind('click', function () {
        LeadMama.resetMilestonesForm();
        return true;
    });


    $('#open_access input[type=checkbox]').click(function () {

        if (!$(this).is(':checked')) {
            $('#is_login, #is_email').not(this).attr('checked', 'checked');
        }
        else {
            $('#is_login, #is_email').not(this).removeAttr('checked');
        }

        $('#open_access .block').each(function () {
            var block = $(this);
            if (block.find('input[type=checkbox]').is(':checked')) {
                block.find('.row').show();
            }
            else {
                block.find('.row').hide();
            }
        });
    });

    $('#open_access input[type=submit]').click(function () {

        var wnd = $('#open_access');
        var loader = wnd.find('.loader');

        wnd.find('.error').html('');

        loader.show();

        var value = wnd.find('[type=text]:visible').val();

        $.post('/open_access',
            wnd.find('#is_email').is(':checked') ? {email:value} : {login:value},
            function (data) {
                data = jQuery.parseJSON(data);

                if (data.is_error) {
                    var error_span = wnd.find('#is_email').is(':checked') ? wnd.find('#email_access_error') : wnd.find('#login_access_error');
                    error_span.html(data.message);
                }
                else {
                    wnd.find('.form-block').hide();
                    wnd.find('.success-message p').html(data.message);
                    wnd.find('.success-message').show();
                }

                loader.hide();
            }
        );

    });

    $('.open-access.popup-link').on('click', function () {
        $('#open_access').find('.success-message').hide();
        $('#open_access').find('.form-block').show();
        $('#open_access').find('input[type=text]').val('');
        $('#open_access').find('.error').html('');
        return true;
    });
});