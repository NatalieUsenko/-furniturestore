( function( $ ) {
    $('.not-fixed').on('mouseenter',function () {
        $('.not-fixed').addClass('fixed').removeClass('not-fixed');
    });
    $('.fixed').on('mouseleave', function () {
        $(this).addClass('not-fixed').removeClass('fixed');
    });
})