<?php
/*
Template Name: １カラムテンプレート
*/
?>
<?php get_header(); ?>

<!--page-->
<div id="wholeContents" class="wholeContents page-php" role="main">
	<div id="mainContents" class="mainContents">




		<div id="contentsWrapper" class="contentsWrapper">
			<!--sidebar-->
			<div id="sidebar">
				<?php
				if (is_page()) {
					$parent_id = $post->post_parent; // 親ページのIDを取得
					$parent_slug = get_post($parent_id)->post_name; // 親ページのスラッグを取得
					}
					dynamic_sidebar( $parent_slug.'-sidebar' );
					?>
			</div>
			<!--main-->
			<div id="main" class="main-content">
				<?php
				// ループ開始
				while ( have_posts() ) : the_post();

					// content-page.phpをロード
					get_template_part( 'template-parts/content', 'page' );//

					// コメント表示がオンになっていて、1つ以上のコメントがついている場合表示する
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				// ループ終わり
				endwhile;
				?>
			</div>
		</div><!--contentsWrapper-->


	</div><!--#mainContents-->
</div><!--#wholeContents-->




<?php get_footer(); ?>
