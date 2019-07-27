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
    <?php if(is_page("contact") || is_page("webcs-answer")){
      //バリデーション
        wp_enqueue_style( 'validation-style', get_stylesheet_directory_uri() . '/assets/library/ValidationEngine/validationEngine.jquery.css', array() , '' );//子ディレクトリ
        wp_enqueue_script( 'validation-script', get_stylesheet_directory_uri() . '/assets/library/ValidationEngine/jquery.validationEngine.js', array('jquery'), '' );//子ディレクトリ
        wp_enqueue_script( 'validation2-script', get_stylesheet_directory_uri() . '/assets/library/ValidationEngine/jquery.validationEngine-ja.js', array('jquery'), '' );//子ディレクトリ
     ?>
      <script>
      jQuery(function($){
        // $(".wpcf7-validates-as-required").addClass("validate[required]").attr("data-prompt-position","bottomLeft");
        $(".validationName").add(".validationTantouName").addClass("validate[required,maxSize[32]]").attr("data-prompt-position","bottomLeft");
        $(".validationNameKana").addClass("validate[required,maxSize[32],custom[kana]]").attr("data-prompt-position","bottomLeft");
        $(".validationMaill").addClass("validate[required,maxSize[50]],custom[email]").attr("data-prompt-position","bottomLeft");
        $(".validationMaillConf").addClass("validate[required,maxSize[50]],equals[mailaddress]").attr("data-prompt-position","bottomLeft");
        $(".validationTel").addClass("validate[minSize[8],maxSize[15],custom[phone]]").attr("data-prompt-position","bottomLeft");



        $(".other_comment1").addClass("validate[maxSize[2000]]").attr("data-prompt-position","bottomLeft");
        $(".other_comment2").addClass("validate[maxSize[2000]]").attr("data-prompt-position","bottomLeft");
        $(".other_comment3").addClass("validate[maxSize[2000]]").attr("data-prompt-position","bottomLeft");
        $(".other_comment4").addClass("validate[maxSize[2000]]").attr("data-prompt-position","bottomLeft");
        $(".other_comment5").addClass("validate[maxSize[2000]]").attr("data-prompt-position","bottomLeft");


        $(".other_1").addClass("validate[maxSize[2000]]").attr("data-prompt-position","bottomLeft");
        $(".other_2").addClass("validate[maxSize[2000]]").attr("data-prompt-position","bottomLeft");
        $(".other_3").addClass("validate[maxSize[2000]]").attr("data-prompt-position","bottomLeft");


        $(".contactvalidationZip").addClass("validate[maxSize[8],custom[streetAddress]]").attr("data-prompt-position","bottomLeft");
        $(".enquetevalidationZip").addClass("validate[required,maxSize[8],custom[streetAddress]]").attr("data-prompt-position","bottomLeft");
        $(".validationStreetAddres").addClass("validate[required,maxSize[80]]").attr("data-prompt-position","bottomLeft");
        $(".wpcf7-form").validationEngine();
      })
    </script>
  <?php } ?>
  <style>
/*    body {
      opacity:0;
      transition:opacity 0.15s linear;
    }
    body.loadvisible{
      opacity:1;
      transition:opacity 0.5s linear;
    }
    */
  </style>
  <?php
  // if(is_home() || is_front_page()){
  //   wp_enqueue_script( 'pace-script', get_template_directory_uri() . '/assets/library/pace/pace.js', array(), '', false );//親テーマディレクトリ
  //   wp_enqueue_style( 'pace-css', get_template_directory_uri() . '/assets/library/pace/pace.css', array(), '', false );//親テーマディレクトリ
  // }
  ?>
</head>
<body <?php body_class(); ?>>
  <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v3.3&appId=683615995018089&autoLogAppEvents=1"></script>
  <script>
//    function fadeO(e){
//        document.body.className = document.body.className.replace(/(loadvisible)/g,"");
//    }
//    function fadeI(e){
//        document.body.className += " loadvisible  ";
//    }

