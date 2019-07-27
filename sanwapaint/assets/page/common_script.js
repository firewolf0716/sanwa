jQuery(function($){


    $(document).on("click",".ga_header_mail",function(){
        if($(".Pc")[0]){
            ga('send', 'event', 'header', 'click', 'mail');
        }else{
            ga('send', 'event', 'header', 'click', 'mailSP');
        }
    });
    $(document).on("click",".ga_cta_start",function(){
        ga('send', 'event', 'cta', 'click', 'start');
    });
    $(document).on("click",".ga_top_customervoice a",function(){
        ga('send', 'event', 'top', 'click', 'customervoice');
    });
    $(document).on("click",".ga_top_consultation",function(){
        ga('send', 'event', 'top', 'click', 'consultation');
    });
    $(document).on("click",".ga_simple-estimation_simple-estimation-result",function(){
        ga('send', 'event', 'simple-estimation', 'click', 'simple-estimation-result');
    });
    $(document).on("click",".ga_header_telSP",function(){
        ga('send', 'event', 'header', 'click', 'telSP');
    });
    $(document).on("click",".ga_footer_cocorotosoubanner a",function(){
        ga('send', 'event', 'footer', 'click', 'cocorotosoubanner');
    });
    $(document).on("click",".ga_cs_cocorotosou",function(){
        ga('send', 'event', 'cs', 'click', 'cocorotosou');
    });
    $(document).on("click",".ga_cs_sekoujirei",function(){
        ga('send', 'event', 'cs', 'click', 'sekoujirei');
    });
    $(document).on("click",".ga_cs_contact",function(){
        ga('send', 'event', 'cs', 'click', 'contact');
    });
    $(document).on("click","input.wpcf7c-btn-confirm",function(){
        ga('send', 'event', 'contact', 'click', 'confirm');
    });


    //
    if(!String(location.href).indexOf(-1) != "cs?item"){
        var num = location.search.split("=")[1];
        setTimeout(function(){
            $(".cs_item.item"+num+" button").click();
        },300)
    }

    //施工事例検索
        $('.searchWrapper [data-colorname="SP-350"] input').prop("checked",true);
        $('.searchWrapper [data-colorname="AZE-329"] input').prop("checked",true);

    //お問い合わせ勝手に閉じないように
    $("head").append("<style id='cf7_groupDisplayCustomStyle'>[data-id='contact_group_1']{display:block !important;height:auto !important}</style>");
    $('[name="contact-type"]').on("change",function(){
        setTimeout(function(){
            var id = $(".mainSelection ~ [style*='display: block']").attr("data-id");
            $("#cf7_groupDisplayCustomStyle").html("[data-id='"+id+"']{display:block !important;height:auto !important}");
        },350)
    });


    //VCボタンクラス削除
    $(".cocoroBtn > a").removeAttr("class").addClass("activeOpacity");

    $("[id='simulation1']").add("[id='estimation_form1']").add("[id='esti-search-btn2']").each(function(i,element){
        $(this).attr("id",$(this).attr("id")+"_"+i);
        // $(this).attr("id")
    })

    $(".simulationArea").each(function(i,e){
        $(this).find("[data-lightbox]").attr("data-lightbox",i);
    })

    //ショートコードシュミュレーションエリア　ボタン設定
    $(".simulationArea .button1 figure img").each(function(i,element){
        var id = $(this).closest(".simulationArea").find("input[type='submit']").attr("id");
        $(this).wrap("<label for='"+id+"'></label>");
    })

    //本サイトメニュー
    $(".menuBtnAction").tap(function(e,me){
        $("html").toggleClass("menuActive");
        $(".menuBtn").toggleClass("active");
        $(".headMenuBox").stop(true, true).slideToggle(300);

        //メニュー表示中はその他のコンテンツを非表示
        $(".header_next").stop(true, true).fadeIn(300);
        $(".menuActive .header_next").stop(true, true).fadeOut(300);
    });

    //ココロトソウメニュー
    $(".menuBtnAction2").tap(function(e,me){
        $("html").toggleClass("menuActive");
        $(".menuBtn").toggleClass("active");
    });

    //施工事例特注色チェック
    $(".specialcolor").on("click",function(){
        if(!$(this).find("input").prop("checked")){
            $(this).find("input").prop("checked",true);
        }else{
            $(this).find("input").prop("checked",false);
        }
    });

    //ライトボックスの位置を調整(fixedHeader)
    setTimeout(function(){
        $(".lightbox").css("padding-top",$(".fixedHeader").outerHeight()+"px");
    },1000);
    //end ライトボックスの位置を調整(fixedHeader)



    $('[href="/simulation"],[href="/simulation/"]').on("click",function(e){
        e.preventDefault();
        window.open("/simulation","外壁塗装シミュレーション",'top=0,left=0,width=1230,height=750');
    })
    resizer();
    $(window).on("resize",resizer);
    function resizer(){
        var headerHeight = $(".fixedHeader").outerHeight();

        //ヘッダーfixed領域確保
        $(".headerTop").syncHeight(".fixedHeader");


        //施工事例ライトボックス位置調整
        $(".lightbox").css("padding-top",headerHeight+"px");

        var ww = window.innerWidth;
        if(769 <= ww){
            //Pc

            //メニュー開いているときにPCサイズになった場合
            $(".headMenuBox").hide();
            $("html").removeClass("menuActive");
            $(".headMenuBox").removeAttr("style");
            $(".menuBtn").removeClass("active");
            $(".header_next").stop(true, true).fadeIn(300);

            $(".menuWrap").removeClass("animainMenu");

            $("footer .menu-item-has-children:not(.open) ul").add("footer .shopListParent + div").removeAttr("style");
            $("footer .menu-item-has-children").add("footer .shopListParent").removeClass("open");
            $("footer .shopListParent").removeClass("open");

            $("header .menu-item-has-children").removeClass("open");


            //ココロトソウTOP
            $(".newArticleText").removeAttr("style");
            $("#newArticle > .newContent1").appendTo("#newArticle .parent_row1");
            $("#newArticle > .newContent2").prependTo("#newArticle .parent_row2");
            $("#newArticle > .newContent3").prependTo("#newArticle .parent_row2 .parent_co2 > .vc_column-inner > .wpb_wrapper");
            $("#newArticle > .newContent4").appendTo("#newArticle .parent_row2 .parent_co2 > .vc_column-inner > .wpb_wrapper");
            $("#newArticle > .newContent5").appendTo("#newArticle .parent_row3 ");


            $(".headMenuBox").removeAttr("style");
        }else{
            //Sp
            // $("footer .shopListParent + div").css("display","none");
            setTimeout(function(){
                $(".menuWrap").addClass("animainMenu");
            },10);

            $(".headMenuBox").css({
                "top":headerHeight+"px",
                "height":"calc(100vh - "+headerHeight+"px)"
            });

        }

        //ココロトソウTOP
        if(480 <= ww && 769 >= ww){
            $(".newContent1").appendTo("#newArticle");
            $(".newContent2").appendTo("#newArticle");
            $(".newContent3").appendTo("#newArticle");
            $(".newContent4").appendTo("#newArticle");
            $(".newContent5").appendTo("#newArticle");
            var hei = 0;
            $(".newArticleText").each(function(){
                if(hei < $(this).find(".newArticleTextInner").outerHeight()){
                    hei = $(this).find(".newArticleTextInner").outerHeight();
                }
            });
            $(".newArticleText").height(hei);
        }
        //ココロトソウTOP
        if(480 >= ww){
            $("#newArticle > .newContent1").appendTo("#newArticle .parent_row1");
            $("#newArticle > .newContent2").prependTo("#newArticle .parent_row2");
            $("#newArticle > .newContent3").prependTo("#newArticle .parent_row2 .parent_co2 > .vc_column-inner > .wpb_wrapper");
            $("#newArticle > .newContent4").appendTo("#newArticle .parent_row2 .parent_co2 > .vc_column-inner > .wpb_wrapper");
            $("#newArticle > .newContent5").appendTo("#newArticle .parent_row3 ");
            $(".newArticleText").removeAttr("style");
        }
    }

    $("header .menu-item-has-children").tap(function(e,me){
        // e.preventDefault();
        var ww = window.innerWidth;
        if(ww <= 768){
            if(me.hasClass("open")){
                me.find("ul").slideUp();
                me.add("header .menu-item-has-children").removeClass("open");
            }else{
                $("header .menu-item-has-children").removeClass("open");
                me.addClass("open");

                $("header .menu-item-has-children:not(.open) ul").slideUp();
                me.find("ul").slideDown();
            }
        }
    });


    //フッターアコーディオン
    $("footer .menu-item-has-children").tap(function(e,me){
        // e.preventDefault();
        var ww = window.innerWidth;
        if(ww <= 768){
            if(me.hasClass("open")){
                me.find("ul").slideUp();
                me.add("footer .shopListParent").removeClass("open");
            }else{
                $("footer .menu-item-has-children").add("footer .shopListParent + div").removeClass("open");
                me.addClass("open");
                $("footer .menu-item-has-children:not(.open) ul").add("footer .shopListParent + div").slideUp();
                me.find("ul").slideDown();
            }
        }
    });

    //事業所一覧アコーディオン
    $("footer .shopListParent").tap(function(e,me){
        // e.preventDefault();
        var ww = window.innerWidth;
        if(ww <= 768){
            if(me.hasClass("open")){
                me.next().slideUp();
                me.removeClass("open");
            }else{
                $("footer .menu-item-has-children").add("footer .shopListParent + div");
                me.addClass("open");
                $("footer .menu-item-has-children:not(.open) ul").add("footer .shopListParent + div").slideUp();
                me.next().slideDown();
            }
        }
    });

    // $("footer .menu-item-has-children > a > span").tap(function(e,me){
    //     // console.log($(this));
    //     location.href = me.parent().attr("href");
    // })



$(".moveTop a").smooth(0);

$(".smoothLink a[href^='#']").tap(function(e,me){
    e.preventDefault();
    $("body,html").animate({scrollTop:$(me.attr("href")).offset().top},1000);
});

$(window).on("scroll",scrollfunc);
function scrollfunc(){
    if(1000 < $(window).scrollTop()){
        $(".moveTop").addClass("active");
    }else{
        $(".moveTop").removeClass("active");
    }
}

if($("html").hasClass("IE")) vcSliderA("sliderContainerA");//IE
$(window).on("load",function(){vcSliderA("sliderContainerA")});

if($("html").hasClass("IE")) vcSliderB("sliderContainerB");//IE
$(window).on("load",function(){vcSliderB("sliderContainerB")});


if($("html").hasClass("IE")) vcsliderContainerFeature("sliderContainerFeature");//IE
$(window).on("load",function(){vcsliderContainerFeature("sliderContainerFeature")});

});

