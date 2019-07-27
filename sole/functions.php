<?php

//00100 デバイスの切り分け
  /*Mobile_Detectの読み込み*/
  require_once 'assets/Mobile_Detect/Mobile_Detect.php' ;

  // 判別
      // タブレットの場合
      $detect = new Mobile_Detect ;
      if( $detect->isTablet() )
      {
          // 処理
          $browser = 'Tb' ;
          $viewport = '<meta name="viewport" content="width=1280,user-scalable=no">';
          $forBody="tb";
      }
      // スマホの場合
      elseif( $detect->isMobile() )
      {
          // 処理
          $browser = 'Sp' ;
          $viewport = '<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes">';
          $forBody="sp";
      }
      // デスクトップの場合
      else
      {
          // 処理
          $browser = 'Pc';
          $viewport = '<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">';
          $forBody = "pc";
      }







//00300 「テーマで wp_title() を呼び出すことはできません。」対策
  add_theme_support( 'title-tag' );



//00400 wp_head()の内容で不必要なものを消す
  remove_action('wp_head', 'feed_links', 2);
  remove_action('wp_head', 'feed_links_extra', 3);
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'rel_canonical');
  remove_action('wp_head', 'index_rel_link');
  remove_action('wp_head', 'parent_post_rel_link', 10, 0);
  remove_action('wp_head', 'start_post_rel_link', 10, 0);
  remove_action('wp_head', 'wp_shortlink_wp_head');
  // Since 4.4
  remove_action('wp_head','wp_oembed_add_discovery_links');
  remove_action('wp_head','rest_output_link_wp_head');





//00500　contents width assign コンテンツ幅（大）の設定
  if ( ! isset( $content_width ) )
  {
    $content_width = 640;
  }



//00600 Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );



//00700 サムネイル
  add_theme_support( 'post-thumbnails' );
  add_image_size( 'thumbnail-profile', 400, 400, true );
  add_image_size( 'thumb75', 75, 75, true);
  add_image_size( 'thumb480360', 480, 360, true );
  add_image_size( 'thumb180120', 180, 120, true );
  add_image_size( 'thumb480280', 480, 280, true );
  add_image_size( 'thumb480480', 480, 480, false );


//00800 サイドバー
  //top サイドバー追加 v.1.0.5
  add_action( 'widgets_init', 'topSidebar_init' );
    function topSidebar_init() {
        register_sidebar( array(
          'name' => __('TOPページ用サイドバー'),
          'id' => 'topsidebar',
          'description' => __('TOPページ用サイドバーです'),
          'before_widget' => '<aside id="%1$s" class="top-side-bar widget %2$s">',
          'after_widget' => '</aside>',
          'before_title' => '<div class=""></div><h3>',
          'after_title' => '</h3>',
        ) );
    }


  //フッター サイドバー01追加
  add_action( 'widgets_init', 'footerSidebar01_init' );
    function footerSidebar01_init() {
        register_sidebar( array(
          'name' => __('フッター用サイドバー01'),
          'id' => 'footersidebar01',
          'description' => __('フッター用サイドバー01です'),
          'before_widget' => '<aside id="%1$s" class="footer-side-bar widget %2$s">',
          'after_widget' => '</aside>',
          'before_title' => '<div class=""></div><h3>',
          'after_title' => '</h3>',
        ) );
    }

  //フッター サイドバー02追加
  add_action( 'widgets_init', 'footerSidebar02_init' );
    function footerSidebar02_init() {
        register_sidebar( array(
          'name' => __('フッター用サイドバー02'),
          'id' => 'footersidebar02',
          'description' => __('フッター用サイドバー02です'),
          'description' => __('フッター用サイドバー02です'),
          'before_widget' => '<aside id="%1$s" class="footer-side-bar widget %2$s">',
          'after_widget' => '</aside>',
          'before_title' => '<div class=""></div><h3>',
          'after_title' => '</h3>',
        ) );
    }


  //フッター サイドバー03追加
  add_action( 'widgets_init', 'footerSidebar03_init' );
    function footerSidebar03_init() {
        register_sidebar( array(
          'name' => __('フッター用サイドバー03'),
          'id' => 'footersidebar03',
          'description' => __('フッター用サイドバー03です'),
          'description' => __('フッター用サイドバー03です'),
          'before_widget' => '<aside id="%1$s" class="footer-side-bar widget %2$s">',
          'after_widget' => '</aside>',
          'before_title' => '<div class=""></div><h3>',
          'after_title' => '</h3>',
        ) );
    }


  //フッター サイドバー04追加
  add_action( 'widgets_init', 'footerSidebar04_init' );
    function footerSidebar04_init() {
        register_sidebar( array(
          'name' => __('フッター用サイドバー04'),
          'id' => 'footersidebar04',
          'description' => __('フッター用サイドバー04です'),
          'description' => __('フッター用サイドバー04です'),
          'before_widget' => '<aside id="%1$s" class="footer-side-bar widget %2$s">',
          'after_widget' => '</aside>',
          'before_title' => '<div class=""></div><h3>',
          'after_title' => '</h3>',
        ) );
    }