//    window.onbeforeunload = fadeO;
 //   window.addEventListener("pageshow",fadeI);
 //   window.addEventListener("pagehide",fadeO);
  </script>
  <div class="body_inner">
  <header id="masthead" class="site-header" role="banner">
    <div class="headerWrapper">
          <div class="headerTop">
            <div class="fixedHeader">
              <div class="fixedInner maxWidth">
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

                <div class="headerContact">
                  <div class="headerTel">
                    <a href="tel:0120224838" class="ga_header_telSP"><i class="fas fa-phone hidePc"></i><span class="onlyPc">0120-22-4838</span></a><br>
                    <span class="onlyPc">受付時間: 9:00〜17:00（土曜・日曜も受付）</span>
                  </div>
                  <a href="/contact" class="headerMail ga_header_mail">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    <span>メールで問合せする<br>（24時間受付）</span>
                  </a>
                </div>
              </div>
            </div><!--fixedInner-->
          </div><!--fixedHeader-->
          <!--menu-->
          <div class="menuArea">

            <div class="headMenuBox maxWidth">
              <div class="menuWrap">
              <?php wp_nav_menu( array(
                      'theme_location'=>'globalmenu',
                      'container'     =>'',
                      'menu_class'    =>'',
                      'items_wrap'    =>'<ul id="main-nav" class="menu">%3$s</ul>'));
              ?>
              </div>
            </div>


            <div class="menuBtn menuBtnAction">
              <div class="menuBtnInner">
                <div></div>
                <div></div>
                <div></div>
              </div>
            </div>
          </div>
    </div>
    <div class="eyecatchAndBreadcrumb">
       <?php $slug_name = $post->post_name;
        echo do_shortcode( '[eyecatchShow slug=$slug_name]' ); ?>

<?php if($_GET["post_type"] === "cases"){ ?>
  <?php
  $topEyecatchTB = wp_get_attachment_image_src(18664, '');
  $topEyecatchSP = wp_get_attachment_image_src(18663, '');
  $topEyecatch = wp_get_attachment_image_src(5775, '');
   ?>
  <div class="eyecatchWrapper">
  <div class="h1 withEyecatch">
    <div class="h1Wrapper">
      <h1>施工事例検索結果</h1>
    </div>
  </div>
  <div class="eycatch">
   <div class="imageBox">
   <div class="image hideSp hideTb" style="background-image:url(<?=$topEyecatch[0]?>)"></div><!--/.image-->
   <div class="image hideTb hidePc" style="background-image:url(<?=$topEyecatchSP[0]?>)"></div><!--/.image-->
   <div class="image hideSp hidePc" style="background-image:url(<?=$topEyecatchTB[0]?>)"></div><!--/.image-->
   </div><!--/.imageBox-->
  </div><!--/.eyecatch-->
  </div>
<?php } ?>
<?php if(is_singular("cases")){ ?>
  <?php
  $topEyecatchTB = wp_get_attachment_image_src(18664, '');
  $topEyecatchSP = wp_get_attachment_image_src(18663, '');
  $topEyecatch = wp_get_attachment_image_src(5775, '');
   ?>
  <div class="eyecatchWrapper">
  <div class="h1 withEyecatch">
    <div class="h1Wrapper">
      <h1>施工事例詳細</h1>
    </div>
  </div>
  <div class="eycatch">
   <div class="imageBox">
   <div class="image hideSp hideTb" style="background-image:url(<?=$topEyecatch[0]?>)"></div><!--/.image-->
   <div class="image hideTb hidePc" style="background-image:url(<?=$topEyecatchSP[0]?>)"></div><!--/.image-->
   <div class="image hideSp hidePc" style="background-image:url(<?=$topEyecatchTB[0]?>)"></div><!--/.image-->
   </div><!--/.imageBox-->
  </div><!--/.eyecatch-->
  </div>
<?php } ?>

