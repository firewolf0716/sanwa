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
$news_data_array = get_posts_list($post_type = "cocorotosou", $orderby = 'post_date', $ter = $myterm);
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
	$news_data = array_chunk($news_data_array, 10);//数字は件数
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


	$page_html = get_posts_pagenation($sou_page=$all_page, $gen_page=$current_page, $sento="<i class='fa-arrow-left'></i>", $saikoubi="<i class='fa-arrow-right'></i>", $page_option="cocorotosous/".$term."/?");
}

$myterm = get_term_by('slug', $term, 'cocorotosous');
$myterm_name = "すべての記事";
if($myterm->name !== "all")$myterm_name = $myterm->name;
?>

<?php get_header("cocoro"); ?>




<div id="wholeContents" class="wholeContents page-php" role="main">
    <div id="mainContents" class="mainContents">
    	<!--start newsList_section-->
    	<section id="newsList" class="pageWidth">
    		<div class="sec_inner maxWidth">
    			<div class="vc_row wpb_row vc_row-fluid cocoro_sectionTitle">
    			    <div class="wpb_column vc_column_container vc_col-sm-12">
    			        <div class="vc_column-inner">
    			            <div class="wpb_wrapper">
    			                <div class="wpb_text_column wpb_content_element ">
    			                    <div class="wpb_wrapper">
    			                        <h2><?php echo $myterm_name; ?>一覧</h2>
    			                    </div>
    			                </div>
    			                <div class="vc_empty_space  rem3" style="height: 3rem"><span class="vc_empty_space_inner"></span></div>
    			            </div>
    			        </div>
    			    </div>
    			</div>
    			<div class="listBox flex fWrap_wrap">
    			<?php
    			$now_page = get_query_var('page' , 1);
    			$offset = ( $now_page - 1 ) * 9;//数字は件数
    			$args = array(
    				'post_type' => array('cocorotosou'), /* 投稿タイプを指定 */
    				'tax_query' => array(
    					'relation' => 'AND',
    					array(
    						'taxonomy' => 'cocorotosous', /* 指定したい投稿タイプが持つタクソノミーを指定 */
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
    					$postcontent = do_shortcode(get_the_content()); // 元になる文字列
    					// HTMLエンティティを文字列に変換
    					$postcontent = html_entity_decode( $postcontent );
    					// 指定の文字数で切り出す
    					$postcontent = wp_trim_words( $postcontent, 30, "..." );
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

    					//タイトル
    					$title = do_shortcode(get_the_title()); // 元になる文字列
    					// HTMLエンティティを文字列に変換
    					$title = html_entity_decode( $title );
    					// 指定の文字数で切り出す
    					$title = wp_trim_words( $title, 21, "..." );
    					// HTMLエンティティを元に戻す
    					$title = htmlentities( $title );

    					$link = get_permalink();

       				$date = get_the_date('Y.m.d');

    					//カテゴリ
    					$catname = "";
    					$catlink = "";
    					$catnames = get_the_terms(get_the_ID(), "cocorotosous");
    					if(is_array($catnames)){
    					 foreach ($catnames as $catnames_value) {
    						if($catnames_value->slug == "all")continue;
    						$catname = $catnames_value->name;
    						$catlink = "/cocorotoso/".$catnames_value->slug;
    					 }
    					}
							$nullcat = "";
							if(empty($catname))$nullcat="style='display:none;'";

    					echo "
    					<!-- 1つ分 -->
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
    				                                                      <p>{$postcontent}</p>
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
    				  <!-- 1つ分 -->
    					";


    				endwhile;
    			}
    			if(!empty($retour)){
    				echo $retour;
    			}
    			?>

    			</div>
    			<div class="page_link">
    				<div class="pagination textCenterCm">
    					<?php if(count($news_data_array) >= 11){echo $page_html;}//数字は件数 ?>
    				</div>
    			</div>
    		</div><!--end sec_inner-->
    	</section><!--end newsList_section-->
    </div><!--#mainContents-->
</div><!--#wholeContents-->

<?php
get_footer("cocoro");
