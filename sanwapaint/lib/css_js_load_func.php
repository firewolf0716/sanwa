<?php
//001900

//読み込み停止
function my_delete_local_jquery() {
  wp_deregister_script( 'prettyphoto' );
  wp_enqueue_script( 'prettyphoto', get_template_directory_uri().'/assets/library/prettyphoto/js/jquery.prettyPhoto.min.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'my_delete_local_jquery' );

// jQuery読み込みを停止
function register_common_script() {
  if (!is_admin()){
    // $script_dir = get_template_directory_uri();
    if(!is_page_template( 'page-form.php' ) ){
      wp_deregister_script( 'jquery' );
      if (is_page( 'cs' )) {
        wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js' , array(), '1.9.1', false);
      }else{
        wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.1.1.min.js' , array(), '3.1.1', false);
      }

    }
  }
}
add_action('wp_enqueue_scripts','register_common_script');


//おおた追加
//common.css　全ページ読み込み
function add_files_css() {

  // original Font
  wp_enqueue_style('nanairo-icomoon', get_template_directory_uri(). '/assets/icomoon/style.css' );//親ディレクトリ
  // サイト共通のCSSの読み込み
  //プラグインの有効化を確認
  global $vc_plugin_activated;
  if(is_plugin_active($vc_plugin_activated) ){

    wp_enqueue_style('parent-nanairo-style', get_template_directory_uri(). '/assets/library/css/parent-style.css' , array('js_composer_front') , '1.0.0' , false);//親ディレクトリ
  }
  else{
      wp_enqueue_style('parent-nanairo-style', get_template_directory_uri(). '/assets/library/css/parent-style.css' , array('nanairo-icomoon') , '1.0.0' , false);//親ディレクトリ
  }
  //wacuCm
  wp_enqueue_style('nanairo-wacuCm', get_template_directory_uri().'/assets/wacu/css/wacu.min.css' , array('parent-nanairo-style') , '1.0.0' , false);//親ディレクトリ
  wp_enqueue_style( 'nanairo-swiper-style', get_template_directory_uri( ).'/assets/library/swiper/swiper.min.css' , array(), '4.1.0' );//親ディレクトリ


  wp_enqueue_style( 'parts-style', get_stylesheet_directory_uri() . '/assets/page/partsStyle.css', array('nanairo-wacuCm') , '' );//子ディレクトリ
  /*ココロトソウ 切り分け*/
  if(is_page_template("page-cocoroTop.php") || is_page_template("page-cocorosecond.php") || is_tax("cocorotosous") || is_tax("cocorotosou_tag") || is_singular("cocorotosou")){
    wp_enqueue_style( 'cocoro-common-style', get_stylesheet_directory_uri() . '/assets/page/cocoro_style.css', array('nanairo-wacuCm') , '' );//子ディレクトリ
    wp_enqueue_script( 'cocoro-script', get_stylesheet_directory_uri() . '/assets/page/cocoro_script.js', array(), '', true );//子ディレクトリ
  }else{
    wp_enqueue_style( 'common-css', get_stylesheet_directory_uri() . '/assets/page/common_style.css', array('nanairo-wacuCm') , '20171127' );
  }


  wp_enqueue_style( 'common-css2', 'https://unpkg.com/splitting/dist/splitting.css', array() , '' );
  wp_enqueue_style( 'common-css3', 'https://unpkg.com/splitting/dist/splitting-cells.css', array() , '' );
  is_frontpage_lib();//フロントページ時//子ディレクトリ

  is_page_lib();
  templateCSS();
  is_single_lib();
  is_lists_lib();
  is_oldvoice_oldsurvey_lib();

}
add_action('wp_enqueue_scripts', 'add_files_css');
////////common.css　全ページ読み込み


function add_files_script() {
  //platform.js
  wp_enqueue_script('nanairo-platform', get_template_directory_uri().'/assets/library/js/platform.js', array(), '1.0.0' , false);//親ディレクトリ
  //fontawesome
  wp_enqueue_script( 'nanairo-fontawesome', 'https://use.fontawesome.com/9e7b2dca0f.js');
  //jquery.scrollTo
  //wp_enqueue_script( 'nanairo-jqueryScrollto', get_stylesheet_directory_uri( '/assets/library/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', false );
  //swipter
  wp_enqueue_script( 'nanairo-swiper-js', get_template_directory_uri(  ).'/assets/library/swiper/swiper.min.js', array('jquery'), '4.1.0',false );//親ディレクトリ
  wp_enqueue_script( 'nanairo-extension-js', get_template_directory_uri().'/assets/library/js/funcs.js', array('jquery'), '2.1.3', false);
  // サイト共通JS//親ディレクトリ
  wp_enqueue_style( 'lightbox-css', get_stylesheet_directory_uri() . '/assets/library/lightbox/css/lightbox.min.css', array('nanairo-wacuCm') , '' );//子ディレクトリ
  wp_enqueue_script( 'lightbox-js', get_stylesheet_directory_uri() . '/assets/library/lightbox/js/lightbox.min.js', array(), '', true );//子ディレクトリ

  wp_enqueue_script( 'ajaxzip-script', get_stylesheet_directory_uri() . '/assets/library/yubinbango.js', array(), '', true );//子ディレクトリ
  // if (!is_page( 'cs' )) {
    wp_enqueue_script( 'common-script', get_stylesheet_directory_uri() . '/assets/page/common_script.js', array(), '20171127', true );//子ディレクトリ
  // }

  wp_enqueue_script( 'splitting', 'https://unpkg.com/splitting/dist/splitting.min.js');

}
add_action('wp_enqueue_scripts','add_files_script');



function is_frontpage_lib(){
  if ( is_front_page() ) { // 固定ページでのトップページの場合
      $frontpagefilename = get_stylesheet_directory() . '/assets/page/frontpage.css';
      if(file_exists($frontpagefilename)){
        wp_enqueue_style('style-frontpage', get_stylesheet_directory_uri() . '/assets/page/frontpage.css');//子ディレクトリ
        wp_enqueue_script( 'js-frontpage', get_stylesheet_directory_uri( ) .'/assets/page/frontpage.js', array('jquery' ), '1.0.0', true );//子ディレクトリ
      }
    }
}




//固定ページのとき
function is_page_lib(){
  global $post;
  global $pattern_file;
  global $browser;
  global $filename;

  if ( is_page() ){
    //frontpage以外の固定ページの場合
    $pageSlug = get_page(get_the_ID());
    $page = get_page(get_the_ID());
    $slug = $page->post_name;
    $filename = get_stylesheet_directory().'/assets/page/' . $slug .  '.css';
    $filename_js = get_stylesheet_directory().'/assets/page/' . $slug .  '.js';


    $pageSlug = get_page_uri($post->ID);
    $slugfilename = get_stylesheet_directory().'/assets/page/' .$pageSlug . '.css';

    if(file_exists($filename)){
      wp_enqueue_style('style-eachpage',get_stylesheet_directory_uri().'/assets/page/' . $slug  . '.css' , array() , '1.0.0' , false);//子ディレクトリ
    }
    if(file_exists($filename_js)){
      wp_enqueue_script( 'js-eachpage', get_stylesheet_directory_uri().'/assets/page/' . $slug  . '.js', array('jquery' ), '1.0.0', true );//子ディレクトリ
    }

    // else{
    //孫以降の処理
    // $pageSlug = $page = get_page(get_the_ID());

    // if($post -> post_parent != 0 ){
    //   $ancestors = array_reverse(get_post_ancestors( $post->ID ));
    //   foreach($ancestors as $ancestor){
    //     $slugcss = get_post($ancestor)->post_name;
    //     if(file_exists($filename)){
    //       wp_enqueue_style('style-child-page', get_stylesheet_directory_uri().'/assets/page/'  . $slugcss  . '.css' , array() , '1.0.0' , false);
    //       wp_enqueue_script( 'js-child-page', get_stylesheet_directory_uri().'/assets/page/' . $slugcss  . '.css', array('jquery' ), '1.0.0', false );
    //     }
    //   }
    // }else{
      //トップから見ての子ページの処理
      if(file_exists($filename)){}
      elseif(file_exists($slugfilename)){
        if(file_exists(get_stylesheet_directory_uri().'/assets/page/'. get_page_uri($post->ID) . '.css'))wp_enqueue_style('style-slugfilename', get_stylesheet_directory_uri().'/assets/page/'. get_page_uri($post->ID) . '.css' , array() , '1.0.0' , false);//子ディレクトリ
        if(file_exists(get_stylesheet_directory_uri().'/assets/page/'. get_page_uri($post->ID) . '.js'))wp_enqueue_script( 'js-slugfilename', get_stylesheet_directory_uri().'/assets/page/' . get_page_uri($post->ID) . '.js', array('jquery' ), '1.0.0', true );//子ディレクトリ
      }
    // }
  }

  if ( is_page('cs') ) {
    wp_enqueue_style('csquestionnaire-css', get_stylesheet_directory_uri() . '/assets/page/csquestionnaire.css');
    wp_enqueue_style('cs_expand-css', get_stylesheet_directory_uri() . '/assets/page/cs_expand.css');

    wp_enqueue_script( 'js-ce-modernizr', get_stylesheet_directory_uri().'/assets/page/cs_expand_modernizr.js', array('jquery' ), '1.0.0', true );
    wp_enqueue_script( 'js-ce-grid', get_stylesheet_directory_uri().'/assets/page/cs_expand_grid.js', array('jquery' ), '1.0.0', true );
  }

  if ( is_page('webcs-answer') ) {
    wp_enqueue_style('webcsquestionnaire-css', get_stylesheet_directory_uri() . '/assets/page/webcsquestionnaire.css');
  }

  if(is_page('simple-estimation-result') || is_page('simple-estimation')){
    wp_enqueue_style('estimation-css', get_stylesheet_directory_uri() . '/assets/page/estimation.css');
  }

  if(is_singular('cases') || is_search() || is_page('sanwa-search-page') || is_post_type_archive('cases')){
    wp_enqueue_style('single-csaes-css', get_stylesheet_directory_uri() . '/assets/page/cases.css');
  }

  if(is_page('webcs-answer') || is_page('contact')){
    wp_enqueue_style('cf7-form-css', get_stylesheet_directory_uri() . '/assets/page/cf7-form.css');
  }
}

//詳細ページのとき
function is_single_lib(){
  wp_enqueue_style('custom-common-css', get_stylesheet_directory_uri() . '/assets/page/custom_common.css');
}

//一覧ページのとき
function is_lists_lib(){

}

//旧施工事例・旧アンケートのとき
function is_oldvoice_oldsurvey_lib(){
  if(is_tax("oldvoices") || is_singular("oldvoice")){
    /*旧施工事例*/
    wp_enqueue_style('oldvoice-css', get_stylesheet_directory_uri() . '/assets/page/oldvoice.css');
  }
  if(is_tax("oldsurveys") || is_singular("oldsurvey")){
    /*旧アンケート*/
    wp_enqueue_style('oldsurvey-css', get_stylesheet_directory_uri() . '/assets/page/oldsurvey.css');
  }
}



// function free_page_lib(){//臨機応変に追加用
//
// }

function templateCSS(){
  if ( is_page_template( 'page-form.php' ) ){
    wp_enqueue_style('template-css-form', get_stylesheet_directory_uri() . '/assets/template/form.css');//子ディレクトリ
  }
}




// //00200 cssとjsの読み込み
//   function nanairo_scripts()
//     {

//     //Fundamental CSS & JS
//     //ie9
//     if ( is_customize_preview() ) {
//       wp_enqueue_style( 'nanairo-ie9', get_stylesheet_directory_uri( '/assets/library/css/ie9.css' ), array( 'nanairo-wacuCm' ), '1.0' );
//       wp_style_add_data( 'nanairo-ie9', 'conditional', 'IE 9' );
//     }

//     // // Load the Internet Explorer 8 specific stylesheet.
//     // wp_enqueue_style( 'nanairo-ie8', get_stylesheet_directory_uri( '/assets/library/css/ie8.css' ), array( 'nanairo-wacuCm' ), '1.0' );
//     // wp_style_add_data( 'nanairo-ie8', 'conditional', 'lt IE 9' );
//     //
//     // // Load the html5 shiv.
//     // wp_enqueue_script( 'nanairo-html5', get_stylesheet_directory_uri( '/assets/library/js/html5.js' ), array(), '3.7.3' );
//     // wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );



//     //jQuery.js
//     //wp_enqueue_script('nanairo-jquery3.1.1', 'https://code.jquery.com/jquery-3.1.1.min.js' , array(), '3.1.1', false);


//  //jsPc
//     // wp_enqueue_script( 'nanairo-jsPc', get_theme_file_uri( '/assets/library/js/jsPc.js' ), array( 'jquery' ), '2.1.2', true );


//     // if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
//     //   wp_enqueue_script( 'comment-reply' );
//     // }
// }
//   add_action( 'wp_enqueue_scripts', 'nanairo_scripts' );
