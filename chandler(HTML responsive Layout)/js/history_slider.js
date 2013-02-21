$(function () {
    if ($('#history_slider').length === 0)return;

    var labels = $('#history_slider .labels div');
    var points = $("#history_slider .point");
    var offsetX = $('#history_slider').offset().left;
    var pointer = $('#history_slider .pointer');
    var line = $('#history_slider .line');

    var BLOCK_HEIGHT = 240;

    var activeMove = false;

    function setPointerPos(x) {
        $(pointer).css('left', x + 'px');

        var item_ind = item_offset = 0;

        for (var i = 0; i < points.length - 1; i++) {
            if (x >= $(points[i]).offset().left - offsetX - 10 && x < $(points[i + 1]).offset().left - offsetX) {
                item_ind = i;
                break;
            }
        }

        item_ind = item_ind == 0 ? (x <= $(points[1]).offset().left - offsetX ? 0 : points.length - 1) : item_ind;

        var top = 0;

        if (item_ind == points.length - 1) {
            top = -item_ind * BLOCK_HEIGHT;
        } else {

            var line_width = $(labels[item_ind + 1]).offset().left - $(labels[item_ind]).offset().left;
            item_offset = Math.max(0, x - $(points[item_ind]).offset().left + offsetX + 15);

            var percent = item_offset / line_width;


            top = -item_ind * BLOCK_HEIGHT - BLOCK_HEIGHT * percent + 13;
        }

        labels.removeClass('active');

        next_offset = item_ind < points.length - 1 ? $(points[item_ind + 1]).offset().left - $(points[item_ind]).offset().left : 0;

        if (item_offset < 40) {
            $(labels[item_ind]).addClass('active');
        }
        else if(item_offset > next_offset - 35){
            $(labels[item_ind + 1]).addClass('active');
        }



        $('.history-items-slider').css('top', top + 'px');
    };

    line.click(function () {
        var x = event.pageX - offsetX;

        if (x < 0 || x > line.width() - 10)return false;

        x = x < 0 ? 0 : (x > line.width() - 25 ? line.width() - 25 : x);

        x = x < 10 ? 10 : x - 10;

        setPointerPos(x);
    });


    pointer.bind('mousedown', function () {
        activeMove = true;
        $('body').attr('unselectable', 'on').css('UserSelect', 'none').css('MozUserSelect', 'none');
    });

    $(document).bind('mouseup', function () {
        activeMove = false;
        $('body').removeAttr('unselectable').css('UserSelect', 'auto').css('MozUserSelect', 'auto');
    });

    $(document).bind('mousemove', function () {
        if (activeMove === false)return;

        var x = event.pageX - offsetX;
        x = x < 10 ? 10 : (x > line.width() - 10 ? line.width() - 10 : x);

        setPointerPos(x - 10);
    });

    points.click(function () {
        //    var x = $(this).offset().left - offsetX;
        //     var ind = $(this).parent().children().index(this);
        //     setPointerPos($(labels[ind]).offset().left - offsetX + 8);
    });

});