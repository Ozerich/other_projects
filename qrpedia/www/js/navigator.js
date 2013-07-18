var NavigationCache = new Array();

function html(data) {

    $('section').html(data).initializeInputs();
}

function selectNav(link){
    var $nav = $('nav');
    $nav.find('li').removeClass('active');
    $nav.find('a[href="' + link + '"]').parent().addClass('active');
}


function setPage(page) {

    selectNav(page);

    $.ajax({
        type:"GET",
        url:page,
        data:{},
        success:function (data) {
            html(data);
            NavigationCache[page] = data;
            history.pushState({page:page, type:"page"}, document.title, page);
        },
        error:function (data, text) {
            html(data.responseText);
            NavigationCache[page] = data.responseText;
            history.pushState({page:page, type:"page"}, document.title, page);
            $('select').customSelect();
        }
    });

}

$(document).ready(function () {
    NavigationCache[window.location.pathname] = $('section').html();
    history.pushState({page:window.location.pathname, type:"page"}, document.title, window.location.pathname);

    if (history.pushState) {

        window.onpopstate = function (event) {
            if (event.state && event.state.type.length > 0) {
                if (NavigationCache[event.state.page].length > 0) {
                    html(NavigationCache[event.state.page]);
                }
            }
        };

        $('nav a').live("click", function () {
            setPage($(this).attr('href'));

            return false;
        });

        $('a.ajax').live('click', function () {
            setPage($(this).attr('href'));

            return false;
        });
    }

    selectNav(document.location.pathname);
});
