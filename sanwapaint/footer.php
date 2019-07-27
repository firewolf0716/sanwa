
<div class="moveTop">
  <a href=""><i class="fa fa-angle-up" aria-hidden="true"></i></a>
</div>


<footer id="footer" class="site-footer " role="contentinfo">

  <div class="footerLogo maxWidth">
    <h1 class="site-title">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
        <?php
          $get_the_logo_img_url = get_the_logo_img_url();

          if(empty($get_the_logo_img_url)){//ロゴ未設定時
            bloginfo( 'name' );
            }
          else{//ロゴ設定時
            echo '<img src="'. get_the_logo_img_url() . '" alt="' . $description . '" />';
            }
        ?>
        </a>
    </h1>
  </div>

  <div class="borderDiv"></div>

  <div class="footerMenu maxWidth">
    <?php wp_nav_menu( array(
            'theme_location'=>'footer_menu1',
            'container'     =>'',
            'menu_class'    =>'',
            'items_wrap'    =>'<ul class="footer_menu fm1">%3$s</ul>'));
    ?>
    <?php wp_nav_menu( array(
            'theme_location'=>'footer_menu2',
            'container'     =>'',
            'menu_class'    =>'',
            'items_wrap'    =>'<ul class="footer_menu fm2">%3$s</ul>'));
    ?>
    <?php wp_nav_menu( array(
            'theme_location'=>'footer_menu3',
            'container'     =>'',
            'menu_class'    =>'',
            'items_wrap'    =>'<ul class="footer_menu fm3">%3$s</ul>'));
    ?>
    <?php wp_nav_menu( array(
            'theme_location'=>'footer_menu4',
            'container'     =>'',
            'menu_class'    =>'',
            'items_wrap'    =>'<ul class="footer_menu fm4">%3$s</ul>'));
    ?>
  </div>

  <div class="borderDiv"></div>

  <div class="footerSideberBox maxWidth">
    <div class="shopListParent hidePc"><a href="/officelist">事業所一覧</a></div>
    <div id="footerSideber">
      <div id="footerSidebar01" class="">
        <?php dynamic_sidebar('footerSidebar01');?>
      </div>
      <div id="footerSidebar02" class="">
        <?php dynamic_sidebar('footerSidebar02');?>
      </div>
    </div>
  </div>

  <div class="borderDiv"></div>

  <div class="copyrightArea maxWidth">
    <div class="copyrightAreaWrapeer">
      <div class="copyrightAreaInner">
        <span><a href="/">&copy SANWAPAINT CORP.</a></span>
       <?php wp_nav_menu( array(
               'theme_location'=>'footer_menu5',
               'container'     =>'',
               'menu_class'    =>'',
               'items_wrap'    =>'<ul class="copyright_menu">%3$s</ul>'));
       ?>
     </div>
    </div>
  </div><!--/#subFooter -->

</footer><!--/#colophon -->


<?php wp_footer(); ?>

</div>
</div>

<script> Splitting(); </script>
<script type="text/javascript">

var wpcf7c_step1 = function(unit_tag){
  // 確認完了

  // 対象フォーム検索
    //var elm_unit_tag = jQuery.find("input[name=_wpcf7_unit_tag]");
    jQuery(jQuery.find("input[name=_wpcf7_unit_tag]")).each(function(){
      if(jQuery(this).val() == unit_tag) {
        var parent = jQuery(this).parents("form");


        var responseOutput = parent.find('div.wpcf7-response-output');
        responseOutput.addClass("wpcf7c-force-hide");

        // 確認画面表示
        // テキストエリアを伸ばす
        parent.find("textarea").each(function(){
          if(this.scrollHeight > this.offsetHeight){
            this.style.height = (this.scrollHeight + 10) + 'px';
          }
        });
        parent.find("textarea").attr("readonly", true).addClass("wpcf7c-conf");
        parent.find("select").each(function(){
          jQuery(this).attr("readonly", true).attr("disabled", true).addClass("wpcf7c-conf");
          jQuery(this).after(
            jQuery('<input type="hidden" />').attr("name", jQuery(this).attr("name")).val(jQuery(this).val()).addClass("wpcf7c-conf-hidden")
          );
        });
        parent.find("input").each(function(){
          switch(jQuery(this).attr("type")) {
            case "submit":
            case "button":
            case "hidden":
            case "image":
              // なにもしない
              break;
            case "radio":
            case "checkbox":
              // 選択されているものだけ対処
              jQuery(this).attr("readonly", true).attr("disabled", true).addClass("wpcf7c-conf");
              if(jQuery(this).is(":checked")) {
                jQuery(this).after(
                  jQuery('<input type="hidden" />').attr("name", jQuery(this).attr("name")).val(jQuery(this).val()).addClass("wpcf7c-conf-hidden")
                );
              }
              break;
            case "file":
              jQuery(this).attr("readonly", true).addClass("wpcf7c-elm-step1").addClass("wpcf7c-force-hide");
              jQuery(this).after(
                jQuery('<input type="text" />').attr("name", (jQuery(this).attr("name") + "_conf")).val(jQuery(this).val()).addClass("wpcf7c-conf-hidden").addClass("wpcf7c-conf").attr("readonly", true).attr("disabled", true)
              );

              break;
            default:
              jQuery(this).attr("readonly", true).addClass("wpcf7c-conf");
              jQuery(this).after(
                jQuery('<input type="hidden" />').attr("name", jQuery(this).attr("name")).val(jQuery(this).val()).addClass("wpcf7c-conf-hidden")
              );
              break;
          }
        });

        // 表示切替
        parent.find(".wpcf7c-elm-step1").addClass("wpcf7c-force-hide");
        parent.find(".wpcf7c-elm-step3").addClass("wpcf7c-force-hide");
        parent.find(".wpcf7c-elm-step2").removeClass("wpcf7c-force-hide");

        parent.find(".ajax-loader").removeClass("wpcf7c-force-hide");

        parent.find("input[name=_wpcf7c]").val("step2");

        // スムーズスクロール
        setTimeout(function() { wpcf7c_scroll(unit_tag) }, 100);
      }
    });
  }

  //その他チェック入れる
  jQuery(function($){

    $('.wpcf7').on( 'wpcf7mailsent ', function() {
        $("body,html").animate({scrollTop:$(".entry-content").offset().top},100);
    });


    $("input[class*='otherset']").on("input",function(){
      var cls = $(this).attr("class").match(/otherset[0-9][0-9]?/)[0];

      // console.log($(this).attr("class").match(/otherset[0-9][0-9]?/)[0]);
      // console.log("#"+cls+" .last input");
      if($(this).val() != ""){
        $("."+cls+" .last input").prop("checked",true);
      }else{
        $("."+cls+" .last input").prop("checked",false);
      }
    });

    $(".otherTEXT input").on("input",function(){
      if($(this).val() != ""){
        $(this).closest(".otherTEXT").prev().find("input").prop("checked",true);
      }else{
        $(this).closest(".otherTEXT").prev().find("input").prop("checked",false);
      }
    });
  })


  <?php if(is_page(array("contact","webcs-answer"))): ?>
  jQuery(function($){
    var selectbox = $('select[name=branch]');
    selectbox.children().first().remove();
  })
  <?php endif; ?>
  // var wpcf7c_scroll = function(unit_tag) {  }
</script>
</body>

</html>
