<?php
$get = $_GET;
if ($get['page'] == NULL) {
	$get['page'] = 1;
}
if($term === "all"){
	$myterm = 1;
}else{
	$myterm = $term;
}
$news_data_array = get_posts_list($post_type = "カスタムポスト名", $orderby = 'post_date', $ter = $myterm);
$retour = NULL;
if(empty($news_data_array)){
	$retour = '<div class="no_product"><span>記事がありません。</span></div>';
	if (($get['page'] > "1") || ($get['page'] < "1") || !is_numeric($get['page'])) {
		header('HTTP/1.0 404 Not Found');
		include(TEMPLATEPATH.'/404.php');
		exit;
      //$get['page'] = 1;
	}
}else{
  // 12件なら12
	$news_data = array_chunk($news_data_array, 9);//数字は件数
	$all_page = count($news_data);

  // エラー回避処理、現在のページが総ページよりも大きい場合は（get値で適当な値がきたら）
	if (($get['page'] > $all_page) || ($get['page'] < "1") || !is_numeric($get['page'])) {
		header('HTTP/1.0 404 Not Found');
		include(TEMPLATEPATH.'/404.php');
		exit;
      //$get['page'] = 1;
	}

	$current_page = $get['page'];
	$current_page_flg = $get['page'] - 1;
	$news_data = $news_data[$current_page_flg];


	$page_html = get_posts_pagenation($sou_page=$all_page, $gen_page=$current_page, $sento="<i class='fa-arrow-left'></i>", $saikoubi="<i class='fa-arrow-right'></i>", $page_option="タクソノミー名/".$term."/?");
}

$myterm = get_term_by('slug', $term, 'タクソノミー名');
$myterm_name = "全件出力時のタイトル名";
if($myterm->name !== "all")$myterm_name = $myterm->name;
?>

<?php get_header(); ?>




<div id="wholeContents" class="wholeContents page-php" role="main">
    <div id="mainContents" class="mainContents">


      <?php
        //カテゴリ処理
        //echo do_shortcode('[shop_image_html  '.$cat_name.']');
      ?>
        <div id="newsDetails" class="maxWidth">
          <div class="products_main">
              <div class="secInner">
                <div class="DetailsWrap">
                    <div class="title titleText">
                        <h2 class="text title"><?php echo get_the_title() ?></h2>
                    </div>
                    <div class="date">
                        <?php echo get_the_date('Y.m.d'); ?>
                    </div>
                    <div class="main_news">


					<section id="works">
						<div class="secInner maxWidth">
							<ul class="books flex fWrap_wrap">
							<?php
							$now_page = get_query_var('page' , 1);
							$offset = ( $now_page - 1 ) * 9;//数字は件数
							$args = array(
								'post_type' => array('カスタムポスト名'), /* 投稿タイプを指定 */
								'tax_query' => array(
									'relation' => 'AND',
									array(
										'taxonomy' => 'タクソノミー名', /* 指定したい投稿タイプが持つタクソノミーを指定 */
										'field' => 'slug',
										'terms' => $term, /* 上記で指定した変数を指定 */
									)
								),
								'paged' => $paged,
								'offset' => $offset,
								'posts_per_page' => '9'//数字は件数
							);
							query_posts( $args );
							if (have_posts()){
							  while (have_posts()) :the_post();

									$postcontent = "";
									//本文
									$postcontent = get_the_content(); // 元になる文字列
									// HTMLエンティティを文字列に変換
									$postcontent = html_entity_decode( $postcontent );
									// 指定の文字数で切り出す
									$postcontent = wp_trim_words( $postcontent, 33, "..." );
									// HTMLエンティティを元に戻す
									$postcontent = htmlentities( $postcontent );

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
										$thumb_url = "NOIMAGEのパス";
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
								  $title = get_the_title();
								  $link = get_permalink();
								  echo('
							      ここに出力する内容
						        '.$title.'
										  ');
								endwhile;
							}
							if(!empty($retour)){
								echo $retour;
							}
							?>
							</ul>
						</div>
					</section>



                    </div>
                  </div>
                  <div class="page_link">
						<div class="pagination textCenterCm">
							<?php if(count($news_data_array) >= 10){echo $page_html;}//数字は件数 ?>
						</div>

                  </div>
              </div>
          </div>
          <?php
          // サイドバースタイルのときはコメントアウトを解除
          // echo'<div id="sidebar" class="side">';
          // echo' <div class="secInner">';
          // echo'   <div id="mypageSidebar" class="">';
          // echo'     <div class="sidebarTitle">';
          // echo'      <p></p>';
          // echo'     </div><!-- sidebarTitle -->';

          // dynamic_sidebar('mypage_news-sidebar');
          // echo'   </div><!--/#mypageSidebar -->';
          // echo'  </div><!-- /.secInner -->';
          // echo'</div><!-- /#sidebar -->';
            ?>

        </div>
    </div><!--#mainContents-->
</div><!--#wholeContents-->

<?php
get_footer();
