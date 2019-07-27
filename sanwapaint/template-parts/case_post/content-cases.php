<?php
/**
 * Template part for displaying posts with excerpts
 *
 */

require locate_template('lib/get_cases_detail.php');

?>

<?php
global $post;
$newclass="";
if( is_newest_post($post) ) {
    $newclass = "newon";
}


$catch = get_post_meta( get_the_ID(), 'catch', true) ?:'&nbsp;';
 ?>

<div class="resultWrapper">
	<div class="vc_row wpb_row vc_row-fluid A02-01">
		<div class="wpb_column vc_column_container vc_col-sm-12">
			<div class="vc_column-inner">
				<div class="wpb_wrapper">
					<div class="wpb_text_column wpb_content_element " >
						<div class="wpb_wrapper">
							<a class="listCasesTitle" rel="bookmark" href="<?=esc_url( get_permalink() )?>">
								<span class="new7day <?=$newclass?>">NEW</span>
								<h4 class="style02 element file-alt-e border-b1c6"><?=$catch?> [<?=the_title()?>]</h4>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



	<div class="vc_row wpb_row vc_row-fluid A04">
		<div class="wpb_column vc_column_container vc_col-sm-12">
			<div class="vc_column-inner">
				<div class="wpb_wrapper">
					<div class="vc_row wpb_row vc_inner vc_row-fluid A04Inner_row">

		<?php
			$after_image = get_post_meta( get_the_ID(), 'after_photo', true);
      $before_image = get_post_meta( get_the_ID(), 'before_photo', true);
			if ($after_image[0]){
				$main_image = $after_image[0];//画像URL
	      $url_info = pathinfo($main_image);//切り分ける
	      $main_image = $url_info["dirname"];//拡張子なし
	      $main_image = $main_image."/".$url_info["filename"]."-480x360.".$url_info["extension"];
	      $main_image_array = get_headers($main_image);
	      if(!strpos($main_image_array[0],'OK')){
	        $main_image = $main_image[0];
	      }
			}elseif($before_image[0]){
        $main_image = $before_image[0];//画像URL
        $url_info = pathinfo($main_image);//切り分ける
        $main_image = $url_info["dirname"];//拡張子なし
        $main_image = $main_image."/".$url_info["filename"]."-480x360.".$url_info["extension"];
        $main_image_array = get_headers($main_image);
        if(!strpos($main_image_array[0],'OK')){
          $main_image = $main_image[0];
        }
      }else{
					$main_image = noimage_ret("thumb480360");
			}
		?>

						<div class="wpb_column vc_column_container vc_col-sm-6 left">
							<div class="vc_column-inner">
								<div class="wpb_wrapper">
									<div  class="wpb_single_image wpb_content_element vc_align_center">
										<figure class="wpb_wrapper vc_figure ">
											<div class="vc_single_image-wrapper   vc_box_border_grey featured_box">
												<div class="imageWrapper">
													<a rel="bookmark" href="<?=esc_url( get_permalink() )?>">
														<img class="featured_modal_image vc_img-placeholder vc_single_image-img h100" src="<?=$main_image?>" />

													<div class="buttonWrapper">
														<p>本事例を見る <i class="vc_btn3-icon fa fa-chevron-right"></i>
														</p>
													</a>
												</div>
												</div>

											</div>
										</figure>
									</div>
									<!-- <div class="vc_empty_space  rem1"   style="height: 1rem" >
										<span class="vc_empty_space_inner"></span>
									</div> -->
								</div>
							</div>
						</div>

						<div class="wpb_column vc_column_container vc_col-sm-6 right">
							<div class="vc_column-inner">
								<div class="wpb_wrapper include-child">
									<div class="wpb_text_column wpb_content_element " >
										<div class="wpb_wrapper detail_info">

											<p class="list_det_p">
												<!-- <span class="icon"><i class="fas fa-home"></i></span>　 -->
												戸建の様式：<a rel="bookmark" href="/?post_type=cases&s_detacheds[]=<?=$detacheds?>"><?=$detacheds?></a>
											</p>
											<p class="list_det_p">
												<!-- <span class="icon"><i class="fas fa-hard-hat"></i></span>　 -->
												ハウスメーカー：<a rel="bookmark" href="/?post_type=cases&s_housemakers[]=<?=$housemakers?>"><?=$housemakers?></a>
											</p>
											<p class="list_det_p">
												<!-- <span class="icon"><i class="fas fa-building"></i></span>　 -->
												支店名：<a rel="bookmark" href="/?post_type=cases&s_branch=<?=$branch?>"><?=$branch?></a>
											</p>
											<p class="list_det_p">
												<!-- <span class="icon"><i class="fas fa-building"></i></span>　 -->
												その他の工事：
												<?php//cho $branch; ?>
												<?=$other_works_text_link?>
											</p>



											<?php //$case_type_text 使用塗料タイブ ?>
											<?php //$worry_elements_text お悩みの形 ?>
											<?php //$outwall_types_text 外壁種類 ?>

											<div class="list_color">
												<div class="pull-left text-left margin-r5">色</div>
												<div class="pull-left padding-t2">

												<?php
												if ($detail_imgs_full) {
							                        foreach ($detail_imgs_full as $dimg) {
							                            if (get_the_post_thumbnail_url($dimg[0],'thumb180120'))
							                                $d_img_url = get_the_post_thumbnail_url($dimg[0],'thumb180120');
							                            else
							                                $d_img_url = noimage_ret("thumb180120");

						                        ?><a rel="bookmark" href="/?post_type=cases&<?=$dimg[1]?>=<?=$dimg[2]?>">
						                            <label class="color_block pull-left" style="background-image: url(<?=$d_img_url?>);"></label>
																			</a>
						                        <?php
						                       		}
						                       	}
						                        ?>

												</div>
											</div>


										</div>

									</div>
									<!-- <div class="vc_empty_space  rem1"   style="height: 1rem" >
										<span class="vc_empty_space_inner"></span>
									</div> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- 	<div class="vc_row wpb_row vc_inner vc_row-fluid btn">
		<div class="wpb_column vc_column_container">
			<div class="vc_column-inner">
				<div class="wpb_wrapper">
					<div class="vc_btn3-container submitBtn btnWrapper btns btn2 vc_btn3-center">
						<a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-flat vc_btn3-block vc_btn3-icon-right vc_btn3-color-warning" href="<?=esc_url( get_permalink() )?>" title="">詳しく見る <i class="vc_btn3-icon fa fa-chevron-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div> -->
</div>
