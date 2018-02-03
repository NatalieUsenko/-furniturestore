( function( $ ) {
    $(document).ready(function() {
        $('.not-fixed').on('mouseenter', function () {
            console.log('mouseenter');
            $(this).addClass('fixed').removeClass('not-fixed');
        });
        $('.fixed').on('mouseleave', function () {
            console.log('mouseleave');
            $(this).addClass('not-fixed').removeClass('fixed');
        });
    })
})