//00900 ファイル実行 ショートコード v.1.0.8
  //[myphp file="test.php"]
  function Include_my_php($params = array())
  {
    extract(shortcode_atts(array('file' => 'default',), $params));
    ob_start();
    include get_theme_root().'/'.get_template()."/$file.php";
    return ob_get_clean();
  }
  add_shortcode('myphp', 'Include_my_php');




//00950　特定のカテゴリのみニュースに出す カテゴリ表記あり
// [news1 cat="1" num="10"]
//echo do_shortcode( '[news1 cat="1" num="10"]' );
/* 最新記事リスト */
  function getNewItems1($atts)
  {
    extract(shortcode_atts(array(
        'num' => '',    //最新記事リストの取得数
        'cat' => '',    //表示する記事のカテゴリー指定
    ), $atts));

    global $post;
    $oldpost = $post;
    $retHtml = '';
    $myposts = get_posts('numberposts='.$num.'&order=DESC&post_status=publish&orderby=post_date&category='.$cat);
    foreach ($myposts as $post) :
      $content = strip_tags($post->post_content);
      $cat = get_the_category();//カテゴリー
      $catname = $cat[0]->cat_name;//カテゴリー名
      $catslug = $cat[0]->slug;//カテゴリースラッグ
      $category_id = get_cat_ID( $catname );// 指定したカテゴリーの ID を取得
      $category_link = get_category_link( $category_id );// このカテゴリーの URL を取得
      $title = the_title("","",false);
      $link = get_permalink();
      $date = get_post_time('Y年n月j日');
      setup_postdata($post);

      $retHtml .= <<< EOD
      <div class="news_row flex">
        <span class="news_date">{$date}</span>
        <a href="{$category_link}" class="categories cat_{$catslug}">{$catname}</a>
        <h3 class="news_title">
          <i class="fa fa-caret-right" aria-hidden="true"></i>
          <a href="{$link}" class="news_link">{$title}</a>
        </h3>
      </div>
EOD;

  endforeach;

  $retHtml = '<div class="category_wrap">'.$retHtml.'</div>';
  $post = $oldpost;
  wp_reset_postdata();

  return $retHtml;
  }
add_shortcode('news1', 'getNewItems1');


