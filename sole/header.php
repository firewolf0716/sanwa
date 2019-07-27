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
  $http = is_ssl() ? 'https'  . '://': 'http' . '://';
  //www.付ける $http = is_ssl() ? 'https' : 'http' . '://www.';
  //www.外す $http = str_replace("www.","",$http);
  $url = $http . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
  echo '<link rel="canonical" href="'.$url.'">';
  ?>

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
        $(".wpcf7-validates-as-required").addClass("validate[required]");//.attr("data-prompt-position","inline");
        $(".birthday input")
        .add(".birthday select")
        .addClass("validate[required]");//.attr("data-prompt-position","inline");
        $(".wpcf7-form").validationEngine({'custom_error_messages':{
            ".validate[required]":{
              "required":{
                "message":"必須項目です"
              }
            }
          }
        });
      })
    </script>
  <?php } ?>
  
</head>

<body <?php body_class(); ?>>
  <header id="masthead" class="site-header" role="banner">
    <div class="headerWrapper maxWidth">
      <!-- site-branding -->
      <div class="site-branding">
          <?php
            $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) : ?>
          <h1 class="site-description">
            <?php echo $description; ?>
          </h1>
          <?php endif;
          ?>
          <h1 class="site-title">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
              <?php
                $get_the_logo_img_url = get_the_logo_img_url();
                $description = get_bloginfo( 'description', 'display' );

                if(empty($get_the_logo_img_url)){//ロゴ未設定時
                  bloginfo( 'name' );
                  }
                else{//ロゴ設定時
                  echo '<img src="'. get_the_logo_img_url() . '" alt="' . $description . '" />';
                  }
              ;?>
              </a>
          </h1>
      </div>
      <!-- .site-branding -->
      <!-- <div class="head_logo">
        <a href="<?php //echo home_url(); ?>" ><img class="imgRes" src="<?php //echo get_the_logo_img_url();?>"></a>
      </div> -->
        <!--menu-->
        <div class="menuArea">
          
          <div class="headMenuBox">
            <div class="menuWrap">
            <?php wp_nav_menu( array(
                    'theme_location'=>'globalmenu',
                    'container'     =>'',
                    'menu_class'    =>'',
                    'items_wrap'    =>'<ul id="main-nav" class="menu">%3$s</ul>'));
            ?>
            </div>
          </div>


          <div class="menuBtn">
            <div class="menuBtnInner">
              <div></div>
              <div></div>
              <div></div>
            </div>
          </div>
        </div>


        <?php //echo do_shortcode( '[sns]' ) ?>
    </div>
  </header>
  <!-- .site-header -->

  <!-- breadcrumb  -->

    <div class="breadcrumbWrapper">
      <?php breadcrumb(); ?>
    </div>


