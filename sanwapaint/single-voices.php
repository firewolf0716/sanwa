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

//get_header();

 ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="main_panel font-noto">
	<div class="main_panel_border maxWidth2">
		<div class="main_content_pane">

			<div class="page_main_content" id="<?php the_ID(); ?>">

				<?php
        if (is_preview()) {
          // プレビュー時

          //カテゴリ
          $catname = "";
          $catnames = get_the_terms(get_the_ID(), "branch");
          $length = count($catnames);
          $no = 0;
          if(is_array($catnames)){
           foreach ($catnames as $catnames_value) {
            $no++;
            if($no !== $length){
              $catname .= $catnames_value->name.",";
            }else{
              $catname .= $catnames_value->name;
            }
           }
          }
          $enquete_img = get_post_meta( get_the_ID(), 'enquete_img', true);
          $enquete_img = wp_get_attachment_image_src($enquete_img, 'full');
          echo "<div><span>タイトル：</span><span>".get_the_title()."</span></div>";
          echo "<div><span>公開日：</span><span>".get_the_date("Y.m.d")."</span></div>";
          echo "<div><span>支店・支社：</span><span>".$catname."</span></div>";
          echo "<div><span>アンケート画像：</span><br><img src='".$enquete_img[0]."' alt='アンケート画像'></div>";

          echo "<a href='<?php the_permalink() ?>'>
              <div class='rankBox'>
                <!-- <p class='ellipsisText'><?=$title?></p> -->
                <?php $vr_catch = get_post_meta( get_the_ID(), 'catch', true) ?:'&nbsp;'; ?>
                <p class='ellipsisText'><?=$vr_catch?></p>
                <div class='rem05' style='height:0.5rem'></div>
                  <div class='imageBox caseImage'>
                    <div class='image'>
                        <img src='<?=$image_url?>' alt='<?php echo $title; ?>'>
                    </div><!--end image-->
                    <div class='caseInfo flex'>
                      <p class='caseInfoText'>本事例を見る <i class='vc_btn3-icon fa fa-chevron-right'></i></p>
                    </div>
                  </div><!--end imageBox-->
              </div>
          </a>"
        } else {
          // 通常時
          // get_template_part('partials/content', 'single');
        }
         ?>

				<div class="clearfix"></div>
			</div>

		</div>
	</div>
</div>

</article>



<?php //get_footer();
