<?php
// $get = $_GET;
// $saiyou = NULL;
// $saiyou = $_GET['adopt'];
// if($saiyou != "new_grad" && $saiyou != "mid_recruit" ) {
// 	header('HTTP/1.0 404 Not Found');
// 	include(TEMPLATEPATH.'/404.php');
// 	exit;
// }


$get = $_GET;
if ($get['page'] == NULL) {
	$get['page'] = 1;
}
if($term === "all"){
	$myterm = 1;
}else{
	$myterm = $term;
}
$news_data_array = get_posts_list($post_type = "customtest", $orderby = 'post_date', $ter = $myterm);
$retour = NULL;
if(empty($news_data_array)){
	$retour = '<div class="no_product"><span>Worksがありません。</span></div>';
	if (($get['page'] > "1") || ($get['page'] < "1") || !is_numeric($get['page'])) {
		header('HTTP/1.0 404 Not Found');
		include(TEMPLATEPATH.'/404.php');
		exit;
      //$get['page'] = 1;
	}
}else{
  // 12件出してるから12
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


	$page_html = get_posts_pagenation($sou_page=$all_page, $gen_page=$current_page, $sento="<i class='fa-arrow-left'></i>", $saikoubi="<i class='fa-arrow-right'></i>", $page_option="customtest_cat/".$term."/?");
}

$myterm = get_term_by('slug', $term, 'customtest_cat');
$myterm_name = "すべて";
if($myterm->name !== "all")$myterm_name = $myterm->name;
?>

<?php get_header(); ?>
<div class="contentWrap">
	<div class="skewbox"></div>

	<section id="pageTitle" class="">
		<div class="secInner maxWidth">
			<div class="pageTitle">
				<h1 class="openSans">Works</h1>
			</div>
			<div class="showCategory">
				<h2><?php echo $myterm_name; ?></h2>
			</div>
		</div>
	</section>



	<section id="works">
		<div class="secInner maxWidth">
			<ul class="books flex fWrap_wrap">
			<?php
			$now_page = get_query_var('page' , 1);
			$offset = ( $now_page - 1 ) * 9;//数字は件数
			$args = array(
				'post_type' => array('customtest'), /* 投稿タイプを指定 */
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'customtest_cat', /* 指定したい投稿タイプが持つタクソノミーを指定 */
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
			  	$img = do_shortcode('[custam_img img_1]');
				  $title = get_the_title();
				  $link = get_permalink();
				  echo('
			      ここに出力する内容
		        '.$title.'
						  ');
				endwhile;
			}
			?>
			</ul>
		</div>
	</section>
	<div class="pagination textCenterCm">
		<?php if(count($news_data_array) >= 10){echo $page_html;}//数字は件数 ?>
	</div>

	<div class="genreLinks innerWidth">
		<div class="genreLinkBox flex fWrap_wrap">
			<div class="all">
				<a href="/customtest_cat/all/"><span>すべてを見る</span></a>
			</div>
          <?php echo do_shortcode('[genre_term]'); ?>
		</div>
	</div>

</div>
<?php
get_footer();
