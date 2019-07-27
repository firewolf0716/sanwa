<?php
//
// Recommended way to include parent theme styles.
//  (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
//
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('common-css') );
    wp_enqueue_style( 'notosans','https://fonts.googleapis.com/css?family=Noto+Sans+JP&amp;subset=japanese', array() );
    wp_enqueue_style( 'notoserif','https://fonts.googleapis.com/css?family=Noto+Serif+JP&display=swap', array() );
}


//02600 コピーライト ショートコード
function copyrightFunc()
{
    return '&copy;<a href="'.home_url().'" class="copyright">会社名を入れる</a>';
}
add_shortcode('copyright', 'copyrightFunc');


/**
 * 子テーマで切り分けたfunctionsが読み込めない時下記
 * https://8beat-studio.net/sort-out-wp-functions/
 */
 require_once locate_template('lib/main_func.php');        // メイン
 require_once locate_template('lib/admin_func.php');        // メイン
 require_once locate_template('lib/news_func.php');        // お知らせ関連
 require_once locate_template('lib/css_js_load_func.php');        // CSS JS
 require_once locate_template('lib/custom_post_func.php');        // カスタムポスト関連
 require_once locate_template('lib/cocorotosou_func.php');        // ココロトソウ関連
  require_once locate_template('lib/staff_func.php');        // スタッフ関連

//
// Your code goes below
//



  add_image_size( 'topEyecatch_ratio', 1920,0,false);
  add_image_size( 'topEyecatch', 1920,500,true);
  add_image_size( 'topEyecatchTB', 1024,400,true);
  add_image_size( 'topEyecatchSP', 480,400,true);



/* 追加のコード：施工事例 */
  require_once locate_template('lib/global_fields.php');
	require_once locate_template('lib/cases_post_func.php');
  require_once locate_template('lib/cases_widget_func.php');
	require_once locate_template('lib/cases_pagination_func.php');
  require_once locate_template('lib/colors_post_func.php');
  require_once locate_template('lib/branchs_post_func.php');
  require_once locate_template('lib/estimation_post_func.php');
  require_once locate_template('lib/contact_cf7_func.php');