window.addEventListener("pageshow",function(){vcSliderA("sliderContainerA")})
window.addEventListener("pageshow",function(){vcSliderB("sliderContainerB")})
window.addEventListener("pageshow",function(){vcsliderContainerFeature("sliderContainerFeature")})







function vcSliderA(sliderClass){
    var script = document.createElement("script");
    var option = "";
    option += "var option = {";//
    option += "effect:'slide',";//"fade" "flip"//エフェクト指定
    option += "autoplay:{";//
    option += "delay: 4000,";//自動再生待ち時間
    option += "disableOnInteraction: false,";//ユーザーが操作したあと自動再生を止めるか
    option += "},";//
    option += "speed: 1000,";//スライド速度
    option += "loop: true,";//ループ
    option += "loopedSlides:3,";//loopするときに途切れないように余分に表示しておくスライド数
    option += "preventClicks: true,";//
    option += "preventClicksPropagation: true,";//
    option += "allowTouchMove:true,";//スライド操作できるか
    option += "spaceBetween:16,";//スライド間のスペース
    option += "navigation:{";//
    option += "nextEl:'.swiper-button-next',";//
    option += "prevEl:'.swiper-button-prev',";//
    option += "},";//
    option += "slidesPerView:3,";//同時表示枚数
    option += "breakpoints:{";//
    option += "768:{";//
    option += "slidesPerView:2,";//768px以下の時の表示枚数
    option += "},";//
    option += "480:{";//
    option += "slidesPerView:1,";//480px以下の時の表示枚数
    option += "}";//
    option += "}";//
    option += "};";//
    script.innerHTML = option;

    Array.prototype.slice.call(document.querySelectorAll("."+sliderClass),0).forEach(function(slider,i){
        var slideClass = slider.className.replace(sliderClass,sliderClass+"num"+i);
        slider.className = sliderClass+"num"+i+" swiper-container vcSwiper";
        slider.innerHTML = "<div class='swiper-wrapper'>"+slider.innerHTML+"</div>\
        <div class='swiper-button-prev'></div>\
        <div class='swiper-button-next'></div>";
        Array.prototype.slice.call(slider.querySelectorAll(".wpb_column"),0).forEach(function(column,j){
            column.className = "swiper-slide";
        });
        script.innerHTML += "var "+sliderClass+"num"+i+" = new Swiper ('."+sliderClass+"num"+i+"',option);";
        script.innerHTML += "setTimeout(function(){"+sliderClass+"num"+i+".update();},100);";
    });
    document.body.appendChild(script);
}




