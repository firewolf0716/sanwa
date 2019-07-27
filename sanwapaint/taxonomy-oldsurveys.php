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
$news_data_array = get_posts_list($post_type = "oldsurvey", $orderby = 'post_date', $ter = $myterm);
$retour = NULL;
if(empty($news_data_array)){
	$retour = '<div class="no_product"><span>旧施工事例がありません。</span></div>';
	if (($get['page'] > "1") || ($get['page'] < "1") || !is_numeric($get['page'])) {
		header('HTTP/1.0 404 Not Found');
		include(TEMPLATEPATH.'/404.php');
		exit;
      //$get['page'] = 1;
	}
}else{
  // 12件なら12
	$news_data = array_chunk($news_data_array, 18);//数字は件数
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


	$page_html = get_posts_pagenation($sou_page=$all_page, $gen_page=$current_page, $sento="<i class='fas fa-arrow-left'></i>", $saikoubi="<i class='fas fa-arrow-right'></i>", $page_option="oldsurveys/".$term."/?");
}

$myterm = get_term_by('slug', $term, 'oldsurveys');
$myterm_name = "過去の施工事例";
if($myterm->name !== "all")$myterm_name = $myterm->name;
?>

<?php get_header(); ?>




<div id="wholeContents" class="wholeContents page-php" role="main">
    <div id="mainContents" class="mainContents">
    	<!--start newsList_section-->
    	<section id="newsList" class="pageWidth">
    		<div class="sec_inner maxWidth">
                <div class="search_title_box">
                    <div class="vc_row wpb_row vc_row-fluid A01 ">
                        <div class="wpb_column vc_column_container vc_col-sm-12">
                            <div class="vc_column-inner">
                                <div class="wpb_wrapper">
                                    <div class="wpb_text_column wpb_content_element ">
                                        <div class="wpb_wrapper">
                                            <h2 class="style02">過去のお客様アンケート</h2>
                                        </div>
                                    </div>
                                    <div class="wpb_wrapper">
                                        <div class="notice">過去のお客様アンケートをご覧いただけます。</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    			<div class="listBox flex fWrap_wrap">
    			<?php
    			$now_page = get_query_var('page' , 1);
    			$offset = ( $now_page - 1 ) * 18;//数字は件数
    			$args = array(
    				'post_type' => array('oldsurvey'), /* 投稿タイプを指定 */
    				'tax_query' => array(
    					'relation' => 'AND',
    					array(
    						'taxonomy' => 'oldsurveys', /* 指定したい投稿タイプが持つタクソノミーを指定 */
    						'field' => 'slug',
    						'terms' => $term, /* 上記で指定した変数を指定 */
    					)
    				),
    				'paged' => $paged,
    				'offset' => $offset,
    				'posts_per_page' => '18'//数字は件数
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
							$enquete_img_id = get_post_meta( get_the_ID(), 'enquete_img', true );
							if ( $enquete_img_id) {
								$enquete_img = wp_get_attachment_image_src($enquete_img_id, 'thumb480360');
								$enquete_img_path = $enquete_img[0];
							}else{
								$enquete_img_path = noimage_ret("thumb480360");
							}
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
    					$catnames = get_the_terms(get_the_ID(), "oldsurveys");
    					if(is_array($catnames)){
    					 foreach ($catnames as $catnames_value) {
    						if($catnames_value->slug == "all")continue;
    						$catname = $catnames_value->name;
    						$catlink = "/cocorotoso/".$catnames_value->slug;
    					 }
    					}
							$nullcat = "";
							if(empty($catname))$nullcat="style='display:none;'";

    			// 		echo "
    			// 		<!-- 1つ分 -->
							// <a href='{$link}'>
	      //           <div class='rankBox'>
	      //             <p class='ellipsisText'>{$title}</p>
	      //             <div class='rem05' style='height:0.5rem'></div>
	      //               <div class='imageBox caseImage'>
	      //                 <div class='image'>
	      //                     <img src='{$enquete_img_path}' alt='{$title}'>
	      //                 </div><!--end image-->
	      //               </div><!--end imageBox-->
	      //           </div>
	      //       </a>
    			// 	  <!-- 1つ分 -->
    			// 		";

                        echo "
                            <div class='listItem'>
                                <a href='{$link}'>
                                    <div class='rankBox'>
                                      <p class='ellipsisText'>{$title}</p>
                                      <div class='rem05' style='height:0.5rem'></div>
                                        <div class='imageBox caseImage'>
                                          <div class='image'>
                                              <img src='{$enquete_img_path}' alt='{$title}'>
                                          </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
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
    					<?php if(count($news_data_array) >= 19){echo $page_html;}//数字は件数+1 ?>
    				</div>
    			</div>
    		</div><!--end sec_inner-->
    	</section><!--end newsList_section-->
    </div><!--#mainContents-->
</div><!--#wholeContents-->

<?php
get_footer();
