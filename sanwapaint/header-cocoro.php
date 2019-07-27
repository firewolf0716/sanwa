<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
    <script data-ViewPortSetting>
  viewportSetting(1024);//meta viewportを作成

  function viewportSetting(contentWidth){
    var viewport = document.createElement("meta");
    viewport.name = "viewport";
    var viewScript = document.querySelector("[data-viewportSetting]");
    if(769 <= screen.width && screen.width <= contentWidth-1){
      viewport.content = "width="+contentWidth;
    }else{
      viewport.content = "width=device-width, initial-scale=1.0";
    }
    viewScript.parentNode.insertBefore(viewport,viewScript);
  }
  </script>
  <?php if (is_mobile()) { ?>
  <meta name="format-detection" content="telephone=no,address=no,email=no">
  <?php } else { }?>
  <link rel="profile" href="http://gmpg.org/xfn/11">

  <?php
  //canonicalタグ
  $http = is_ssl() ? 'https' . '://' : 'http' . '://';
  //www.付ける $http = is_ssl() ? 'https' : 'http' . '://www.';
  //www.外す $http = str_replace("www.","",$http);
  $url = $http . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
  echo '<link rel="canonical" href="'.$url.'">';
  ?>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <?php wp_head(); ?>
  <script language="JavaScript">
  //fileName
  document.documentElement.className += location.pathname.split("/").pop() ? " page-" + location.pathname.split("/").pop().split(".")[0] + " " : " page-index ";
  //Platform
  document.documentElement.className += " " + platform.name.replace(/ |\/|\./g, "-") + " browserVer" + platform.version.replace(/ |\/|\./g, "-") + " " + platform.os.family.replace(/ |\/|\./g, "-") + " osVer" + platform.os.version.replace(/ |\/|\./g, "-");
  document.documentElement.className += !/(iOS|Android)/.test(document.documentElement.className) ? " Pc " : " Mb ";
  </script>
    <?php if(is_page()){ ?>
      <script>
      jQuery(function($){
        // $(".wpcf7-validates-as-required").addClass("validate[required]").attr("data-prompt-position","bottomLeft");
        $(".validationName").addClass("validate[required,maxSize[32]]").attr("data-prompt-position","bottomLeft");
        $(".validationNameKana").addClass("validate[required,maxSize[32]]").attr("data-prompt-position","bottomLeft");
        $(".validationMaill").addClass("validate[required,maxSize[50]],custom[email]").attr("data-prompt-position","bottomLeft");
        $(".validationTel").addClass("validate[required,minSize[8],maxSize[15],custom[phone]]").attr("data-prompt-position","bottomLeft");

        $(".wpcf7-form").validationEngine();
      })
    </script>
  <?php } ?>
  <style>
  </style>
  <?php
  if(is_singular("cocorotosou")):
  $description = $post->post_content;
  $description = do_shortcode($description);
  $description = str_replace(array("\r\n","\r","\n","&nbsp;"),'',$description);/*改行を全て削除して1行にする*/
  $description = wp_strip_all_tags($description);/*タグ消す*/
  // $description = preg_replace('/\[.*\]/','',$description);/*ショートコードが入った場合にも取り除く*/
  $description = mb_strimwidth($description,0,220,"...");/*日本語の1文字＝半角0.5文字×2になるのでこのように必要な文字数「110文字×2」という指定になります。*/
  ?>
  <meta name="description" content="<?php echo $description; ?>">
<?php endif; ?>
</head>
<body <?php body_class(); ?>>
    <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v3.3&appId=683615995018089&autoLogAppEvents=1"></script>
  <div class="body_inner">
  <header id="masthead" class="site-header cocoroheader" role="banner">
    <div class="headerWrapper">

      <div class="headerTop flex maxWidth">
        <!-- site-branding -->
        <?php echo do_shortcode('[sns]'); ?>
        <div class="site-branding">
            <h1 class="site-title">
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>/cocorotosou" rel="home">
                <div class="imageBox">
                  <div class="image">
                      <img class="hideSp" src="<?php echo content_url();?>/uploads/2019/07/_-_-_cocoroPc.png" alt="<?php echo $description ?>">
                      <img class="onlySp" src="<?php echo content_url();?>/uploads/2019/07/_-_-_cocoroSp.png">

                  </div><!--end image-->
                </div><!--end imageBox-->
                </a>
            </h1>
        </div>
        <div class="dummy"></div>
        <!-- .site-branding -->
    </div>

    <!--menu-->
    <div class="menuArea">

      <div class="headMenuBox maxWidth">
        <div class="menuWrap">
        <?php wp_nav_menu( array(
                'theme_location'=>'cocorotosou',
                'container'     =>'',
                'menu_class'    =>'',
                'items_wrap'    =>'<ul id="main-nav" class="menu">%3$s</ul>'));
        ?>
        </div>
      </div>
      <div class="menuBtn menuBtnAction2">
        <div class="menuBtnInner">
          <div></div>
          <div></div>
          <div></div>
        </div>
      </div>
    </div>


<!--     <div class="eyecatchAndBreadcrumb">
       <?php $slug_name = $post->post_name;
           // echo do_shortcode( '[eyecatchShow slug=$slug_name]' ); ?>
    </div> -->
  </div>
  </header>
  <div class="header_next">
    <!-- breadcrumb  -->
      <div class="breadcrumbWrapper maxWidth">
        <?php if(!is_page("cocorotosou")): ?>
          <?php breadcrumb(); ?>
        <?php endif; ?>
      </div>

  <!-- .site-header -->