function vcSliderB(sliderClass){
    var script = document.createElement("script");
    var option = "";
    option += "var option = {";//
    option += "effect:'slide',";//"fade" "flip"//エフェクト指定
    option += "autoplay:{";//
    option += "delay: 4000,";//自動再生待ち時間
    option += "disableOnInteraction: false,";//ユーザーが操作したあと自動再生を止めるか
    option += "},";//
    option += "speed: 1000,";//スライド速度
    option += "loop: true,";//ループ
    option += "loopedSlides:3,";//loopするときに途切れないように余分に表示しておくスライド数
    option += "preventClicks: true,";//
    option += "preventClicksPropagation: true,";//
    option += "allowTouchMove:true,";//スライド操作できるか
    option += "spaceBetween:16,";//スライド間のスペース
    option += "navigation:{";//
    option += "nextEl:'.swiper-button-next',";//
    option += "prevEl:'.swiper-button-prev',";//
    option += "},";//
    option += "slidesPerView:3,";//同時表示枚数
    option += "breakpoints:{";//
    option += "768:{";//
    option += "slidesPerView:2,";//768px以下の時の表示枚数
    option += "},";//
    option += "480:{";//
    option += "slidesPerView:1,";//480px以下の時の表示枚数
    option += "}";//
    option += "}";//
    option += "};";//
    script.innerHTML = option;

    Array.prototype.slice.call(document.querySelectorAll("."+sliderClass),0).forEach(function(slider,i){
        var slideClass = slider.className.replace(sliderClass,sliderClass+"num"+i);
        slider.className = sliderClass+"num"+i+" swiper-container vcSwiper";
        slider.innerHTML = "<div class='swiper-wrapper'>"+slider.innerHTML+"</div>\
        <div class='swiper-button-prev'></div>\
        <div class='swiper-button-next'></div>";
        Array.prototype.slice.call(slider.querySelectorAll(".wpb_column"),0).forEach(function(column,j){
            column.className = "swiper-slide";
        });
        script.innerHTML += "var "+sliderClass+"num"+i+" = new Swiper ('."+sliderClass+"num"+i+"',option);";
        script.innerHTML += "setTimeout(function(){"+sliderClass+"num"+i+".update();},100);";
    });
    document.body.appendChild(script);
}





