<?php
//ターム一覧
function tearm_groupFunc($attr){
  $works_id = get_term_by( 'slug', 'works', 'maruso_recruit_cat' );
  $taxonomy = $attr[0];
  $result = NULL;
  $args = array(
    'hide_empty' => false,
    'parent' => $works_id->term_id
  );
  // カスタム分類のタームのリストを取得
  $terms = get_terms( $taxonomy , $args );
  if( !empty( $terms ) && !is_wp_error( $terms ) ) {
    foreach($terms as $term){
      $result .= '<p>'.$term->name."\n".'</p>';
    }
  }
  return $result;
}
add_shortcode('tearm_group', 'tearm_groupFunc');


//都道府県ターム一覧
function todouhuken_tearm_groupFunc($attr){
  $area_id = get_term_by( 'slug', 'area', 'maruso_recruit_cat' );
  $taxonomy = $attr[0];
  $result = NULL;
  $args = array(
    'hide_empty' => false,
    'parent' => $area_id->term_id
  );
  // カスタム分類のタームのリストを取得
  $terms = get_terms( $taxonomy , $args );
  if( !empty( $terms ) && !is_wp_error( $terms ) ) {
    foreach($terms as $term){
      $result .= '<p>'.$term->name."\n".'</p>';
    }
  }
  return $result;
}
add_shortcode('todouhuken_tearm_group', 'todouhuken_tearm_groupFunc');


//都道府県AND事業所で絞った募集一覧
function area_and_office_worksFunc($attr){
  $works_id = get_term_by( 'slug', 'works', 'maruso_recruit_cat' );
  $taxonomy = 'maruso_recruit_cat';
  $html = NULL;
  $args = array(
    'hide_empty' => false,
    'parent' => $works_id->term_id
  );
  // カスタム分類のタームのリストを取得
  $terms = get_terms( $taxonomy , $args );
  if( !empty( $terms ) && !is_wp_error( $terms ) ) {
    foreach($terms as $term){
      $args2 = array(
        'post_type' => array('maruso_recruit'), /* 投稿タイプを指定 */
        'order' => 'DESC',  // カスタム投稿タイプ名
        'tax_query' => array(
        'relation' => 'AND',
          array(
            'taxonomy' => $taxonomy, /* 指定したい投稿タイプが持つタクソノミーを指定 */
            'field' => 'term_id',
            'terms' => $attr[0], /* 都道府県を指定 */
          ),
          array(
            'taxonomy' => $taxonomy, /* 指定したい投稿タイプが持つタクソノミーを指定 */
            'field' => 'term_id',
            'terms' => $attr[1], /* 事業所を指定 */
          ),
          array(
            'taxonomy' => $taxonomy, /* 指定したい投稿タイプが持つタクソノミーを指定 */
            'field' => 'slug',
            'terms' => $term->slug, /* 職種を指定 */
          )
        ),
      'posts_per_page' => -1
      );
      query_posts( $args2 );
      if (have_posts()){
        $html .= '<div><p>'.$term->name.'</p></div>';
        $html .= "<ul>";
        while (have_posts()) :the_post();
          $title = get_the_title();
          $a_office = get_term_by( 'term_id', $attr[1], 'maruso_recruit_cat' );
          $link = get_permalink().'?no='.get_the_ID().'&c='.$term->slug.'&a='.$a_office->slug;
          $html .='<li><a href="'.$link.'" title="'.$title.'">'.$title.'</a><li>';
       endwhile;
       $html .= "</ul>";
      }
    }//foreach
  }

  return $html;
}
add_shortcode('area_and_office_works', 'area_and_office_worksFunc');