//01000　特定のカテゴリのみニュースに出す カテゴリ表記なし
// [news2 cat="1" num="10"]
//echo do_shortcode( '[news2 cat="1" num="10"]' );
/* 最新記事リスト */
  function getNewItems2($atts){
    extract(shortcode_atts(array(
        'num' => '',    //最新記事リストの取得数
        'cat' => '',    //表示する記事のカテゴリー指定
    ), $atts));

    global $post;
    $oldpost = $post;

    $myposts = get_posts('numberposts='.$num.'&order=DESC&post_status=publish&orderby=post_date&category='.$cat);
    $retHtml = '';

    foreach ($myposts as $post) :
      $content = strip_tags($post->post_content);
      $title = the_title("","",false);
      $link = get_permalink();
      $date = get_post_time('Y年n月j日');
      setup_postdata($post);
      $retHtml .= <<< EOD
      <div class="news_row flex">
        <span class="news_date">{$date}</span>
        <h3 class="news_title">
          <i class="fa fa-caret-right" aria-hidden="true"></i>
          <a href="{$link}" class="news_link">{$title}</a>
        </h3>
      </div>
EOD;
  endforeach;

  $retHtml = '<div class="category_wrap">'.$retHtml.'</div>';
  $post = $oldpost;
  wp_reset_postdata();

  return $retHtml;
  }
add_shortcode('news2', 'getNewItems2');



