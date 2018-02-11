jQuery(document).ready(function($) {
    $('#masthead').mouseenter(function () {
        $(this).addClass('fixed').removeClass('not-fixed');
    }).mouseleave(function () {
        $(this).addClass('not-fixed').removeClass('fixed');
    });
});

jQuery(window).load(function ($) {
    if ( $('.top-news_dark').length > 0 ){
        var windowWidth = $(window).width();
        var leftStart = $('h1').position().left;
        $('.top-news_dark').css('padding-left', leftStart+'px');

        var darkHeight = $('.top-news_dark').outerHeight();
        var imgHeight = Math.ceil(515*windowWidth/(1125));
        var diffHeight = 0;
        diffHeight = Math.ceil(imgHeight - imgHeight - $('h1').position().top - $('h1').height());
        if ( diffHeight > 0 ){
            $('.top-news_dark').css('margin-top', diffHeight+'px');
        }


    }
});