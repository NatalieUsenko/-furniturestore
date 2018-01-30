( function( $ ) {
    $('.not-fixed .show-always').on('mouseover',function () {
        $('.not-fixed').addClass('fixed').removeClass('not-fixed');
    });
    $('.fixed').on('mouseout', function () {
        $(this).addClass('not-fixed').removeClass('fixed');
    });
})