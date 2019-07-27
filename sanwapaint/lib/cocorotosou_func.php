<?php
function cocoronoimage_ret(){
  $noimage = "";
  $attachments = get_children(array('post_type' => 'attachment', 'post_mime_type' => 'image'));
  if(!empty($attachments)){
    foreach($attachments as $attachment){
      if($attachment->post_title == 'cocoro_noimage') {
        $noimage = wp_get_attachment_url( $attachment->ID);
        // $imgid = $attachment->ID;
      }
    }
  }
  return $noimage;
}

/**
 *
 * ココロトソウ　デフォルトカテゴリー
 */
 function add_default_automatically($post_ID) {
     global $wpdb;
     // 設定されているカスタム分類のタームを取得
     $curTerm = wp_get_object_terms($post_ID, 'cocorotosous');
     // 既存のターム指定数が 0（つまり未設定）であれば）すべてを指定
     if (0 === count($curTerm)) {
         // misc のターム ID
         $defaultTerm= array(154);
         wp_set_object_terms($post_ID, $defaultTerm, 'cocorotosous');
     }elseif("all" === $curTerm[0]->slug && 1 === count($curTerm)){
       // misc のターム ID
       $defaultTerm= array($curTerm->term_id,154);
       wp_set_object_terms($post_ID, $defaultTerm, 'cocorotosous');
     }
 }
 // 投稿を作成する際に指定
 add_action('publish_cocorotosou', 'add_default_automatically');


/**
 * [get_thumbnail description]
 * @return [type] [description]
 * IDでサムネイル取得
 */
function get_thumbnail($target_id){
  // get_post($target_id);
  ////////////////////////////画像ゾーン///////////////////////////////////
  // mediumサイズの画像内容を取得（引数にmediumをセット）
  if (!empty(get_the_post_thumbnail_url( $target_id, 'thumbnail-about' )))  {
   $thumb_url = get_the_post_thumbnail_url( $target_id, 'thumbnail-about' );
   // $eye_img = wp_get_attachment_image_src( $thumbnail_id , 'thumbnail-about' );
   // $thumb_url=$eye_img[0];
  }
  else {
   $thumb_url = cocoronoimage_ret();
  }
  //「説明」を取得
  // $thumb_content = $thumb_post->post_content;
  //キャプションを取得
  // $thumb_caption = $thumb_post->post_excerpt;
  //altを取得
  // $post_meta = get_post_meta( $thumbnail_id );
  // $thumb_alt = $post_meta['_wp_attachment_image_alt'][0];
  // if(empty($thumb_alt))$thumb_alt;
  ////////////////////////////画像ゾーン///////////////////////////////////
  wp_reset_postdata();
  return $thumb_url;
}

/**
 * [cocorotosou_newsget no=取得記事順番 imgflg=1：imgか0：本文かフラグ getslug=カテゴリスラッグ名]
 * @param  [type] $attr [description]
 * @return [type]       [description]
 * ココロトソウトップ記事取得
 */