//ターム(ジャンル)一覧
function genre_termFunc(){
/*
<div class="co1">
  <a href=""><span>ジャンル</span></a>
</div>
<div class="co2">
  <a href=""><span>ジャンル</span></a>
</div>
*/
  $taxonomy = 'works_cat';
  $genre_id = get_term_by( 'slug', 'genre', $taxonomy );
  $result = NULL;
  $args = array(
    'hide_empty' => false,
    'parent' => $genre_id->term_id
  );
  // カスタム分類のタームのリストを取得
  $terms = get_terms( $taxonomy , $args );
  if( !empty( $terms ) && !is_wp_error( $terms ) ) {
    $col =0;
    foreach($terms as $term){
      $col += 1;
      $result .= '
        <div class="co'.$col.'">
          <a href="/works_cat/'.$term->slug.'"><span>'.$term->name.'</span></a>
        </div>
      ';
    }
  }
  return $result;
}
add_shortcode('genre_term', 'genre_termFunc');


//トップWorks2件づつ出すところ　全6件
function top_allgenre_listFunc(){
  $genre_id = get_term_by( 'slug', 'genre', 'works_cat' );
  $result = NULL;
  $customPostArg = array(
    'posts_per_page' => 6,
    'post_status' => 'publish',
    'post_type'      => 'works',  // カスタム投稿タイプ名
    'order'      => 'DESC',
    'orderby'    => 'date',
  );
  global $post;
  $myposts = get_posts($customPostArg);
  $num = 0;
  foreach($myposts as $post) :
    setup_postdata($post);
    // // アイキャッチ画像のIDを取得
    // $thumbnail_id = get_post_thumbnail_id();
    // $thumb_post = get_post($thumbnail_id);
    // // mediumサイズの画像内容を取得（引数にmediumをセット）
    // if (has_post_thumbnail() )  {
    //   $eye_img = wp_get_attachment_image_src( $thumbnail_id , 'thumbnail-about' );
    //   $thumb_url=$eye_img[0];
    // }
    // else {
    //   $thumb_url ="/wp-content/uploads/2017/12/noimage.png";
    // }
    // //「説明」を取得
    // $thumb_content = $thumb_post->post_content;
    // //キャプションを取得
    // $thumb_caption = $thumb_post->post_excerpt;
    // //altを取得
    // $post_meta = get_post_meta( $thumbnail_id );
    // $thumb_alt = $post_meta['_wp_attachment_image_alt'][0];
    $post_terms = get_the_terms($post->ID,'works_cat');
    $cat = NULL;
    foreach($post_terms as $post_term) {
      if($genre_id->term_id === $post_term->parent) $cat .= '<span class="genre">'.$post_term->name.'</span>';
    }
    $img = do_shortcode('[custam_img img_1]');
    $zuri = NULL;
    if(!empty(post_custom('print'))) $zuri = post_custom('print').'刷り';
    $result .= '
<li class="swiper-slide">
  <a href="'.get_permalink().'">
    <div class="bookImage">
      <div class="image">
        '.$img.'
      </div>
    </div>
    <div class="bookInfo">
      <div class="bookInfoInner">
        <div class="genrebox flex">
          '.$cat.'
        </div>
        <div class="titleBox">
          <h4>'.$post->post_title.'</h4>
          <div class="subTitle">
            <span>'.post_custom('overview').'</span>
          </div>
        </div>
        <div class="detailInfo">
          <span>'.post_custom('information').'</span>
          <span>発行：'.post_custom('date').'</span>
          <span>定価：'.post_custom('price').'</span>
          <span class="zuri">'.$zuri.'</span>
        </div>
      </div>
    </div>
  </a>
</li>
    ';
  endforeach;
  wp_reset_postdata();

  return $result;
}
add_shortcode('top_allgenre_list', 'top_allgenre_listFunc');


