<?php
/**
 * Template Name: Sanwa Search Page
 */

get_header(); ?>

<div class="main_panel maxWidth">

	<div class="main_panel_border">

		<div class="main_content_pane font-moto color-motoya">

			<div class="search_title_box">
				<div class="vc_row wpb_row vc_row-fluid A01 ">
				    <div class="wpb_column vc_column_container vc_col-sm-12">
				        <div class="vc_column-inner">
				            <div class="wpb_wrapper">
				                <div class="wpb_text_column wpb_content_element ">
				                    <div class="wpb_wrapper">
				                        <h2 class="style02">色から選ぶ施工事例検索<?php //the_title(); ?></h2>
				                    </div>
				                </div>
				                    <div class="wpb_wrapper">
				                        <h3 class="style02" style="text-align: center;">下記より条件を指定し、施工事例を御覧ください。<br>
				                        	<?php //the_title(); ?></h3>
										<div class="notice" >複数選択することで絞り込みの検索結果となります</div>

				                    </div>
				                </div>
				            </div>
				        </div>
				    </div>
				</div>
			</div>

			<div class="search_container ">

				<div class="search_left_container ">
					<?php get_template_part( 'template-parts/page/search', 'form' ); ?>
				</div>

 				<div class="otherContents">
					<?php get_template_part( 'template-parts/page/search', 'right' ); ?>
				</div>

				<?php echo do_shortcode('[ins_get_page slug="conversion-footer"]'); ?>

			</div>

		</div>

	</div>

<?php get_footer();
