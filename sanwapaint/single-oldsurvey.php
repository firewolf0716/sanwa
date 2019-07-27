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

<?php
//カテゴリ
$postname = "";
$postlink = "";
$postnames = get_the_terms(get_the_ID(), "oldsurveys");
if(is_array($postnames)){
 foreach ($postnames as $postnames_value) {
  $postslug = $postnames_value->slug;
 }
}
$next_post = get_termgroup_nex_pre(get_the_ID(),$postslug,"oldsurveys","oldsurvey","nex");
$prev_poxt = get_termgroup_nex_pre(get_the_ID(),$postslug,"oldsurveys","oldsurvey","pre");
if (!empty( $next_post )){
  $nex = get_permalink( $next_post[0]->ID );
  $nextitle = get_the_title($next_post[0]->ID);
}
if (!empty( $prev_poxt )){
  $pre = get_permalink( $prev_poxt[0]->ID );
  $pretitle = get_the_title($prev_poxt[0]->ID);
}

/*アンケート画像*/
$enquete_img_id = get_post_meta( get_the_ID(), 'enquete_img', true );
if ( $enquete_img_id) {
  $enquete_img = wp_get_attachment_image_src($enquete_img_id, 'full');
  $enquete_img_path = $enquete_img[0];
}else{
  $enquete_img_path = "";//noimage_ret("thumb480360");
}

$post_title = get_the_title();/*タイトル*/
$post_date = get_the_date("Y.m.d");/*日付*/
$post_content = do_shortcode(get_the_content());/*本文*/
?>

<!--start enquete_section-->
<section id="enquete" class="pageWidth">
  <div class="sec_inner maxWidth">
    <!--start enquete_row-->
    <div class="enquete_block">
      <div class="enquete_row1 enquete_row box_row">
        <div class="search_title_box">
            <div class="vc_row wpb_row vc_row-fluid A01 ">
                <div class="wpb_column vc_column_container vc_col-sm-12">
                    <div class="vc_column-inner">
                        <div class="wpb_wrapper">
                            <div class="wpb_text_column wpb_content_element ">
                                <div class="wpb_wrapper">
                                    <h2 class="style02">過去のお客様アンケート</h2>
                                </div>
                            </div>
                            <div class="wpb_wrapper">
                                <div class="notice">過去のお客様アンケートをご覧いただけます。</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div><!--end enquete_row-->
      <div class="enquete_row2 enquete_row box_row">
        <div class="imageBox">
          <div class="image">
              <img src="<?=$enquete_img_path?>" alt="">
          </div><!--end image-->
        </div><!--end imageBox-->
      </div><!--end enquete_row-->
    </div><!--end enquete_block-->
    <div class="rem5" style="height:5rem"></div>

    <div class="pageLink flex">
      <div class="prevBox">
        <?php if (!empty($pre)){ ?><div class="prev"><a href="<?php echo $pre; ?>" class="leftArrow linkType1"><span><<<br></span><?php echo $pretitle; ?></a></div><?php } ?>
      </div>
      <div class="splitBox"></div>
      <div class="nextBox">
        <?php if (!empty($nex)){ ?><div class="next"><a href="<?php echo $nex; ?>" class="rightArrow linkType1"><span>>><br></span><?php echo $nextitle; ?></a></div><?php } ?>
      </div>
    </div>


    <div class="rem5" style="height:5rem"></div>
    <div class="rem1" style="height:1rem"></div>
  </div><!--end sec_inner-->
</section><!--end enquete_section-->
<?php get_footer();