function cocorotosou_newsget_Func($attr){
  extract(shortcode_atts(array(
   "no" => 1,
   "imgflg" => 0,
   "getslug" => "all"
  ), $attr));
  $result = NULL;

  $args = array(
   'post_type' => "cocorotosou",
   'tax_query' => array(
   'relation'  => 'AND',
    array(
     'taxonomy' => 'cocorotosous', /* 指定したい投稿タイプが持つタクソノミーを指定 */
     'field'    => 'slug',
     'terms'    => $getslug, /* 上記で指定した変数を指定 */
    )
   ),
   'post_status'    => 'publish',
   'orderby'        => 'date',
   'order'          => 'DESC',
   'posts_per_page' => 1,
   'offset'         => $no,
  );

  $the_query = new WP_Query( $args );

  if ( $the_query->have_posts() ) :
   while ( $the_query->have_posts() ) : $the_query->the_post();
   //ここにループするテンプレート
   ////////////////////////////画像ゾーン///////////////////////////////////
   // アイキャッチ画像のIDを取得
   $thumbnail_id = get_post_thumbnail_id();
   $thumb_post = get_post($thumbnail_id);
   // mediumサイズの画像内容を取得（引数にmediumをセット）
   if (has_post_thumbnail() )  {
    $eye_img = wp_get_attachment_image_src( $thumbnail_id , 'thumbnail-about' );
    $thumb_url=$eye_img[0];
   }
   else {
    $thumb_url = cocoronoimage_ret();
   }
   //「説明」を取得
   $thumb_content = $thumb_post->post_content;
   //キャプションを取得
   $thumb_caption = $thumb_post->post_excerpt;
   //altを取得
   $post_meta = get_post_meta( $thumbnail_id );
   $thumb_alt = $post_meta['_wp_attachment_image_alt'][0];
   if(empty($thumb_alt))$thumb_alt;
   ////////////////////////////画像ゾーン///////////////////////////////////

   //本文
   // $text = do_shortcode(get_the_content()); // 元になる文字列
   $text = do_shortcode(get_the_content()); // 元になる文字列
   // HTMLエンティティを文字列に変換
   $text = html_entity_decode( $text );
   // 指定の文字数で切り出す
   $text = wp_trim_words( $text, 60, "..." );
   // HTMLエンティティを元に戻す
   $text = htmlentities( $text );

   $link = get_permalink();
   $date = get_the_date('Y.m.d');

   //タイトル
   $title = do_shortcode(get_the_title()); // 元になる文字列
   // HTMLエンティティを文字列に変換
   $title = html_entity_decode( $title );
   // 指定の文字数で切り出す
   $title = wp_trim_words( $title, 21, "..." );
   // HTMLエンティティを元に戻す
   $title = htmlentities( $title );

   //カテゴリ
   $catname = "";
   $catlink = "";
   $catnames = get_the_terms(get_the_ID(), "cocorotosous");
   if(is_array($catnames)){
    foreach ($catnames as $catnames_value) {
     if($catnames_value->slug == "all")continue;
     $catname = $catnames_value->name;
     $catlink = "/cocorotosou/".$catnames_value->slug;
    }
   }
   $nullcat = "";
   if(empty($catname))$nullcat="style='display:none;'";

  endwhile;
  endif;
  wp_reset_postdata();

  if((int)$imgflg === 1){
    /*imgの時*/
    $result = "<a href='{$link}' class='linkCover'></a><div class='backimage' style='background-image:url({$thumb_url});'><span class='BtnCover'><span class='newArticlBtn ty_arrow'><span>詳しく見る</span></span></span></div>";
  }elseif((int)$imgflg === 0){
    /*文章の時*/
    $result = "
    <div class='newArticleText'>
      <div class='newArticleTextInner'>
        <h3>{$title}</h3>
        <div class='dateCategory flex'>
          <div class='date'>
            <i class='far fa-clock'></i>
            <span>{$date}</span>
          </div>
          <div class='category'>
            <span class='cateLink' {$nullcat}><span>{$catname}</span></span>
          </div>
        </div>
        <div class='articleText'>
          <p>{$text}</p>
        </div>
      </div>
    </div>
    ";
  }
  return $result;

}
add_shortcode('cocorotosou_newsget', 'cocorotosou_newsget_Func');



/**
 * [cocorotosou_newsslider no=取得記事順番 imgflg=1：imgか0：本文かフラグ]
 * @param  [type] $attr [description]
 * @return [type]       [description]
 * ココロトソウトップスライダー記事取得
 */
