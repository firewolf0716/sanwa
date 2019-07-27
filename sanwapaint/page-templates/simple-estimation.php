<?php
/**
 * Template Name: Simple Estimation Page
 */

get_header(); ?>

<div class="main_panel maxWidth">

	<div class="main_panel_border">

		<div class="main_content_pane font-moto color-motoya">



			<?php get_template_part( 'template-parts/page/estimation', 'form' ); ?>

		</div>

	</div>
	
</div>
	<?php //conversion footer ?>

	<?php echo do_shortcode('[ins_get_page slug="conversion-footer"]'); ?>
<?php get_footer();
