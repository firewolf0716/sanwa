<?php
/*
Template Name: news全記事一覧
*/
?>


<!--newsAll-->
<div id="wholeContents" class="wholeContents page-php" role="main">
	<div id="newsAll" class="newsAll">
		<div id="mainContents" class="mainContents">

			<div id="contentsWrapper" class="contentsWrapper">
				<!--main-->
				<div id="main" class="main-content">

					 <div class="listWrapper">
				      <?php
							$args = array(
				        'orderby'       => 'id',
				        'order'         => 'ASC',
				        'hide_empty'    => true,
				      );
				      $terms = get_terms('category', $args);
							foreach ($terms as $term) {
								echo '
								  <div class="caltegory_wrap">
										<h2 class="news_category_title">'.$term->name.'</h2>
										'.do_shortcode( '[getNewItems 10 '.$term->term_id.']' ).'
										<div class="category_page_link">
											<a href="'.home_url().'/'.$term->slug.'" class="link">'.$term->name.'一覧へ≫</a>
										</div>
									</div>
								';
							}
							?>
					 </div>
				</div>
			</div><!--contentsWrapper-->


		</div><!--#mainContents-->
	</div><!-- #newsAll -->
</div><!--#wholeContents-->




<?php get_footer(); ?>






