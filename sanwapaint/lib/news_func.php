<?php
//トップnews５件
function news_listsFunc($attr){
  /*
<li class="flex">
  <span class="date">2018-04-02</span>
  <a class="newsLink">あああああああああああああああああああああああああああ</a>
  <span class="category">ああああああ</span>
</li>
  */
  $retHtml = NULL;

  $num = $attr[0];
  $cat = $attr[1];

  global $post;
  $oldpost = $post;

  $myposts = get_posts('numberposts='.$num.'&order=DESC&post_status=publish&orderby=post_date&category='.$cat);


  foreach ($myposts as $post) :
    $content = strip_tags($post->post_content);
    $cat = get_the_category();//カテゴリー
    $catname = $cat[0]->cat_name;//カテゴリー名
    $catslug = $cat[0]->slug;//カテゴリースラッグ
    $category_id = get_cat_ID( $catname );// 指定したカテゴリーの ID を取得
    $category_link = get_category_link( $category_id );// このカテゴリーの URL を取得

    // このカテゴリーの URL を取得
    $category_link = get_category_link( $category_id );
      setup_postdata($post);
    $retHtml .= '<li class="flex">';
    $retHtml .= '<span class="date">'.get_post_time('Y.m.d').'</span>'; //"Y年n月j日 l H:i:s"
    if(mb_strlen($post->post_title, 'UTF-8')>19){
      $title= mb_substr($post->post_title, 0, 20, 'UTF-8');
      $re_title = $title.'…';
    }else{
      $re_title = $post->post_title;
    }
    $retHtml .= '
    <a href="'.get_permalink().'" class="newsLink">'.$re_title.'</a>
    <span class="category">'.$catname.'</span>';
    $retHtml .= '</li>';
  endforeach;
  $post = $oldpost;
  wp_reset_postdata();


  return $retHtml;
}
add_shortcode('news_lists', 'news_listsFunc');


//ニュース一覧用
function getNewItemsFunc($attr){
  $num = $attr[0]; //最新記事リストの取得数
  $cat = $attr[1]; //表示する記事のカテゴリー指定

  global $post;
  $oldpost = $post;
  $myposts = get_posts('numberposts='.$num.'&order=DESC&post_status=publish&orderby=post_date&category='.$cat);
  $retHtml = '';
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
    <h3 class="news_title"><i class="fa fa-caret-right" aria-hidden="true"></i><a href="{$link}" class="news_link">{$title}</a></h3>
    </div>
EOD;
  endforeach;
  $retHtml .= '';
  $post = $oldpost;
  wp_reset_postdata();

  return $retHtml;
}
add_shortcode('getNewItems', 'getNewItemsFunc');


//s三和ペイントのトップnews
function top_news_listsFunc($attr){
  extract(shortcode_atts(array(
   "num" => '1',
  ), $attr));

  $retHtml = NULL;

  global $post;
  $oldpost = $post;

  $parent_cat_id = 3; // 親カテゴリのIDを取得
  $categories = get_term_children($parent_cat_id, 'category');
  foreach ($categories as $key => $value) {
    $categories_num .= $value . ',';
  }
  $categories_num .= $parent_cat_id;//foreachのループ終了後親カテidを$categories_numに続けて代入


  $myposts = get_posts('numberposts='.$num.'&order=DESC&post_status=publish&orderby=post_date&category='.$categories_num);


  foreach ($myposts as $post) :
    $content = strip_tags($post->post_content);
    $cat = get_the_category();//カテゴリー
    $catname = $cat[0]->cat_name;//カテゴリー名
    $catslug = $cat[0]->slug;//カテゴリースラッグ
    $category_id = get_cat_ID( $catname );// 指定したカテゴリーの ID を取得
    $category_link = get_category_link( $category_id );// このカテゴリーの URL を取得

    // このカテゴリーの URL を取得
    $category_link = get_category_link( $category_id );
      setup_postdata($post);
    $retHtml .= '<li class="flex">';
    $retHtml .= '<span class="date">'.get_post_time('Y.m.d').'</span>'; //"Y年n月j日 l H:i:s"
    // if(mb_strlen($post->post_title, 'UTF-8')>19){
    //   $title= mb_substr($post->post_title, 0, 20, 'UTF-8');
    //   $re_title = $title.'…';
    // }else{
    //   $re_title = $post->post_title;
    // }
    $re_title = $post->post_title;
    $retHtml .= '
    <a href="'.get_permalink().'" class="newsLink">'.$re_title.'</a>
    <span class="category">'.$catname.'</span>';
    $retHtml .= '</li>';
  endforeach;
  $post = $oldpost;
  wp_reset_postdata();


  return $retHtml;
}
add_shortcode('top_news_lists', 'top_news_listsFunc');
