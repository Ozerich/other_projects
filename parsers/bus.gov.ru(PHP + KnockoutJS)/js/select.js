$.fn.select = function (options) {
    var $that = $(this);

    var selected = null;

    options = $.extend({
        data: [],
        onChange: function () {
        },
    }, options);

    var html = '<div class="extendedSearchAverageSelect"><select title="" style="z-index: 10; opacity: 0;" class="valid">';

    for (var i = 0; i < options.data.length; i++) {
        html += '<option value="' + options.data[i].id + '">' + options.data[i].label + '</option>';
    }

    html += '</select><span class="select" style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 14px; line-height: normal; font-family: Calibri;"><span class="selectRight"></span><span class="selectLeft">' +
        '</span> <span class="selected-label">' + options.data[0].label + '</span></span></div>';

    $(this).empty().append(html);

    $(this).find('select').on('change', function () {
        $that.find('.selected-label').html($(this).find('option:selected').html());
        selected = {id: $(this).find('option:selected').val(), label: $that.find('.selected-label').html()};
        options.onChange(+$(this).find('option:selected').val());
    });

    $(this).find('select').trigger('change');

    return {
        reset: function () {
            var first = options.data[0];
            $that.find('.selected-label').html(first.label);
            selected = {id: first.id, label: first.label};
            $that.find('select option').removeAttr('selected').first().attr('selected', 'selected').trigger('change');
        },
        getSelected: function () {
            return selected;
        }
    };
};


$.fn.manyselect = function (options) {
    var $that = $(this);

    var selected = [];

    options = $.extend({
        data: [],
        placeholder: '',
        onChange: function () {
        },
    }, options);

    var html = '<div class="manySelect" id="manySelect_regions">' +
        '<div class="collapsed"><div class="msPlaceholder" style="">' + options.placeholder + '</div>' +
        '<div class="msPlaceholder2" style="display: none;">Выбрано: <span class="count"></span></div>' +
        '<span class="msExpandButton active"></span></div>' +
        '<div class="expanded-container" style="display: none;">' +
        '<div class="expanded">';

    html += '</div><div class="button"><input type="submit" value="Выбрать"><span class="button-right"></span></div></div></div>';

    $(this).empty().append(html);

    $(this).find('.collapsed').on('click', function () {
        $that.find('.expanded-container').slideDown();

        return false;
    });

    $(this).find('input[type=submit]').on('click', function () {
        selected = [];

        $that.find('.line').each(function () {
            if ($(this).find('input').is(':checked')) {
                selected.push({
                    id: +$(this).find('input').val(),
                    label: $(this).find('label').html()
                });
            }
        });

        options.onChange(selected);

        $that.find('.expanded-container').slideUp();

        $that.find('.msPlaceholder').toggle(selected.length === 0);
        $that.find('.msPlaceholder2').toggle(selected.length !== 0);
        $that.find('.count').html(selected.length);

        return false;
    });

    return {
        reset: function () {
            $that.find('.expanded-container').slideUp();
            $that.find('.expanded').empty();

            $that.find('.msPlaceholder').toggle(true);
            $that.find('.msPlaceholder2').toggle(false);

            selected = [];
        },
        setData: function (data) {

            var html = '';
            for (var i = 0; i < data.length; i++) {
                html += '<div class="line"><input id="regions1" name="regions" type="checkbox" value="' + data[i].id + '"><label for="regions1">' + data[i].label + '</label></div>';
            }

            $that.find('.expanded').empty().append(html);
        },
        getSelected: function () {
            return selected;
        }
    }
};