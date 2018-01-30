( function( $ ) {
    $(document).ready(function() {
        $('.not-fixed').on('mouseenter', function () {
            $(this).addClass('fixed').removeClass('not-fixed');
        });
        $('.fixed').on('mouseleave', function () {
            $(this).addClass('not-fixed').removeClass('fixed');
        });
    })
})