function cocorotosou_newsslider_Func($attr){
  extract(shortcode_atts(array(
   "no" => 1,
   "imgflg" => 0,
  ), $attr));
  $result = NULL;

  $args = array(
   'post_type' => "cocorotosou",
   'tax_query' => array(
   'relation'  => 'AND',
    array(
     'taxonomy' => 'cocorotosous', /* 指定したい投稿タイプが持つタクソノミーを指定 */
     'field'    => 'slug',
     'terms'    => 'featured', /* 上記で指定した変数を指定 */
    )
   ),
   'post_status'    => 'publish',
   'orderby'        => 'date',
   'order'          => 'DESC',
   'posts_per_page' => 1,
   'offset'         => $no,
  );

  $the_query = new WP_Query( $args );

  if ( $the_query->have_posts() ) :
   while ( $the_query->have_posts() ) : $the_query->the_post();
   //ここにループするテンプレート
   ////////////////////////////画像ゾーン///////////////////////////////////
   // アイキャッチ画像のIDを取得
   $thumbnail_id = get_post_thumbnail_id();
   $thumb_post = get_post($thumbnail_id);
   // mediumサイズの画像内容を取得（引数にmediumをセット）
   if (has_post_thumbnail() )  {
    $eye_img = wp_get_attachment_image_src( $thumbnail_id , 'thumbnail-about' );
    $thumb_url=$eye_img[0];
   }
   else {
    $thumb_url = cocoronoimage_ret();
   }
   //「説明」を取得
   $thumb_content = $thumb_post->post_content;
   //キャプションを取得
   $thumb_caption = $thumb_post->post_excerpt;
   //altを取得
   $post_meta = get_post_meta( $thumbnail_id );
   $thumb_alt = $post_meta['_wp_attachment_image_alt'][0];
   if(empty($thumb_alt))$thumb_alt;
   ////////////////////////////画像ゾーン///////////////////////////////////

   //本文
   // $text = do_shortcode(get_the_content()); // 元になる文字列
   $text = do_shortcode(get_the_content()); // 元になる文字列
   // HTMLエンティティを文字列に変換
   $text = html_entity_decode( $text );
   // 指定の文字数で切り出す
   $text = wp_trim_words( $text, 60, "..." );
   // HTMLエンティティを元に戻す
   $text = htmlentities( $text );

   $link = get_permalink();
   $date = get_the_date('Y.m.d');

   //タイトル
   $title = do_shortcode(get_the_title()); // 元になる文字列
   // HTMLエンティティを文字列に変換
   $title = html_entity_decode( $title );
   // 指定の文字数で切り出す
   $title = wp_trim_words( $title, 21, "..." );
   // HTMLエンティティを元に戻す
   $title = htmlentities( $title );

   //カテゴリ
   $catname = "";
   $catlink = "";
   $catnames = get_the_terms(get_the_ID(), "cocorotosous");
   if(is_array($catnames)){
    foreach ($catnames as $catnames_value) {
     if($catnames_value->slug == "all")continue;
     $catname = $catnames_value->name;
     $catlink = "/cocorotosou/".$catnames_value->slug;
    }
   }

  endwhile;
  endif;
  wp_reset_postdata();

  if((int)$imgflg === 1){
    /*imgの時*/
    $result = "<a href='{$link}' class='linkCover'></a><div class='backimage' style='background-image:url({$thumb_url});'></div>";
  }elseif((int)$imgflg === 0){
    /*文章の時*/
    $result = $text;
  }
  return $result;

}
add_shortcode('cocorotosou_newsslider', 'cocorotosou_newsslider_Func');


/**
 * [cocorotosou_eventinfo no=取得記事順番 imgflg=1：imgか0：本文かフラグ]
 * @param  [type] $attr [description]
 * @return [type]       [description]
 * ココロトソウトップイベントお知らせ記事取得
 */
