<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header();

 ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="main_panel font-noto">
	<div class="main_panel_border maxWidth2">
		<div class="main_content_pane">
			<!--Title-->
			<!-- <div id="detail_page_title">
				<p><?php //the_title(); ?></p>
			</div> -->

			<div class="vc_row wpb_row vc_row-fluid A01 caseDetailTitle">
			    <div class="wpb_column vc_column_container vc_col-sm-12">
			        <div class="vc_column-inner">
			            <div class="wpb_wrapper">
			                <div class="wpb_text_column wpb_content_element ">
			                    <div class="wpb_wrapper">
			                        <h2 class="style02">施工事例詳細</h2>
			                    </div>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>

			<div class="page_main_content" id="<?php the_ID(); ?>">

				<section class="page_left_pane">
				<?php get_template_part( 'template-parts/page/detail', 'view' ); ?>

				</section>
		
				<?php get_template_part( 'template-parts/page/detail', 'right' ); ?>
				
				<div class="clearfix"></div>
			</div>

		</div>
	</div>
</div>
<section class="relationArticle">
	<div class="sec_inner maxWidth">
			<div class="rem3" style="height:3rem;"></div>
			<?php get_template_part( 'template-parts/page/detail', 'rank' ); ?>
			<div class="rem5" style="height:5rem;"></div>
			<div class="rem1" style="height:1rem;"></div>
	</div>

</section>
</article>

<?php echo do_shortcode('[myparts_page_get getslug="simpleestimationparts"]') ?>


<!-- increase count views --> 
<?php setPostViews(get_the_ID()); ?>


<?php get_footer();