//01100  パンくずリスト
function get_current_link() {/**今開いているページ*/
 return (is_ssl() ? 'https' : 'http') . '://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
}
function breadcrumb(){
  global $post;
  $str ='';

  //overStringSafe($post -> post_title, 30) 文字切り出す関数

  if(!is_home()&&!is_admin()&&!is_front_page()){ /* !is_admin は管理ページ以外という条件分岐 */
    $str.= '<div id="breadcrumb">';
    $str.= '<ul itemscope itemtype="http://schema.org/BreadcrumbList">';
    $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . home_url('/') .'" class="home" itemprop="item" ><span itemprop="name">三和ペイント</span><meta itemprop="position" content="1" /></a></li>';
    // $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . home_url('/') .'" class="home" itemprop="item" ><span itemprop="name">'.get_bloginfo("name").'</span><meta itemprop="position" content="1" /></a></li>';

    /*ココロトソウ　関連の時*/
    if(is_page(array("cocorotosou")) || is_singular("cocorotosou") || is_tax("cocorotosous") || is_tax("cocorotosou_tag")){
      $str = '<div id="breadcrumb">';
      $str.= '<ul itemscope itemtype="http://schema.org/BreadcrumbList">';
      $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . home_url('/cocorotosou') .'" class="home" itemprop="item" ><span itemprop="name">ココロトソウ</span><meta itemprop="position" content="1" /></a></li>';
    }

    /*ココロトソウ詳細ページ*/
    if(is_singular("cocorotosou")){
      $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="/cocorotosous/all" itemprop="item" ><span itemprop="name">すべての記事</span><meta itemprop="position" content="2" /></a></li>';
      $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. $post -> post_title .'</span><meta itemprop="position" content="3" /></li>';
    }
    /*施工事例詳細ページ*/
    elseif(is_singular("cases")){
      $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="/sanwa-search-page" itemprop="item" ><span itemprop="name">施工事例</span><meta itemprop="position" content="2" /></a></li>';
      $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. $post -> post_title .'</span><meta itemprop="position" content="3" /></li>';
    }
    /*旧施工事例詳細ページ*/
    elseif(is_singular("oldvoice")){
      $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="/oldvoices/all" itemprop="item" ><span itemprop="name">過去の施工事例</span><meta itemprop="position" content="2" /></a></li>';
      $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. $post -> post_title .'</span><meta itemprop="position" content="3" /></li>';
    }
    /*旧お客様アンケート詳細ページ*/
    elseif(is_singular("oldsurvey")){
      $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="/oldsurveys/all" itemprop="item" ><span itemprop="name">過去のお客様アンケート</span><meta itemprop="position" content="2" /></a></li>';
      $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. $post -> post_title .'</span><meta itemprop="position" content="3" /></li>';
    }
    /* 投稿のページ */
    elseif(is_single()){
      $categories = get_the_category($post->ID);
      $cat = $categories[0];
      if($cat -> parent != 0){
        $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
        foreach($ancestors as $ancestor){
          $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'. get_category_link($ancestor).'"  itemprop="item" ><span itemprop="name">'. get_cat_name($ancestor). '</span><meta itemprop="position" content="2" /></a></li>';
                  }
      }
      $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'. get_category_link($cat -> term_id). '" itemprop="item" ><span itemprop="name">'. $cat-> cat_name . '</span><meta itemprop="position" content="2" /></a></li>';
      $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. $post -> post_title .'</span><meta itemprop="position" content="3" /></li>';
    }

    /* 固定ページ */
    elseif(is_page()){
      if($post -> post_parent != 0 ){
        $ancestors = array_reverse(get_post_ancestors( $post->ID ));
        foreach($ancestors as $ancestor){
          $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'. get_permalink($ancestor).'" itemprop="item" ><span itemprop="name">'. get_the_title($ancestor) .'</span><meta itemprop="position" content="2" /></a></li>';
                  }
      }
      $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. $post -> post_title .'</span><meta itemprop="position" content="3" /></li>';
    }

    /* ココロトソウカテゴリページ */
    elseif(is_tax("cocorotosous")) {
      $cat = get_queried_object();
      $pagename = $cat -> name;
      $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. $pagename . '一覧</span><meta itemprop="position" content="3" /></li>';
    }

    /* ココロトソウタグページ */
    elseif(is_tax("cocorotosou_tag")) {
      $cat = get_queried_object();
      $pagename = $cat -> name;
      $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. $pagename . '一覧</span><meta itemprop="position" content="3" /></li>';
    }

    /* 旧施工事例一覧ページ */
    elseif(is_tax("oldvoices")) {
      $cat = get_queried_object();
      $pagename = $cat -> name;
      $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">過去の施工事例</span><meta itemprop="position" content="3" /></li>';
    }

    /* 旧お客様アンケート一覧ページ */
    elseif(is_tax("oldsurveys")) {
      $cat = get_queried_object();
      $pagename = $cat -> name;
      $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">過去のお客様アンケート</span><meta itemprop="position" content="3" /></li>';
    }

    /* カテゴリページ */
    elseif(is_category()) {
      $cat = get_queried_object();
      if($cat -> parent != 0){
        $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
        foreach($ancestors as $ancestor){
          $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'. get_category_link($ancestor) .'" itemprop="item" ><span itemprop="name">'. get_cat_name($ancestor) .'</span><meta itemprop="position" content="2" /></a></li>';
        }
      }
      $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. $cat -> name . '</span><meta itemprop="position" content="3" /></li>';
    }

    /*　事例検索結果ページ */
    elseif(is_post_type_archive("cases")) {
      $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="/sanwa-search-page" itemprop="item" ><span itemprop="name">施工事例検索</span><meta itemprop="position" content="2" /></a></li>';
      $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">施工事例検索結果</span><meta itemprop="position" content="3" /></li>';
    }

    /* タグページ */
    elseif(is_tag()){
      $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. single_tag_title( '' , false ). '</span><meta itemprop="position" content="3" /></li>';
    }

    /* 時系列アーカイブページ */
    elseif(is_date()){
      if(get_query_var('day') != 0){
        $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'. get_year_link(get_query_var('year')). '" itemprop="item" ><span itemprop="name">' . get_query_var('year'). '年</span><meta itemprop="position" content="2" /></a></li>';
        $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'. get_month_link(get_query_var('year'), get_query_var('monthnum')). '" itemprop="item" ><span itemprop="name">'. get_query_var('monthnum') .'月</span><meta itemprop="position" content="2" /></a></li>';
        $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. get_query_var('day'). '</span>日<meta itemprop="position" content="3" /></li>';
      } elseif(get_query_var('monthnum') != 0){
        $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'. get_year_link(get_query_var('year')) .'" itemprop="item" ><span itemprop="name">'. get_query_var('year') .'年</span><meta itemprop="position" content="2" /></a></li>';
        $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. get_query_var('monthnum'). '</span>月<meta itemprop="position" content="3" /></li>';
      } else {
        $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. get_query_var('year') .'年</span><meta itemprop="position" content="3" /></li>';
      }
    }

    /* 投稿者ページ */
    elseif(is_author()){
      $str .='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">投稿者 : '. get_the_author_meta('display_name', get_query_var('author')).'</span><meta itemprop="position" content="3" /></li>';
    }

    /* 添付ファイルページ */
    elseif(is_attachment()){
      if($post -> post_parent != 0 ){
        $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'. get_permalink($post -> post_parent).'" itemprop="item" ><span itemprop="name">'. get_the_title($post -> post_parent) .'</span><meta itemprop="position" content="2" /></a></li>';
      }
      $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . $post -> post_title . '</span><meta itemprop="position" content="3" /></li>';
    }

    /* 検索結果ページ */
    elseif(is_search()){
      $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">「'. get_search_query() .'」で検索した結果</span><meta itemprop="position" content="3" /></li>';
    }

    /* 404 Not Found ページ */
    elseif(is_404()){
      $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">お探しの記事は見つかりませんでした。</span><meta itemprop="position" content="3" /></li>';
    }

    /* その他のページ */
    else{
      $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. wp_title('', false) .'</span><meta itemprop="position" content="3" /></li>';
    }
    $str.= '</ul>';
    $str.= '</div>';
    }
  echo $str;
  }
  add_shortcode('breadcrumb_short', 'breadcrumb');