function cocorotosou_eventinfo_Func($attr){
  extract(shortcode_atts(array(
   "no" => 1,
   "imgflg" => 0,
  ), $attr));
  $result = NULL;

  $args = array(
   'post_type' => "cocorotosou",
   'tax_query' => array(
   'relation'  => 'AND',
    array(
     'taxonomy' => 'cocorotosous', /* 指定したい投稿タイプが持つタクソノミーを指定 */
     'field'    => 'slug',
     'terms'    => array( 'information','event' ), /* 上記で指定した変数を指定 */
     'operator' => 'IN',
    )
   ),
   'post_status'    => 'publish',
   'orderby'        => 'date',
   'order'          => 'DESC',
   'posts_per_page' => 1,
   'offset'         => $no,
  );

  $the_query = new WP_Query( $args );

  if ( $the_query->have_posts() ) :
   while ( $the_query->have_posts() ) : $the_query->the_post();
   //ここにループするテンプレート
   ////////////////////////////画像ゾーン///////////////////////////////////
   // アイキャッチ画像のIDを取得
   $thumbnail_id = get_post_thumbnail_id();
   $thumb_post = get_post($thumbnail_id);
   // mediumサイズの画像内容を取得（引数にmediumをセット）
   if (has_post_thumbnail() )  {
    $eye_img = wp_get_attachment_image_src( $thumbnail_id , 'thumbnail-about' );
    $thumb_url=$eye_img[0];
   }
   else {
    $thumb_url = cocoronoimage_ret();
   }
   //「説明」を取得
   $thumb_content = $thumb_post->post_content;
   //キャプションを取得
   $thumb_caption = $thumb_post->post_excerpt;
   //altを取得
   $post_meta = get_post_meta( $thumbnail_id );
   $thumb_alt = $post_meta['_wp_attachment_image_alt'][0];
   if(empty($thumb_alt))$thumb_alt;
   ////////////////////////////画像ゾーン///////////////////////////////////

   //本文
   // $text = do_shortcode(get_the_content()); // 元になる文字列
   $text = do_shortcode(get_the_content()); // 元になる文字列
   // HTMLエンティティを文字列に変換
   $text = html_entity_decode( $text );
   // 指定の文字数で切り出す
   $text = wp_trim_words( $text, 60, "..." );
   // HTMLエンティティを元に戻す
   $text = htmlentities( $text );

   $link = get_permalink();

   $week = array ( '日', '月', '火', '水', '木', '金', '土' );
   $date = get_the_date('Y.m.d').' (' . $week[date ( 'w', get_the_date( 'U' ) )] . ')';

   //タイトル
   $title = do_shortcode(get_the_title()); // 元になる文字列
   // HTMLエンティティを文字列に変換
   $title = html_entity_decode( $title );
   // 指定の文字数で切り出す
   $title = wp_trim_words( $title, 21, "..." );
   // HTMLエンティティを元に戻す
   $title = htmlentities( $title );

   //カテゴリ
   $catname = "";
   $catlink = "";
   $catnames = get_the_terms(get_the_ID(), "cocorotosous");
   if(is_array($catnames)){
    foreach ($catnames as $catnames_value) {
     if($catnames_value->slug == "all")continue;
     $catname = $catnames_value->name;
     $catlink = "/cocorotosou/".$catnames_value->slug;
    }
   }

  endwhile;
  endif;
  wp_reset_postdata();

  if((int)$imgflg === 1){
    /*imgの時*/
    $result = "<a href='{$link}' class='linkCover'></a><div class='backimage' style='background-image:url({$thumb_url});'><span>{$date}</span></div>";
  }elseif((int)$imgflg === 0){
    /*文章の時*/
    $result = $title;
  }
  return $result;

}
add_shortcode('cocorotosou_eventinfo', 'cocorotosou_eventinfo_Func');


/**
 * [cocorotosou_simpleestimation]
 * @return [type]       [description]
 * ココロトソウトップ塗装見積シミュレーション
 */
