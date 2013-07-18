$(window).load(function () {
    $('.flexslider').flexslider({
        animation:"slide",
    });
});

$(document).ready(function () {
    $('.carousel').carousel({
        carouselWidth:280,
        carouselHeight:172,
        frontWidth:122,
        frontHeight:172,
        directionNav:true,
        backOpacity:0.5,
        hMargin:1.05,
        autoPlay:false,
        backZoom:0.7,
        shadow:true,
        buttonNav:'bullets'
    });
});


$(function () {
    $('.cities-block .cities a').click(function () {
        var cityID = $(this).data('city');

        if ($('.city-info:visible').length > 0) {
            $('.city-info:visible').fadeOut();
        }

        if ($('.city-info[data-city=' + cityID + ']').length > 0) {
            $('.city-info[data-city=' + cityID + ']').fadeIn();
        }

        return false;
    });

    $('header .cities-block a').hover(function () {
        $('header .cities-block a').removeClass('active');
        $(this).addClass('active');

        $('header .contacts').hide();

        var city = $(this).data('city');
        if (!city || $('header .contacts[data-city=' + city + ']').length == 0) {
            return;
        }

        $('header .contacts[data-city=' + city + ']').show();
    });

    $('.gallery').each(function () {
        $(this).lofJSidernews({ interval:5000,
            easing:'easeOutBounce',
            duration:1200,
            auto:false,
            mainWidth:505,
            mainHeight:363,
            navigatorHeight:95,
            navigatorWidth:186,
            maxItemDisplay:3,
            buttons:{
                previous:$(this).find('.button-previous'),
                next:$(this).find('.button-next')
            },
            onPlaySlider:function (a, b) {

                if (b.find('.description').length > 0) {
                    b.find('.description').hide();
                }
                setTimeout(function () {
                    if ($(a.slides[a.nextIndex]).find('.description').length > 0) {
                        $(a.slides[a.nextIndex]).find('.description').show();
                    }
                }, 250);
            }
        });
    });

});