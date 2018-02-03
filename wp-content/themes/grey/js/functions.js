jQuery(document).ready(function($) {
    $('#masthead').mouseenter(function () {
        $(this).addClass('fixed').removeClass('not-fixed');
    }).mouseleave(function () {
        $(this).addClass('not-fixed').removeClass('fixed');
    });
})