function cocorotosou_simpleestimation_Func($attr){
  extract(shortcode_atts(array(
   "idname" => "",
  ), $attr));

  $result = NULL;
  $wall_dimens = get_estimation_dimens('est-cat-01');
  $roof_dimens = get_estimation_dimens('est-cat-02');
  $materials = get_estimation_materials();

  /*外壁の大きさ*/
  foreach ($wall_dimens as $wall_dimen) {
    $wall_item .= "<option value='{$wall_dimen}' >{$wall_dimen}</option>";
  }
  /*屋根の大きさ*/
  foreach ($roof_dimens as $roof_dimen) {
    $roof_item .= "<option value='{$roof_dimen}' >{$roof_dimen}</option>";
  }
  /*塗料*/
  foreach ($materials as $material) {
    $material_item .= "<option value='{$material['field']}'>{$material['label']}</option>";
  }

  $result .="
    <form id='estimation_form1' action='".esc_url( home_url( '/simple-estimation-result' ) )."' method='post'>
  ";

  $result .= "
  <div class='simulation_group'>
    <!-- 外壁 -->
    <div class='wall'>
      <p class='wall-title'>外壁の塗装</p>
      <div class='esti_form_item left gaiheki'>
        <div class='esti_form_label'>
          <label>外壁の大きさ（目安）</label>
        </div>
        <div class='esti_form_input'>
          <select  class='' name='wall_dimen'>
            <option value=''></option>
					  {$wall_item}
          </select>
        </div>
        <div class='clearfix'></div>
      </div>
      <div class='esti_form_item right gaihekiToryo'>
        <div class='esti_form_label'>
          <label>塗料ランク</label>
        </div>
        <div class='esti_form_input'>
          <select  class='' name='wall_material'>
            <option value=''></option>
            [$material_item]
          </select>
        </div>
        <div class='clearfix'></div>
      </div>
    </div>
    <!-- 外壁 -->

    <!--屋根-->
    <div class='roof'>
      <p class='roof-title'>屋根の塗装（目安）</p>
      <div class='esti_form_item left yane'>
        <div class='esti_form_label'>
          <label>屋根の大きさ</label>
        </div>
        <div class='esti_form_input'>
          <select  class='' name='roof_dimen'>
            <option value='' ></option>
            {$roof_item}
          </select>
        </div>
        <div class='clearfix'></div>
      </div>
      <div class='esti_form_item right yaneToryo'>
        <div class='esti_form_label'>
          <label>塗料ランク</label>
        </div>
        <div class='esti_form_input'>
          <select  class='' name='roof_material'>
            <option value='' ></option>
            {$material_item}
          </select>
        </div>
        <div class='clearfix'></div>
      </div>
    </div>
    <!--屋根-->
  </div>
  ";

  $result .="
    <input type='submit' class='esti-search-btn' id='esti-search-btn2' style='display:none;'></input>
    </form>
  ";

  return $result;

}
add_shortcode('cocorotosou_simpleestimation', 'cocorotosou_simpleestimation_Func');



/**
 * [cocorotosou_detail_getnewposts]
 * @param  [type] $attr [description]
 * @return [type]       [description]
 * ココロトソウ詳細　新しいコンテンツ　3つ
 */
