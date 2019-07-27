<?php
/**
 * Template Name: Simple Estimation Result Page
 */

get_header(); ?>

<div class="main_panel maxWidth">

	<div class="main_panel_border">

		<div class="main_content_pane font-moto color-motoya">

			<div class="esti_resul_page_title">
				<p>料金目安シミュレーション</p>
			</div>

			<?php get_template_part( 'template-parts/page/estimation', 'priceblock' ); ?>

		</div>

	</div>

	<?php //conversion footer ?>

	<?php echo do_shortcode('[ins_get_page slug="conversion-footer"]'); ?>

</div>

<?php get_footer();