//01200 固定ページにカテゴリ付与機能を追加
//  add_action('init', 'add_categories_for_pages');
//
//  function add_categories_for_pages()
//  {
//    register_taxonomy_for_object_type('category', 'page');
//  }
//  add_action('pre_get_posts', 'nobita_merge_page_categories_at_category_archive');
//
//  function nobita_merge_page_categories_at_category_archive($query)
//  {
//    if ($query->is_category == true && $query->is_main_query()) {
//      $query->set('post_type', array('post', 'page', 'nav_menu_item'));
//    }
//  }

//01200
// =========================================================
// 文字数が制限オーバーした場合に、最後に・・・をつける処理
// =========================================================
function overStringSafe($string, $seigen) {
    $moji_count = strlen($string);
    $seigen = $seigen * 2;
    if (is_category()){
        if ($moji_count > $seigen) {
            $string = mb_substr($string, 0, 30, 'UTF-8');
            $string = $string. '>>>>';
        }
    }else{
        if ($moji_count > $seigen) {
            $string = mb_substr($string, 0, 30, 'UTF-8');
            $string = $string. '…';
        }
    }

    return $string;
}



//01300 管理バーにログアウトを追加
  function add_new_item_in_admin_bar()
  {
    global $wp_admin_bar;
    $wp_admin_bar->add_menu(array(
  'id' => 'new_item_in_admin_bar',
  'title' => __('ログアウト'),
  'href' => wp_logout_url(),
  ));
  }
  add_action('wp_before_admin_bar_render', 'add_new_item_in_admin_bar');



//01400 5.3-バージョンアップ通知を管理者のみ表示させるようにします。
  function update_nag_admin_only()
  {
    if (!current_user_can('administrator'))
    {
      remove_action('admin_notices', 'update_nag', 3);
    }
  }
  add_action('admin_init', 'update_nag_admin_only');


//01500 tagにIDタグを追加　
    //[body_id]
    //echo do_shortcode( '[body_id]' );
    function body_idFunc()
    {
        if (is_front_page()) {
            $body_id = home;
        } elseif (is_single() || is_page()) {
            $page = get_page(get_the_ID());
            $body_id = $page->post_name;
        } elseif (is_category()) {
            $category = get_the_category();
            $body_id = 'category_'.$category[0]->category_nicename;
        }

        return $body_id;
    }
    add_shortcode('body_id', 'body_idFunc');


