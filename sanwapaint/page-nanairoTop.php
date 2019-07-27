<?php
/*
Template Name: なないろトップ
*/
?>
<?php get_header(); ?>

<!--page-->
<div id="wholeContents" class="wholeContents page-php" role="main">
	<div id="mainContents" class="mainContents">
		<!-- <div class="eyecatch">
			<div class="imageBox">
			<div class="image">
					<?php if(has_post_thumbnail()): ?> 
					    <?php the_post_thumbnail('topEyecatch',array('class' => 'hideSp hideTb')); ?>
					    <?php the_post_thumbnail('topEyecatchSP',array('class' => 'hidePc hideTb')); ?>
					    <?php the_post_thumbnail('topEyecatchTB',array('class' => 'hideSp hidePc')); ?>
					<?php endif; ?>
				</div>
			</div>
		</div> -->





		<div id="contentsWrapper" class="contentsWrapper flex">
			<!--sidebar-->
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