function cocorotosou_detail_getnewposts_Func(){
  $result = NULL;

  $args = array(
   'post_type' => "cocorotosou",
   'tax_query' => array(
   'relation'  => 'AND',
    array(
     'taxonomy' => 'cocorotosous', /* 指定したい投稿タイプが持つタクソノミーを指定 */
     'field'    => 'slug',
     'terms'    => 'all', /* 上記で指定した変数を指定 */
    )
   ),
   'post_status'    => 'publish',
   'orderby'        => 'date',
   'order'          => 'DESC',
   'posts_per_page' => 3,
  );

  $the_query = new WP_Query( $args );

  if ( $the_query->have_posts() ) :
   while ( $the_query->have_posts() ) : $the_query->the_post();
   //ここにループするテンプレート
   ////////////////////////////画像ゾーン///////////////////////////////////
   // アイキャッチ画像のIDを取得
   $thumbnail_id = get_post_thumbnail_id();
   $thumb_post = get_post($thumbnail_id);
   // mediumサイズの画像内容を取得（引数にmediumをセット）
   if (has_post_thumbnail() )  {
    $eye_img = wp_get_attachment_image_src( $thumbnail_id , 'thumbnail-about' );
    $thumb_url=$eye_img[0];
   }
   else {
    $thumb_url = cocoronoimage_ret();
   }
   //「説明」を取得
   $thumb_content = $thumb_post->post_content;
   //キャプションを取得
   $thumb_caption = $thumb_post->post_excerpt;
   //altを取得
   $post_meta = get_post_meta( $thumbnail_id );
   $thumb_alt = $post_meta['_wp_attachment_image_alt'][0];
   if(empty($thumb_alt))$thumb_alt;
   ////////////////////////////画像ゾーン///////////////////////////////////

   //本文
   // $text = do_shortcode(get_the_content()); // 元になる文字列
   $text = do_shortcode(get_the_content()); // 元になる文字列
   // HTMLエンティティを文字列に変換
   $text = html_entity_decode( $text );
   // 指定の文字数で切り出す
   $text = wp_trim_words( $text, 30, "..." );
   // HTMLエンティティを元に戻す
   $text = htmlentities( $text );

   $link = get_permalink();
   $date = get_the_date('Y.m.d');

   //タイトル
   $title = do_shortcode(get_the_title()); // 元になる文字列
   // HTMLエンティティを文字列に変換
   $title = html_entity_decode( $title );
   // 指定の文字数で切り出す
   $title = wp_trim_words( $title, 21, "..." );
   // HTMLエンティティを元に戻す
   $title = htmlentities( $title );

   //カテゴリ
   $catname = "";
   $catlink = "";
   $catnames = get_the_terms(get_the_ID(), "cocorotosous");
   if(is_array($catnames)){
    foreach ($catnames as $catnames_value) {
     if($catnames_value->slug == "all")continue;
     $catname = $catnames_value->name;
     $catlink = "/cocorotosou/".$catnames_value->slug;
    }
   }
   $nullcat = "";
   if(empty($catname))$nullcat="style='display:none;'";

   $result .= "
   <div class='vc_row wpb_row vc_row-fluid newsList'>
                    <div class='parent_co1 wpb_column vc_column_container vc_col-sm-12'>
                        <div class='vc_column-inner'>
                            <div class='wpb_wrapper'>
                                <div class='vc_row wpb_row vc_inner vc_row-fluid'>
                                    <div class='co1 image wpb_column vc_column_container'>
                                        <div class='vc_column-inner'>
                                            <div class='wpb_wrapper'>
                                                <div class='wpb_text_column wpb_content_element '>
                                                    <div class='wpb_wrapper'>
                                                        <a href='{$link}' class='linkCover'></a>
                                                        <div class='backimage' style='background-image:url({$thumb_url});'><span class='BtnCover'><span class='newsListBtn ty_arrow'><span>詳しく見る</span></span></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='co2 text wpb_column vc_column_container'>
                                        <div class='vc_column-inner'>
                                            <div class='wpb_wrapper'>
                                                <div class='wpb_text_column wpb_content_element '>
                                                    <div class='wpb_wrapper'>
                                                        <div class='newsListText'>
                                                            <div class='newsListTextInner'>
                                                                <h3>{$title}</h3>
                                                                <div class='dateCategory flex'>
                                                                    <div class='date'>
                                                                        <i class='far fa-clock'></i>
                                                                        <span>{$date}</span>
                                                                    </div>
                                                                    <div class='category'>
                                                                        <span class='cateLink' {$nullcat}><span>{$catname}</span></span>
                                                                    </div>
                                                                </div>
                                                                <div class='articleText'>
                                                                    <p>{$text}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
   ";

  endwhile;
  endif;
  wp_reset_postdata();


  return $result;

}
add_shortcode('cocorotosou_detail_getnewposts', 'cocorotosou_detail_getnewposts_Func');