//01600 カテゴリーページの「カテゴリー：○○」の「カテゴリー：」を消す
    add_filter('get_the_archive_title', function ($title) {

        if (is_category()) {
            $title = single_cat_title('', false);
        }

        return $title;

    });

//01700 bodyタグのclassにページスラッグを追加する
    function body_classFunc($classes = '')
    {
        if (is_page()) {
            $page = get_page(get_the_ID());
            $classes[] = 'page-'.$page->post_name;
            if ($page->post_parent) {
                $classes[] = 'page-'.get_page_uri($page->post_parent).'-child';
            }
        }

        return $classes;
    }
    add_filter('body_class', 'body_classFunc');



//01800 URLからcategoryを抜く
    add_filter('user_trailingslashit', 'remcat_function');
    function remcat_function($link) {
        return str_replace("/category/", "/", $link);
    }

    add_action('init', 'remcat_flush_rules');
    function remcat_flush_rules() {
        global $wp_rewrite;
        $wp_rewrite->flush_rules();
    }

    add_filter('generate_rewrite_rules', 'remcat_rewrite');
    function remcat_rewrite($wp_rewrite) {
        $new_rules = array('(.+)/page/(.+)/?' => 'index.php?category_name='.$wp_rewrite->preg_index(1).'&paged='.$wp_rewrite->preg_index(2));
        $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
    }


//01900 サムネイルサイズの追加設定
  // add_image_size('thumb75', 75, 75, true);


//02000 管理画面とフロントの見え方の統一
add_editor_style( get_stylesheet_directory_uri().'/assets/library/css/child-editor-style.css');//子テーマディレクトリ

function my_admin_style(){
    wp_enqueue_style( 'my_admin_style', get_template_directory_uri().'/assets/library/css/parent-editor-style.css' );//親テーマディレクトリ
}
add_action( 'admin_enqueue_scripts', 'my_admin_style' );


//02100 ロゴ追加
add_action( 'customize_register', 'theme_customize' );

function theme_customize($wp_customize){

  //画像
  $wp_customize->add_section( 'img_section', array(
    'title' => '画像', //セクションのタイトル
    'priority' => 59, //セクションの位置
    'description' => '画像をアップロードしてください。', //セクションの説明
  ));

    $wp_customize->add_setting( 'logo_img' ); //設定項目を追加
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_img', array(
      'label' => 'ロゴ画像', //設定項目のタイトル
      'section' => 'img_section', //追加するセクションのID
      'settings' => 'logo_img', //追加する設定項目のID
      'description' => 'ロゴ画像を設定してください。', //設定項目の説明
    )));

}

/* テーマカスタマイザーで設定された画像のURLを取得
---------------------------------------------------------- */
//ヘッダーロゴ画像
function get_the_logo_img_url(){
  return esc_url( get_theme_mod( 'logo_img' ) );
}


//02200　デバイス判定ロジック
/*is_mobile
---------------------------------------------------------- */
function is_mobile() {
  $useragents = array(
    'iPhone',          // iPhone
    'iPod',            // iPod touch
    'Android',         // 1.5+ Android
    'dream',           // Pre 1.5 Android
    'CUPCAKE',         // 1.5+ Android
    'blackberry9500',  // Storm
    'blackberry9530',  // Storm
    'blackberry9520',  // Storm v2
    'blackberry9550',  // Storm v2
    'blackberry9800',  // Torch
    'webOS',           // Palm Pre Experimental
    'incognito',       // Other iPhone browser
    'webmate'          // Other iPhone browser
  );
  $pattern = '/'.implode('|', $useragents).'/i';
  return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}


//02300 セキュリティ
/*
 WordPressで作られたということと、そのバージョンを伝えるためのタグ
　<meta name=”generator” content=”WordPress 4.2.5″>
 を消す
*/
 remove_action('wp_head', 'wp_generator');


