var DATA;

function updateUndefined() {
    $('#undefined_overlay').show();

    $.getJSON('index.php?ajax&action=data', function (data) {

        DATA = data;

        $('.non-found .item-line').each(function () {
            var brand = $(this).find('.brand').text();
            var line = $(this);
            var form = $(this).next();
            var models = form.find('.models');
            var manufactures = form.find('.manufactures');

            models.find('option').each(function () {
                if ($(this).val() != '0') {
                    $(this).remove();
                }
            });

            manufactures.find('option').each(function () {
                if ($(this).val() != '0') {
                    $(this).remove();
                }
            });

            for (var bi in data) {
                if (data[bi].name.toLowerCase() == brand.toLowerCase()) {
                    line.addClass('known-brand');

                    for (var mi in data[bi].models) {
                        models.find('option').last().after('<option is_winter="'+(data[bi].models.is_winter ? 1 : 0)+'" spikes="' + (data[bi].models[mi].spikes != '0' ? '1' : '0') + '" value="' + data[bi].models[mi].id + '">' + data[bi].models[mi].name + '</option>')
                    }
                    models.trigger('change');

                    manufactures.find('option').last().after('<option selected value="' + data[bi].id + '">' + data[bi].name + '</option>');
                    manufactures.attr('disabled', 'disabled');
                    manufactures.trigger('change');

                    return true;
                }
            }

            for (var bi in data) {
                manufactures.find('option').last().after('<option selected value="' + data[bi].id + '">' + data[bi].name + '</option>');
            }
            manufactures.find('option').first().prop('selected', true);

            form.find('.param-modelname').show();

            line.removeClass('known-brand');
            manufactures.removeAttr('disabled');
            models.trigger('change');
            manufactures.trigger('change');
        });

        $('#undefined_overlay').hide();

        $('.form-add .manufactures').each(function () {


            $(this).on('change', function () {
                var select = $(this).parents('.form-add').find('select.models');

                select.find('option').each(function () {
                    if ($(this).val() != '0') {
                        $(this).remove();
                    }
                });

                var models;

                for (var i in DATA) {
                    if (DATA[i].id == $(this).val()) {
                        models = DATA[i].models;
                    }
                }

                for (var i in models) {
                    select.find('option').last().after('<option is_winter="'+(models[i].is_winter == '1' ? 1 : 0)+'" spikes="' + (models[i].spikes != '0' ? '1' : '0')+'"' + ' value="' + models[i].id + '">' + models[i].name + '</option>');
                }
            });
        })


    });
}

$(function () {
    $('.open-addform-btn').click(function () {

        if (DATA === null)return false;

        if ($(this).hasClass('open')) {
            $(this).html('Добавить');
        }
        else {
            $(this).html('Закрыть');
        }

        $(this).parents('tr').next().toggle();
        $(this).toggleClass('open');

        return false;
    });

    $('select.models').change(function () {
        var spikes = $(this).find('option:selected').attr('spikes');
        var is_winter = $(this).find('option:selected').attr('is_winter');
        var spikes_checkbox = $(this).parents('.form-add').find('.spikes');
        var param_modelname = $(this).parents('.form-add').find('.param-modelname');
        var tyres_select = $(this).parents('.form-add').find('.type');
		
        spikes_checkbox.prop('checked', spikes !== '0').prop('disabled', $(this).val() !== '0');
		if(is_winter == 1){
			tyres_select.find('option[value="winter"]').attr('selected', 'selected');
			tyres_select.find('option[value="summer"]').removeAttr('selected');
		}
		else{
			tyres_select.find('option[value="summer"]').attr('selected', 'selected');
			tyres_select.find('option[value="winter"]').removeAttr('selected');
		}
        tyres_select.prop('disabled', $(this).val() !== '0');

        var original_name = $(this).parents('tr').prev().find('.model').text();

        if ($(this).val() == '0') {
            param_modelname.show().find('input').val(original_name);
        }
        else {
            param_modelname.hide();
        }

    });

    $('select.manufactures').change(function () {
        var param_brandname = $(this).parents('.form-add').find('.param-brandname');
        var original_name = $(this).parents('tr').prev().find('.brand').text();

        if ($(this).val() == '0') {
            param_brandname.show().find('input').val(original_name);
        }
        else {
            param_brandname.hide();
        }

    });

    $('.add_button').click(function () {

        var block = $(this).parents('tr');
        var form = block.find('.form-add');
        var line = block.prev();

        var request = {
            brand: form.find('select.manufactures option:selected').val(),
            model: form.find('select.models option:selected').val(),
            new_model: line.find('td.model').text(),
            spikes: form.find('.spikes').is(':checked') ? 1 : 0,
			type: form.find('.type').find('option:selected').val()
        };

        if (form.find('.model_name').is(':visible')) {

            if (form.find('.model_name').val() == '') {
                alert('Имя модели не заполнено');
                return false;
            }

            request.alt_model = request.new_model;
            request.new_model = form.find('.model_name').val();
        }


        if (!form.find('select.manufactures').attr('disabled')) {
            request.new_brand = line.find('td.brand').text();
        }


        if (form.find('.brand_name').is(':visible')) {

            if (form.find('.brand_name').val() == '') {
                alert('Имя производителя не заполнено');
                return false;
            }

            request.alt_brand = request.new_brand;
            request.new_brand = form.find('.brand_name').val();
        }

        $('#undefined_overlay').show();

        $.post('index.php?ajax&action=add', request, function () {

            block.prev().remove();
            block.remove();

            updateUndefined();
        });

        return false;
    });


    updateUndefined();
})
;
