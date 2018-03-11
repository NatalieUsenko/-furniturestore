jQuery(document).ready(function($) {
    $('.home #masthead').mouseenter(function () {
        if (!$(this).hasClass('showed')){
            $(this).addClass('fixed').removeClass('not-fixed');
        }
    }).mouseleave(function () {
        if (!$(this).hasClass('showed')) {
            $(this).addClass('not-fixed').removeClass('fixed');
            if ($('.menu-btn').hasClass('opened')){
                $('.menu-btn').removeClass('opened');
                $('#top-contacts').show();
                $('#top-menu').hide();
            }
        }
    });
});
jQuery(function($){
    $('#true_loadmore').click(function(){
        $('#true_loadmore img').hide();
        $('<span>Загружаю...</span>').appendTo($(this));
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
                    $('#true_loadmore').before(data); // вставляем новые посты
                    $('#true_loadmore span').remove();
                    $('#true_loadmore img').show();
                    current_page++; // увеличиваем номер страницы на единицу
                    if (current_page == max_pages) $("#true_loadmore").remove(); // если последняя страница, удаляем кнопку
                } else {
                    $('#true_loadmore').remove(); // если мы дошли до последней страницы постов, скроем кнопку
                }
            },
            error: function (error) {
                $('#true_loadmore span').remove();
                $('#true_loadmore img').show();
                console.error(error);
            }
        });
    });

    $('#true_loadmore_catalugue').click(function(){
        $('#true_loadmore_catalugue img').hide();
        $('<span>Загружаю...</span>').appendTo($(this));
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
                    $('#true_loadmore_catalugue').before(data); // вставляем новые посты
                    $('#true_loadmore_catalugue span').hide();
                    $('#true_loadmore_catalugue img').show();
                    current_page++; // увеличиваем номер страницы на единицу
                    if (current_page == max_pages) $("#true_loadmore_catalugue").remove(); // если последняя страница, удаляем кнопку
                } else {
                    $('#true_loadmore_catalugue').remove(); // если мы дошли до последней страницы постов, скроем кнопку
                }
            },
            error: function (error) {
                $('#true_loadmore_catalugue span').hide();
                $('#true_loadmore_catalugue img').show();
                console.error(error);
            }
        });
    });

    $('.menu-btn').on('click', function() {
        $(this).toggleClass('opened');
        if ($(this).hasClass('opened')){
            $('#top-contacts').hide();
            $('#top-menu').show();
        } else {
            $('#top-contacts').show();
            $('#top-menu').hide();
        }
    });

    $('#menu-top-menu .menu-item').on('click', function() {
        $('.menu-btn').trigger('click');
    });

    $('.go-to').on('click', function(e) {
        e.preventDefault();
        var target = $(this.getAttribute('href'));
        $('html, body').animate({ scrollTop: target.offset().top }, 500);
    });

    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if ($('body').hasClass('home')){
            var catalogueTop = $('#catalogue').offset().top;
            if (scroll>(catalogueTop-137)){
                $('#masthead').removeClass('not-fixed').addClass('showed');
            } else {
                $('#masthead').removeClass('showed').addClass('not-fixed');
                if ($('.menu-btn').hasClass('opened')){
                    $('.menu-btn').removeClass('opened');
                    $('#top-contacts').show();
                    $('#top-menu').hide();
                }
            }
        }
    });

    $(window).load(function () {
        if ( $('.top-news_dark').length > 0 ){
            topNewsDark();
        }
        if ( $('.top-catalogue_dark').length > 0 ){
            topCatalogueDark();
        }
        if ( $('#firstscreen .grey-line').length > 0 ){
            firstscreenGreyLine();
        }
        if ( $('.catalogue__inner').length > 0 ){
            catalogueInner();
        }

        $('#owl-prev').on('click',function(){
            $('.owl-theme .owl-controls .owl-buttons .owl-prev').mouseup();
        });
        $('#owl-next').on('click', function(){
            $('.owl-theme .owl-controls .owl-buttons .owl-next').mouseup();
        });
    });

    $(window).resize(function () {
        if ($('.top-news_dark').length > 0) {
            topNewsDark();
        }
        if ($('.top-catalogue_dark').length > 0) {
            topCatalogueDark();
        }
        if ($('#firstscreen .grey-line').length > 0) {
            firstscreenGreyLine();
        }
        if ( $('.catalogue__inner').length > 0 ){
            catalogueInner();
        }

    });

    function topNewsDark() {
        var windowWidth = $(window).width();
        var leftStart = $('h1').position().left;
        var topStart = $('h1').offset().top - $('#main').offset().top;
        $('.top-news_dark').css('padding-left', leftStart+'px');

        var darkHeight = $('.top-news_dark').outerHeight();
        var imgHeight = Math.ceil(515*windowWidth*0.55/1125);
        var diffHeight = Math.ceil(imgHeight - darkHeight - topStart - $('h1').height() - 25);
        if ( diffHeight > 0 ){
            $('.top-news_dark').css('margin-top', diffHeight+'px');
        }
    }
    function topCatalogueDark(){
        var windowWidth = $(window).width();
        var leftStart = $('h1').position().left;
        var topStart = $('h1').offset().top - $('#main').offset().top;
        $('.post-top_more-link__catalogue').css('left', leftStart+'px');

        var darkHeight = $('.top-catalogue_dark').outerHeight();
        var imgHeight = Math.ceil(580*windowWidth*0.55/1135);
        var diffHeight = Math.ceil(imgHeight - darkHeight - topStart - $('h1').height()-25);

        if ( diffHeight > 0 ){
            $('.top-catalogue_dark').css('margin-top', diffHeight+'px');
        }

        var itemHeight = $('.col-md-4.post-list_catalogue').eq(0).height();
        var itemWidth = $('.col-md-4.post-list_catalogue').eq(0).width();
        var itemTitleWidth = $('.col-md-4.post-list_catalogue .post-list_title').eq(0).width();
        if ($('body').find('#left-item_catalogue').length>0){
            var leftWidth = itemWidth*2+leftStart+45;
            var blockHeight = 2*itemHeight+30;
            if (windowWidth<1200){
                $('#left-item_catalogue').css('margin-left','0px').css('width','100%').css('height',windowWidth*0.6+'px');
                $('#left-item_catalogue .post-list_title').css('width',(itemTitleWidth+30)+'px').css('padding-left','15px');
            } else {
                $('#left-item_catalogue').css('margin-left',leftStart*(-1)+'px').css('width',leftWidth+'px').css('height',blockHeight+'px');
                $('#left-item_catalogue .post-list_title').css('width',(itemTitleWidth+leftStart+30)+'px').css('padding-left',(leftStart+15)+'px');
            }

        }
        if ($('body').find('#right-item_catalogue').length>0){
            var rightWidth = itemWidth+leftStart+15;
            var blockHeight = 2*itemHeight+30;
            if (windowWidth<1200){
                $('#right-item_catalogue').css('margin-right','0').css('width','100%').css('height',windowWidth*0.6+'px');
            } else {
                $('#right-item_catalogue').css('margin-right',leftStart*(-1)+'px').css('width',rightWidth+'px').css('height',blockHeight+'px');
            }
            $('#right-item_catalogue .post-list_title').css('width',(itemTitleWidth+30)+'px');
        }
    }

    function firstscreenGreyLine() {
        var windowWidth = $(window).width();
        var leftStart = $('footer .container .row').position().left;
        if (windowWidth>1200){
            $('#firstscreen .grey-line').css('width', (windowWidth-leftStart)+'px');
            $('#firstscreen .slider .owl-carousel-item-imgoverlay').css('width', (windowWidth*0.59-leftStart)+'px');
        } else {
            $('#firstscreen .grey-line').css('width', '100%');
            $('#firstscreen .slider .owl-carousel-item-imgoverlay').css('width', '100%');
        }

        var infoStart = $('#firstscreen .info').offset().left;
        if ((infoStart<75)|(windowWidth<=1200)){
            infoStart = 75;
        }
        if (windowWidth<768){
            infoStart = 15;
        }
        $('#firstscreen .grey-line .go-to').css('left', infoStart+'px');

        if ($('#firstscreen .owl-carousel-item-imgcontent a').length>0){
            var link = $('#firstscreen .owl-carousel-item-imgcontent a')[0];
            $('#firstscreen .owl-carousel-item-imgtitle')[0].appendChild(link);
        }
    }

    function catalogueInner() {
        var windowWidth = $(window).width();
        var leftStart = $('footer .container .row').position().left;
        var rightTextHeight = 0;
        var leftImgHeight = 0;
        var leftTextHeight = 0;

            $('.page-title').css('margin-left', leftStart+'px');
        var topImg = $('.page-title').offset().top+$('.page-title').height()-87;

        if ($('body').find('#left-text').length>0){
            leftTextHeight = $('#left-text').outerHeight();
            $('#left-text').css('padding-left', leftStart+'px');
        }
        if ($('body').find('#right-img').length>0){
            $('#right-img').css('margin-top', topImg*(-1)+'px');
        }
        if ($('body').find('#right-text').length>0){
            rightTextHeight = $('#right-text').outerHeight();
        }
        if ($('body').find('#left-img').length>0){
            leftImgHeight = $('#left-img').outerHeight();
            var leftImgTop = leftImgHeight-rightTextHeight;
            $('#left-img').css('margin-top', leftImgTop*(-1)+'px');
        }


    }

});