/*
 長くなってしまったパーマリンクを短くするための短縮URL
　<link rel=”shortlink” href=”http://example.com/?p=1234″ />
 を消す
*/
remove_action('wp_head', 'wp_shortlink_wp_head');


/*
 Windows Live riterというブログ編集ツールを使って編集するためのリソースファイルwlwmanifest.xml
　<link rel=”EditURI” type=”application/wlwmanifest+xml”
title=”RSD” href=”http://exmample.com/wp-includes/wlwmanifest.xml” />
 を消す
*/
remove_action('wp_head', 'wlwmanifest_link');


/*
 外部アプリケーションからリモート投稿や編集をするためのリソースファイル
　<link rel=”EditURI” type=”application/rsd+xml”
title=”RSD” href=”http://exmample.com/xmlrpc.php?rsd” />
 を消す
*/
remove_action('wp_head', 'rsd_link');


/*
 RSSフィード
　<link rel=”alternate” type=”application/rss+xml”
title=”フィード” href=”http://exmample.com/feed/” />
<link rel=”alternate” type=”application/rss+xml”
title=”コメントフィード” href=”http://exmample.com/comments/feed/” />
 を消す
*/
remove_action('wp_head', 'feed_links_extra', 3);


/*
 絵文字に対応するためのJavaScriptとCSSを読み込むタグ。
 を消す
*/
remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); //絵文字対応
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' ); //絵文字対応
remove_action( 'wp_print_styles', 'print_emoji_styles' ); //絵文字対応
remove_action( 'admin_print_styles', 'print_emoji_styles' ); //絵文字対応


/*
 絵文字に対応するためのJavaScriptとCSSを読み込むタグ。
 を消す
*/
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); //分割ページへのリンク
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); //分割ページへのリンク
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); //分割ページへのリンク


/*
 indexへのリンクさせない。
*/
remove_action( 'wp_head', 'index_rel_link' );


/*
xmlrpc.php攻撃対策
*/
//  1）xmlrpc.phpの無効化(verにより効かない可能性あり)
add_filter('xmlrpc_enabled','__return_false');

// 2）「X-Pingback」のヘッダー情報も消去
function remove_x_pingback($headers) {
unset($headers['X-Pingback']);
return $headers;
}
add_filter('wp_headers','remove_x_pingback');


//02400 ヘッダーフッターメニュー処理
register_nav_menus(array(
    'globalmenu' => esc_html__('globalmenu', 'globalmenus'),
));


//フッターメニュー
register_nav_menus(array(
    'footer_menu1' => esc_html__('フッターメニュー１', 'footer_menu1'),
));
register_nav_menus(array(
    'footer_menu2' => esc_html__('フッターメニュー２', 'footer_menu2'),
));
register_nav_menus(array(
    'footer_menu3' => esc_html__('フッターメニュー３', 'footer_menu3'),
));
register_nav_menus(array(
    'footer_menu4' => esc_html__('フッターメニュー４', 'footer_menu4'),
));
register_nav_menus(array(
    'footer_menu5' => esc_html__('コピーライトメニュー', 'footer_menu5'),
));

//ココロトソウ
register_nav_menus(array(
    'cocorotosou' => esc_html__('ヘッダメニューココロトソウ', 'cocorotosou'),
));
register_nav_menus(array(
    'cocorotosou_footer' => esc_html__('フッターメニューココロトソウ', 'cocorotosou_footer'),
));

//02500 tinyMCE advance フォントサイズ
add_filter( 'tiny_mce_before_init', 'my_mce_before_init',5 );
function my_mce_before_init( $settings ) {
    $settings['fontsize_formats'] = "0.8rem 1rem 1.2rem 1.4rem 1.6rem 1.8rem 2rem 2.2rem 2.4rem";
    return $settings;
}


//02700 SNS　ショートコード
function snsFunc()

