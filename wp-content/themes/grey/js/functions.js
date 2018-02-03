( function( $ ) {
    $(document).ready(function() {
        $('#masthead').mouseenter(function () {
            console.log('mouseenter');
            $(this).addClass('fixed').removeClass('not-fixed');
        }).mouseleave(function () {
            console.log('mouseleave');
            $(this).addClass('not-fixed').removeClass('fixed');
        });
    })
})