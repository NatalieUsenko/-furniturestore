( function( $ ) {
    $('.not-fixed').on('mouseover',function () {
        $(this).addClass('fixed').removeClass('not-fixed');
    });
    $('.fixed').on('mouseout', function () {
        $(this).addClass('not-fixed').removeClass('fixed');
    });
})