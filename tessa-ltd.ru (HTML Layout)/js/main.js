function scrollToPage(pageId) {
    var page = pageId == 'news' ? $('#page_3') : $('#' + pageId);
    if (page.length == 0)
        page = $('.page[url="' + pageId + '"]');
    if (page.length == 0)
        return;

    if(pageId == 'news')
    {
        $('#page_3 .page-link').removeClass('active');
        $('#news_open').addClass('active');

        $('.article').hide();
        $('#about_news').show();
    }

    var pageTop = $(page).offset().top;
    var pageMargin = $(page).find('.page-header').length > 0 ?
        parseInt($(page).find('.page-header').css('marginTop')) + parseInt($(page).find('.page-header').css('paddingTop'))
        : 0;

    var scrollTo = pageTop + (pageMargin - 100);

    $('html, body').animate({
        scrollTop:scrollTo
    }, 1000);
}

function nextCount(value)
{
    var i, part, child, factor, distance,
        count = new String(value),
        parts = count.split("").reverse();

    for (i = parts.length - 1; i >= 0; i--) {
        part = parseInt(parts[i], 10);

        // get current position
        child = $('ul#digit-' + i).data('roundabout').childInFocus;
        factor = (part < child) ? (10 + part) - child : part - child;
        distance = factor * 36;

        $('ul#digit-' + i).roundabout('animateToDelta', -distance);

    }
}

$(document).ready(function () {

    var counter = 0;
    setTimeout(function(){
        nextCount(++counter);
    }, 2500);

    var url = document.location.href;
    if (url.indexOf('?page=') != -1) {
        var page = url.substr(url.indexOf('?page=') + 6);
        scrollToPage(page);
    }

    var History = window.History; // Note: We are using a capital H instead of a lower h
    if (History.enabled) {
        History.Adapter.bind(window, 'statechange', function () {
            var State = History.getState();
            History.log(State.data, State.title, State.url);
        });
    }

    $('.counter ul').roundabout({
        shape: "waterWheel"
    });



    var slides = $('#car_slides').find('img');
    var currentImage = 0;
    var sliderTimer = setInterval(function () {
        $(slides).not(':hidden').fadeOut(1000, function () {

            var next = $(this).next().length ? $(this).next() : $(slides).first();
            $(next).fadeIn();

        });
    }, 10000);

    $('#page_3 .page-link').click(function () {
        var page = $(this).attr('for');

        $('#page_3 .page-link').removeClass('active');
        $(this).addClass('active');

        $('.article').hide();
        $('#about_' + page).show();

        return false;
    });

    $('#about_left, #about_right').click(function () {
        var next = $(this).attr('id') == 'about_left' ? $('.article').not(':hidden').prev('.article') : $('.article').not(':hidden').next('.article');

        if (next.length == 0)
            return false;

        var nextId = $(next).attr('id').substr(6);
        $('#page_3 .page-link[for="' + nextId + '"]').click();

        return false;
    });

    $('#partners .partner').click(function () {
        $('#partners .partner').removeClass('active');
        $(this).addClass('active');

        $('.partner-content').hide();
        $('#' + $(this).attr('for')).show();

        return false;
    });


    $('.slide').click(function () {

        var pageId = $(this).attr('for');
        scrollToPage(pageId);

        var page = $('#' + pageId);

        var url = $(this).attr('url') ? $(this).attr('url') : $(page).attr('url');
        if (History.enabled)
            History.pushState({state:1}, $(page).find('.page-header').text(), "?page=" + url);

        return false;
    });

    $('#partners_left, #partners_right').click(function () {

        var partners = $('.partner');
        for (var i = 0; i < partners.length; i++)
            if ($(partners[i]).hasClass('active')) {
                var nextInd = $(this).attr('id') == 'partners_left' ? i - 1 : i + 1;

                if (nextInd < 0 || nextInd >= partners.length)
                    return false;

                $($('.partner').get(nextInd)).click();
                return false;
            }

        return false;
    });

    $('#news_open').click(function(){

        $(this).toggleClass('active');

        return false;
    });


    $('.news-list a').click(function(){

        var newsId = $(this).attr('for').substr(5);

        $('#news_popup #news_' + newsId).show();
        $('#news_popup').show();
        $('.news-page-wr').hide();

        return false;
    });


    $('#close_news_popup').click(function(){
        $('.news-page-wr').show();
        $('#news_popup').hide();
        $('#news_popup .news').hide();
        return false;
    });

    $('#news_slide_button').click(function(){
        $('#page_3 #news_open').click();
        return true;
    });

    $('#about_slide_button').click(function(){

        if($('#about_news').is(':visible'))
        {
            $('#about_navigation a[for="history"]').click();
        }
    });
});