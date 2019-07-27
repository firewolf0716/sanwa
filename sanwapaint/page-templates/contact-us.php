<?php
/**
 * Template Name: Sanwa Contact us Page
 */

get_header(); ?>

<div class="main_panel maxWidth">

	<div class="main_panel_border">

		<div class="main_content_pane font-moto color-motoya">
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

      <section class="vc_section"><div class="vc_row wpb_row vc_row-fluid A01 maxWidth"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner"><div class="wpb_wrapper">
        <div class="wpb_text_column wpb_content_element ">
          <div class="wpb_wrapper">
            <h2 class="style02">お問合せ</h2>

          </div>
        </div>
      </div></div></div></div></section>
      <section class="contactSection">
<?php echo do_shortcode('[contact-form-7 id="2234" title="Sanwa Contact Form" html_class="h-adr"]'); ?>
</section>

<script type="text/javascript">

jQuery(document).ready(function($) {
	document.getElementById("contact_type").selectedIndex = "0";
	var contact_groups = $('form [data-class="wpcf7cf_group"]');
	contact_groups.hide().trigger('wpcf7cf_hide_group');
	contact_groups.each(function (index) {
	    contact_group = jQuery(this);
	    if (index == 0) {
	    	contact_group.show().trigger('wpcf7cf_show_group');
	    }
	});

<?php $wall_flag = $_POST['er_wall_flag'] ?: '';
	$roof_flag = $_POST['er_roof_flag'] ?: '';
	if ( $wall_flag == 1 && $roof_flag == 1 ) : ?>
	$('#reform4 input[value="屋根／外壁ともに"]').attr("checked", "checked");
<?php elseif ( $roof_flag == 1 ) : ?>
	$('#reform4 input[value="屋根"]').attr("checked", "checked");
<?php elseif ( $wall_flag == 1 ) : ?>
	$('#reform4 input[value="外壁"]').attr("checked", "checked");
<?php endif; ?>
	var other_comment_area = $('form #other_comment');
	var t_html = '', w_html = '', r_html = '';
<?php if ( $wall_flag == 1 ) : ?>
	w_html = "<?=$_POST['er_wall_dimen']?>   <?=$_POST['er_wall_material']?>\n<?=$_POST['er_wall_price']?>\n";
<?php endif; ?>
<?php if ( $roof_flag == 1 ) : ?>
	r_html = "<?=$_POST['er_roof_dimen']?>   <?=$_POST['er_roof_material']?>\n<?=$_POST['er_roof_price']?>\n";
<?php endif; ?>
	t_html = "<?=$_POST['er_total_price']?>";
	other_comment_area.text(w_html+r_html+t_html);

});

</script>

		</div>

	</div>

</div>

<?php get_footer();
