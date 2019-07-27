<?php
/*
Template Name: 第二階層テンプレート
*/
?>
<?php get_header(); ?>

<!--secondLayer-->
<div id="wholeContents" class="wholeContents page-php" role="main">
	<div id="secondLayer" class="secondLayer">

		<div id="mainContents" class="mainContents">


			<div id="contentsWrapper" class="contentsWrapper">
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
	</div><!-- #secondLayer -->
</div><!--#wholeContents-->




<?php get_footer(); ?>
