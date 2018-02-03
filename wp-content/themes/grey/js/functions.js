jQuery(document).ready(function($) {
    console.log('ready');
    $('#masthead').mouseenter(function () {
        console.log('mouseenter');
        $(this).addClass('fixed').removeClass('not-fixed');
    }).mouseleave(function () {
        console.log('mouseleave');
        $(this).addClass('not-fixed').removeClass('fixed');
    });
})