<?php
/**
 * [staff_list branch=大阪支社]
 * @param  [type] $attr [description]
 * @return [type]       [description]
 */
function staff_list_Func($attr){
  extract(shortcode_atts(array(
   "branch" => "",
  ), $attr));
  $result = NULL;

  if(empty($branch)){$result;}/*店舗指定無いとき*/

  $args = array(
   'post_type' => "staff",
   'tax_query' => array(
   'relation'  => 'AND',
    array(
     'taxonomy' => 'branch', /* 指定したい投稿タイプが持つタクソノミーを指定 */
     'field'    => 'slug',
     'terms'    => $branch, /* 上記で指定した変数を指定 */
    )
   ),
   'post_status'    => 'publish',
   // 'orderby'        => 'date',
   // 'order'          => 'DESC',
   'posts_per_page' => -1,
  );

  $the_query = new WP_Query( $args );

  if ( $the_query->have_posts() ) :
    while ( $the_query->have_posts() ) : $the_query->the_post();
      $staffname = get_the_title();
      $staffcomment = do_shortcode(get_the_content());
      $business_position = get_post_meta( get_the_ID(), 'business_position', true );
      $staff_post_id = get_post_meta(get_the_ID(), 'staff_photo', true );
      if ( $staff_post_id) {
        $staffimg = wp_get_attachment_image_src($staff_post_id, 'thumbnail-profile');
        $staffimgpath = $staffimg[0];/*スタッフ画像*/
      }
      if(empty($staff_post_id)){continue;}
      echo "
      <div class='vc_empty_space  rem1' style='height: 1rem'><span class='vc_empty_space_inner'></span></div>
      <div class='vc_row wpb_row vc_inner vc_row-fluid A04Inner_row A02_inner'><div class='wpb_column vc_column_container vc_col-sm-4'><div class='vc_column-inner'><div class='wpb_wrapper'>
      	<div class='wpb_single_image wpb_content_element vc_align_center'>

      		<figure class='wpb_wrapper vc_figure'>
      			<div class='vc_single_image-wrapper   vc_box_border_grey'><img width='400' height='400' src='{$staffimgpath}' class='vc_single_image-img attachment-large' alt='' sizes='(max-width: 400px) 100vw, 400px'></div>
      		</figure>
      	</div>
      </div></div></div><div class='wpb_column vc_column_container vc_col-sm-8'><div class='vc_column-inner'><div class='wpb_wrapper'>
      	<div class='wpb_text_column wpb_content_element  staffDetail'>
      		<div class='wpb_wrapper'>
      			<h3 class='style02'>{$business_position}<br>
      {$staffname}</h3>
      <p>{$staffcomment}</p>

      		</div>
      	</div>
      <div class='vc_empty_space  rem1' style='height: 1rem'><span class='vc_empty_space_inner'></span></div>
      </div></div></div></div>
      ";
    endwhile;
  endif;
  wp_reset_postdata();
}
add_shortcode('staff_list', 'staff_list_Func');
