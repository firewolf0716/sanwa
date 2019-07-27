<?php
/*
Template Name: フォーム用
*/
?>
<?php get_header(); ?>

<!--form-->
<div id="wholeContents" class="wholeContents page-php" role="main">
	<div id="formPage" class="formPage">

		<div id="mainContents" class="mainContents">


			<div id="contentsWrapper" class="contentsWrapper">
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
	</div><!-- #secondLayer -->
</div><!--#wholeContents-->





<?php get_footer(); ?>