//トップ各カテゴリ10件スライド
function top_itiosi_genrelistFunc(){
  global $post;
  $recommend_id = get_term_by( 'slug', 'recommend', 'works_cat' );
  $result = NULL;
  $args = array(
    'hide_empty' => true,
    'parent' => $recommend_id->term_id
  );
  // カスタム分類のタームのリストを取得
  $recommend_terms = get_terms('works_cat', $args);
  if( !empty( $recommend_terms ) && !is_wp_error( $recommend_terms ) ) {
    foreach($recommend_terms as $recommend_term){
        $customPostArg = array(
          'posts_per_page' => 10,
          'post_status' => 'publish',
          'post_type'      => 'works',  // カスタム投稿タイプ名
          'order'      => 'DESC',
          'orderby'    => 'date',
          'tax_query' => array(
            'relation' => 'AND',
              array(
                'taxonomy' => 'works_cat', /* 指定したい投稿タイプが持つタクソノミーを指定 */
                'field' => 'slug',
                'terms' => $recommend_term->slug, /* 上記で指定した変数を指定 */
              )
          ),
        );
        $myposts = get_posts($customPostArg);
        $num = 0;
        $result .= '
<div class="swiper-slide">
  <ul class="books flex fWrap_wrap">
          ';
        foreach($myposts as $post) :
          setup_postdata($post);
          $img = do_shortcode('[custam_img img_1]');
          $result .= '
<li>
  <a href="'.get_permalink().'">
    <div class="image">
      '.$img.'
    </div>
  </a>
</li>
            ';
        endforeach;
        $result .= '
  </ul>
</div>
        ';
    }
  }
  wp_reset_postdata();
  return $result;
}
add_shortcode('top_itiosi_genrelist', 'top_itiosi_genrelistFunc');

//トップ各カテゴリ10件スライドの下のスtライド
function top_itiosi_genrelist2Func(){
  $recommend_id = get_term_by( 'slug', 'genre', 'works_cat' );
  $result = NULL;
  $args = array(
    'hide_empty' => true,
    'parent' => $recommend_id->term_id
  );
  // カスタム分類のタームのリストを取得
  $recommend_terms = get_terms('works_cat', $args);
  if( !empty( $recommend_terms ) && !is_wp_error( $recommend_terms ) ) {
    foreach($recommend_terms as $recommend_term){
      $name = preg_replace("/\(.+?\)/","",$recommend_term->name);
      $result .= '
<div class="swiper-slide">
  <div class="flex">
    <span>'.$name.'</span>
    <a href="/works_cat/'.$recommend_term->slug.'" class="rightArrow">See All</a>
  </div>
</div>
      ';
    }
  }
  return $result;
}
add_shortcode('top_itiosi_genrelist2', 'top_itiosi_genrelist2Func');


//都道府県ターム一覧
function todouhuken_tearm_groupFunc($attr){
  $area_id = get_term_by( 'slug', 'area', 'maruso_recruit_cat' );
  $taxonomy = $attr[0];
  $result = NULL;
  $args = array(
    'hide_empty' => false,
    'parent' => $area_id->term_id
  );
  // カスタム分類のタームのリストを取得
  $terms = get_terms( $taxonomy , $args );
  if( !empty( $terms ) && !is_wp_error( $terms ) ) {
    foreach($terms as $term){
      $result .= '<p>'.$term->name."\n".'</p>';
    }
  }
  return $result;
}

//投稿ランダムn件取得
function post_random_getFunc($attr,$attr2){
  $result = array();
  if($attr === "post"){
    $num = 0;
  }else{
    $num = 4;
  }
  $args = array(
    'post_type' => $attr,
    'post_status' => 'publish',
    'orderby'   => 'rand', // 記事のランダム表示設定
    'posts_per_page'    => $attr2,
  );
  // $the_query = get_posts($args);
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
      $thumb_url ="/wp-content/uploads/2018/05/noimg.png";
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
    $num += 1;
    $result['num'.$num] = '<div class="item item'.$num.'"> <a href="'.get_permalink().'" class="link"><img src="'.$thumb_url.'" alt="'.$thumb_alt.'">'.get_the_title().'</a> </div>';
    endwhile;
  endif;
  wp_reset_postdata();

  return $result;
}
//add_shortcode('post_random_get', 'post_random_getFunc');
