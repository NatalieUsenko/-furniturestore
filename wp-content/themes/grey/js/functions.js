jQuery(document).ready(function($) {
    $('#masthead').mouseenter(function () {
        $(this).addClass('fixed').removeClass('not-fixed');
    }).mouseleave(function () {
        $(this).addClass('not-fixed').removeClass('fixed');
    });
});
jQuery(function($){
    $('#true_loadmore').click(function(){
        $(this).text('Загружаю...'); // изменяем текст кнопки, вы также можете добавить прелоадер
        var data = {
            'action': 'loadmore',
            'query': true_posts,
            'page' : current_page
        };
        $.ajax({
            url:ajaxurl, // обработчик
            data:data, // данные
            type:'POST', // тип запроса
            success:function(data){
                if( data ) {
                    $('#true_loadmore').text('Загрузить ещё').before(data); // вставляем новые посты
                    current_page++; // увеличиваем номер страницы на единицу
                    if (current_page == max_pages) $("#true_loadmore").remove(); // если последняя страница, удаляем кнопку
                } else {
                    $('#true_loadmore').remove(); // если мы дошли до последней страницы постов, скроем кнопку
                }
            },
            error: function (error) {
                $('#true_loadmore').text('Загрузить ещё');
                console.error(error);
            }
        });
    });

    $('#true_loadmore_catalugue').click(function(){
        $(this).text('Загружаю...'); // изменяем текст кнопки, вы также можете добавить прелоадер
        var data = {
            'action': 'loadmore_catalogue',
            'query': true_posts,
            'page' : current_page
        };
        $.ajax({
            url:ajaxurl, // обработчик
            data:data, // данные
            type:'POST', // тип запроса
            success:function(data){
                if( data ) {
                    $('#true_loadmore_catalugue').text('Загрузить ещё').before(data); // вставляем новые посты
                    current_page++; // увеличиваем номер страницы на единицу
                    if (current_page == max_pages) $("#true_loadmore_catalugue").remove(); // если последняя страница, удаляем кнопку
                } else {
                    $('#true_loadmore_catalugue').remove(); // если мы дошли до последней страницы постов, скроем кнопку
                }
            },
            error: function (error) {
                $('#true_loadmore_catalugue').text('Загрузить ещё');
                console.error(error);
            }
        });
    });

    $(window).load(function () {
        if ( $('.top-news_dark').length > 0 ){
            var windowWidth = $(window).width();
            var leftStart = $('h1').position().left;
            $('.top-news_dark').css('padding-left', leftStart+'px');

            var darkHeight = $('.top-news_dark').outerHeight();
            var imgHeight = Math.ceil(515*windowWidth*0.55/1125);
            var diffHeight = 0;
            diffHeight = Math.ceil(imgHeight - darkHeight - $('h1').position().top - $('h1').height());
            if ( diffHeight > 0 ){
                $('.top-news_dark').css('margin-top', diffHeight+'px');
            }
        }
        if ( $('.top-catalogue_dark').length > 0 ){
            var windowWidth = $(window).width();
            var leftStart = $('h1').position().left;
            $('.post-top_more-link__catalogue').css('left', leftStart+'px');

            var darkHeight = $('.top-catalogue_dark').outerHeight();
            var imgHeight = Math.ceil(515*windowWidth*0.55/1125);
            var diffHeight = 0;
            diffHeight = Math.ceil(imgHeight - darkHeight - $('h1').position().top - $('h1').height());
            if ( diffHeight > 0 ){
                $('.top-catalogue_dark').css('margin-top', diffHeight+'px');
            }
        }
        if ( $('#firstscreen .grey-line').length > 0 ){
            var windowWidth = $(window).width();
            var leftStart = $('footer .container .row').position().left;
            $('#firstscreen .grey-line').css('width', (windowWidth-leftStart)+'px')
        }

        var owl = $('.owl-carousel');
        if (owl.length>0){
            owl.owlCarousel();
        }
        $('#owl-prev').on('click',function(){
            owl.trigger('prev.owl.carousel');
        });
        $('#owl-next').on('click', function(){
            owl.trigger('next.owl.carousel');
        });
    });



});