function vcsliderContainerFeature(sliderClass){
    var script = document.createElement("script");
    var option = "";
    option += "var option = {";//
    option += "effect:'fade',";//"fade" "flip"//エフェクト指定
    option += "autoplay:{";//
    option += "delay: 4000,";//自動再生待ち時間
    option += "disableOnInteraction: false,";//ユーザーが操作したあと自動再生を止めるか
    option += "},";//
    option += "speed: 1000,";//スライド速度
    option += "loop: true,";//ループ
    option += "loopedSlides:1,";//loopするときに途切れないように余分に表示しておくスライド数
    option += "preventClicks: true,";//
    option += "preventClicksPropagation: true,";//
    option += "allowTouchMove:true,";//スライド操作できるか
    // option += "spaceBetween:16,";//スライド間のスペース
    option += "navigation:{";//
    option += "nextEl:'.swiper-button-next',";//
    option += "prevEl:'.swiper-button-prev',";//
    option += "},";//
    option += "slidesPerView:3,";//同時表示枚数
    option += "};";//
    script.innerHTML = option;

    Array.prototype.slice.call(document.querySelectorAll("."+sliderClass),0).forEach(function(slider,i){
        var slideClass = slider.className.replace(sliderClass,sliderClass+"num"+i);
        slider.className = sliderClass+"num"+i+" swiper-container vcSwiper";
        slider.innerHTML = "<div class='swiper-wrapper'>"+slider.innerHTML+"</div>\
        <div class='swiper-button-prev'></div>\
        <div class='swiper-button-next'></div>";
        Array.prototype.slice.call(slider.querySelectorAll(".wpb_column"),0).forEach(function(column,j){
            column.className = "swiper-slide";
        });
        script.innerHTML += "var "+sliderClass+"num"+i+" = new Swiper ('."+sliderClass+"num"+i+"',option);";
        script.innerHTML += "setTimeout(function(){"+sliderClass+"num"+i+".update();},100);";
    });
    document.body.appendChild(script);
}