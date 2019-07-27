jQuery(function($){
    $('#topicNews li').prepend("<div class='topic-title'><i class='fa fa-bullhorn'></i>TOPICS</div>");

    var width = $(window).width();
    var slideHeightPc = width*900/1360;
    var slideHeightSp = width*862/768;

    if ($(window).width() > 768) {
        $('.swiper-slide .image').css('height', slideHeightPc);
    }
    else{
        $('.swiper-slide .image').css('height', slideHeightSp);
    }

    $(window).resize(function() {
        var width = $(window).width();
        var slideHeightPc = width*900/1360;
        var slideHeightSp = width*862/768;

        if ($(window).width() > 768) {
            $('.swiper-slide .image').css('height', slideHeightPc);
        }
        else{
            $('.swiper-slide .image').css('height', slideHeightSp);
        }
    });
});