<?php if(is_category("media")){ ?>
  <?php
  $topEyecatchTB = wp_get_attachment_image_src(18819, '');
  $topEyecatchSP = wp_get_attachment_image_src(18818, '');
  $topEyecatch = wp_get_attachment_image_src(18817, '');
  $category = get_the_category();
  $cat_name = $category[0]->cat_name;
   ?>
  <div class="eyecatchWrapper">
  <div class="h1 withEyecatch">
    <div class="h1Wrapper">
      <h1><?php echo $cat_name; ?></h1>
    </div>
  </div>
  <div class="eycatch">
   <div class="imageBox">
   <div class="image hideSp hideTb" style="background-image:url(<?=$topEyecatch[0]?>)"></div><!--/.image-->
   <div class="image hideTb hidePc" style="background-image:url(<?=$topEyecatchSP[0]?>)"></div><!--/.image-->
   <div class="image hideSp hidePc" style="background-image:url(<?=$topEyecatchTB[0]?>)"></div><!--/.image-->
   </div><!--/.imageBox-->
  </div><!--/.eyecatch-->
  </div>
<?php } ?>

<?php if(is_category("news")){ ?>
  <?php
  $topEyecatchTB = wp_get_attachment_image_src(18832, '');
  $topEyecatchSP = wp_get_attachment_image_src(18831, '');
  $topEyecatch = wp_get_attachment_image_src(18830, '');
  $category = get_the_category();
  $cat_name = $category[0]->cat_name;
   ?>
  <div class="eyecatchWrapper">
  <div class="h1 withEyecatch">
    <div class="h1Wrapper">
      <h1><?php echo $cat_name; ?></h1>
    </div>
  </div>
  <div class="eycatch">
   <div class="imageBox">
   <div class="image hideSp hideTb" style="background-image:url(<?=$topEyecatch[0]?>)"></div><!--/.image-->
   <div class="image hideTb hidePc" style="background-image:url(<?=$topEyecatchSP[0]?>)"></div><!--/.image-->
   <div class="image hideSp hidePc" style="background-image:url(<?=$topEyecatchTB[0]?>)"></div><!--/.image-->
   </div><!--/.imageBox-->
  </div><!--/.eyecatch-->
  </div>
<?php } ?>

<?php if(is_singular("post")){ ?>
  <div class="eyecatchWrapper">
  <div class="h1 withEyecatch">
    <div class="h1Wrapper">
      <?php
      $categories = get_the_category();
        foreach ( $categories as $category ) {
          if($category->category_nicename == "news"){
            $topEyecatchTB = wp_get_attachment_image_src(18832, '');
            $topEyecatchSP = wp_get_attachment_image_src(18831, '');
            $topEyecatch = wp_get_attachment_image_src(18830, '');
            echo "<h1>".$category->cat_name."</h1>";
            break;
          }elseif($category->category_nicename == "media"){
            $topEyecatchTB = wp_get_attachment_image_src(18819, '');
            $topEyecatchSP = wp_get_attachment_image_src(18818, '');
            $topEyecatch = wp_get_attachment_image_src(18817, '');
            echo "<h1>".$category->cat_name."</h1>";
            break;
          }
        }
         ?>
    </div>
  </div>
  <div class="eycatch">
   <div class="imageBox">
   <div class="image hideSp hideTb" style="background-image:url(<?=$topEyecatch[0]?>)"></div><!--/.image-->
   <div class="image hideTb hidePc" style="background-image:url(<?=$topEyecatchSP[0]?>)"></div><!--/.image-->
   <div class="image hideSp hidePc" style="background-image:url(<?=$topEyecatchTB[0]?>)"></div><!--/.image-->
   </div><!--/.imageBox-->
  </div><!--/.eyecatch-->
  </div>
<?php } ?>

      <!-- breadcrumb  -->
        <div class="breadcrumbWrapper maxWidth">
          <?php breadcrumb(); ?>
        </div>
    </div>
  </header>
  <div class="header_next">
  <!-- .site-header -->