{
  if ( !is_home() && !is_front_page() ){
    $snsContent=  '-' .get_the_title();
  }
return'
            <div id="sns">
              <div class="snsWrapper">
              <a id="fbBtn" class="fb btn" href="http://www.facebook.com/share.php?u=' . get_the_permalink() . '" onclick="window.open(this.href, \'FBwindow\', \'width=650, height=450, menubar=no, toolbar=no, scrollbars=yes\'); return false;" target="_blank">
                <span class="icon-facebook"></span>
              </a>
                <a id="twitterBtn" class="twitter btn" href="http://twitter.com/share?url=' . get_the_permalink() . '&text=' . get_bloginfo('name') . ' ' . $snsContent .'" target="_blank">
                  <span class="icon-twitter"></span>
                </a>
                <a id="lineBtn" class="line btn" href="http://line.me/R/msg/text/?'. get_the_permalink() . ' ' . get_bloginfo('name') . $snsContent . '" target="_blank">
                  <span class="icon-line"></span>
                </a>
              </div>
            </div>


        ';
      }
add_shortcode('sns', 'snsFunc');


function theme_name_scripts() {
wp_enqueue_style( 'validationEngine.jquery.css', 'https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/validationEngine.jquery.min.css', array(), '1.0', 'all');
wp_enqueue_script( 'jquery.validationEngine-ja.js', 'https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/languages/jquery.validationEngine-ja.min.js', array('jquery'), '2.0.0', true );
wp_enqueue_script( 'jquery.validationEngine.js', 'https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery.validationEngine.min.js', array('jquery'), '2.6.4', true );
}
add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );



//切り分けたfunctions読み込み
//子テーマで問題あれば　https://8beat-studio.net/sort-out-wp-functions/
// require_once locate_template('lib/main_func.php');        // メイン
// require_once locate_template('lib/admin_func.php');        // メイン
// require_once locate_template('lib/news_func.php');        // お知らせ関連
// require_once locate_template('lib/css_js_load_func.php');        // CSS JS
// require_once locate_template('lib/custom_post_func.php');        // カスタムポスト関連


//プラグインアクティブ判定 マサイ2018-10-09
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
  $vc_plugin_activated='js_composer/js_composer.php'; //vcの有効化チェックのための変数



//zip
function allow_upload_zip( $mimes ) {
    $mimes['zip'] = 'application/zip';
    return $mimes;
}
add_filter( 'upload_mimes', 'allow_upload_zip' );



//管理画面処理
add_filter( 'admin_body_class', 'add_admin_body_class' );
function add_admin_body_class( $classes ) {


  global $current_user;
get_currentuserinfo();
  $classes .= 'user-'.$current_user->user_login;
  return $classes;

}

//ログイン画面にcssを適用する
function login_logo() {
 echo '<link rel="stylesheet" type="text/css" href="'.get_template_directory_uri().'/assets/library/css/parent-editor-style.css" />';
}
add_action('login_head', 'login_logo');


function wpcf7_main_validation_filter( $result, $tag ) {
  $type = $tag['type'];
  $name = $tag['name'];
  $_POST[$name] = trim( strtr( (string) $_POST[$name], "\n", " " ) );
  if ( 'email' == $type || 'email*' == $type ) {
    if (preg_match('/(.*)_confirm$/', $name, $matches)){
      $target_name = $matches[1];
      if ($_POST[$name] != $_POST[$target_name]) {
        if (method_exists($result, 'invalidate')) {
          $result->invalidate( $tag,"確認用のメールアドレスが一致していません");
      } else {
          $result['valid'] = false;
          $result['reason'][$name] = '確認用のメールアドレスが一致していません';
        }
      }
    }
  }
  return $result;
}

add_filter( 'wpcf7_validate_email', 'wpcf7_main_validation_filter', 11, 2 );
add_filter( 'wpcf7_validate_email*', 'wpcf7_main_validation_filter', 11, 2 );
