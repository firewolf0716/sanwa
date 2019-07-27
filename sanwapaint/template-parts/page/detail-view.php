<?php
/**
 * Displays right part for search page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

$image_url = get_stylesheet_directory_uri() . '/assets/images/';
$host_name = get_post_meta( get_the_ID(), 'host_name', true) ?:'&nbsp;';
$catch = get_post_meta( get_the_ID(), 'catch', true) ?:'&nbsp;';

require_once locate_template('lib/get_cases_detail.php');

$w_detached = get_post_meta( get_the_ID(), 'detacheds', true) ?:'&nbsp;';
$w_housemakers = get_post_meta( get_the_ID(), 'housemakers', true) ?:'&nbsp;';
// var_dump($w_detached, '_____', $w_housemakers);


global $post;
$newclass="";
if( is_newest_post($post) ) {
    $newclass = "newon";
}
?>

<!--View Detailed Sanwa-->
<div id="detail_view" class="pageDetail">

	<div class="vc_row wpb_row vc_row-fluid A02-01">
			<div class="wpb_column vc_column_container vc_col-sm-12">
				<div class="vc_column-inner">
					<div class="wpb_wrapper">
						<div class="wpb_text_column wpb_content_element ">
							<div class="wpb_wrapper">
								<a class="listCasesTitle" rel="bookmark" href="https://sanwa.7-16.work/cases/i-m%e9%82%b8-2">
									<span class="new7day <?php echo $newclass; ?>">NEW</span>
									<h4 class="style02 element file-alt-e border-b1c6"><?=$catch?> [<?php echo get_the_title(  ); ?>]</h4>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	<section id="view_one_detail">

		<div class="vc_row wpb_row vc_row-fluid A04">
			<div class="wpb_column vc_column_container vc_col-sm-12">
				<div class="vc_column-inner">
					<div class="wpb_wrapper">

						<div class="vc_row wpb_row vc_inner vc_row-fluid A04Inner_row">

							<?php
							$before_photos = get_post_meta( get_the_ID(), 'before_photo', true);
							$before_comments = get_post_meta( get_the_ID(), 'before_comment', true);
							$after_photos = get_post_meta( get_the_ID(), 'after_photo', true);
							$after_comments = get_post_meta( get_the_ID(), 'after_comment', true);

							if ($before_photos[0]){
							  $before_photo = $before_photos[0];
							  $url_info = pathinfo($before_photo);//切り分ける
							  $before_photo = $url_info["dirname"];//拡張子なし
							  $before_photo = $before_photo."/".$url_info["filename"]."-480x360.".$url_info["extension"];
							  $before_photo_array = get_headers($before_photo);
							  if(!strpos($before_photo_array[0],'OK')){
                  $before_photo = $before_photos[0];
							  }
							}else{
							  // $before_photo = plugins_url() . '/js_composer/assets/vc/no_image.png';
							  $before_photo = "";
							}


							if ($after_photos[0]){
							  $after_photo = $after_photos[0];
							  $url_info = pathinfo($after_photo);//切り分ける
							  $after_photo = $url_info["dirname"];//拡張子なし
							  $after_photo = $after_photo."/".$url_info["filename"]."-480x360.".$url_info["extension"];
							  $after_photo_array = get_headers($after_photo);
							  if(!strpos($after_photo_array[0],'OK')){
							    $after_photo = $after_photos[0];
							  }
							}else{
							  // $after_photo = plugins_url() . '/js_composer/assets/vc/no_image.png';
							  $after_photo = "";
							}
							?>





							<div class="wpb_column vc_column_container vc_col-sm-6">

								<div class="vc_column-inner">
									<div class="wpb_wrapper">
										<div  class="wpb_single_image wpb_content_element vc_align_center">
											<figure class="wpb_wrapper vc_figure w100">
												<div class="vc_single_image-wrapper   vc_box_border_grey featured_box">
                          <?php if(!empty($after_photo)){ ?>
													<!-- Trigger the Modal -->
													<h4>施工後</h4>
													<div class="rem05" style="height:0.5rem"></div>
													<div class="imageBox">
													  <div class="image">
													  	<a href="<?php echo $after_photo; ?>" rel="lightbox[BeforeAfter-group]">
													      <img class="after1" src="<?php echo $after_photo; ?>" alt="">
													     </a>
													  </div><!--end image-->
													</div><!--end imageBox-->
                          <div class="vc_empty_space  rem05"   style="height: 0.5rem" >
    												<span class="vc_empty_space_inner"></span>
    											</div>

    											<div class="wpb_text_column wpb_content_element " >
    												<div class="wpb_wrapper text-center">
    													<p><?=$after_comments[0]?></p>
    												</div>
    											</div>
													<div class="rem1" style="height:1rem"></div>
                        <?php } ?>
                        <?php if(!empty($before_photo)){ ?>
													<h4>施工前</h4>
													<div class="rem05" style="height:0.5rem"></div>
													<div class="imageBox">
													  <div class="image">
													  	<a href="<?php echo $before_photo; ?>" rel="lightbox[BeforeAfter-group]">
													      <img class="before1" src="<?php echo $before_photo; ?>" alt="">
													      </a>
													  </div><!--end image-->
													</div><!--end imageBox-->
                          <div class="vc_empty_space  rem05"   style="height: 0.5rem" >
                            <span class="vc_empty_space_inner"></span>
                          </div>
                          <div class="wpb_text_column wpb_content_element " >
                            <div class="wpb_wrapper text-center">
                              <p><?=$before_comments[0]?></p>
                            </div>
                          </div>
                        <?php } ?>
												</div>
											</figure>
										</div>
									</div>
								</div>
							</div>
							<!-- vc_col-sm-4 -->
							<div class="wpb_column vc_column_container vc_col-sm-6">
								<div class="vc_column-inner">
									<div class="wpb_wrapper include-child">
										<div class="wpb_text_column wpb_content_element " >
											<div class="catch">
												<p>

												</p>

											</div>

											<div class="wpb_wrapper detail_info">
												<p>
													使用塗料： <?=$case_type_text_link?><?php if(!empty($case_type_text_link))echo "&nbsp"; ?><?=$case_type_roof_link?>
												</p>
                        <p>
                          戸建の様式：<a rel="bookmark" href="/?post_type=cases&s_detacheds[]=<?=$detacheds?>"><?=$detacheds?></a>
                        </p>
                        <p>
                          ハウスメーカー：<a rel="bookmark" href="/?post_type=cases&s_housemakers[]=<?=$housemakers?>"><?=$housemakers?></a>
                        </p>
                        <p>
                          支店名：<a rel="bookmark" href="/?post_type=cases&s_branch=<?=$branch?>"><?=$branch?></a>
                        </p>
												<p>
													お悩みの要素：<?=$worry_elements_link?>
												</p>
												  <?php //$other_works_textその他の工事： ?>
													<?php //$outwall_types_text//外壁種類： ?>

												<div class="list_color">
													<div class="pull-left text-left margin-r5">色</div>
													<div class="pull-left padding-t2">
													<?php
                          if ($detail_imgs_full) {
                                        foreach ($detail_imgs_full as $dimg) {
                                            if (get_the_post_thumbnail_url($dimg[0],'full'))
                                                $d_img_url = get_the_post_thumbnail_url($dimg[0],'full');
                                            else
                                                $d_img_url = plugins_url() . '/js_composer/assets/vc/no_image.png';

                                      ?><a rel="bookmark" href="/?post_type=cases&<?=$dimg[1]?>=<?=$dimg[2]?>">
                                          <label class="color_block pull-left" style="background-image: url(<?=$d_img_url?>);"></label>
                                        </a>
                                      <?php
                                        }
                                      }
							                        ?>

													</div>
													<div class="clearfix"></div>
												</div>
										    <div class="customer_voice">
                          <span>お客様の声</span>
                          <p><?php echo get_post_meta( get_the_ID(), 'customer_voice', true); ?></p>
                        </div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- vc_col-sm-8-->

						</div>
						<!-- A04Inner_row -->
					</div>
					<!-- wpb_wrapper -->
				</div>
				<!-- vc_column-inner -->
			</div>
			<!-- vc_column_container -->
		</div>
		<!-- A04 -->

		<div class="rem3" style="height:3rem"></div>

		<?php
		/*ビフォーアフター*/
		$before_photos = get_post_meta( get_the_ID(), 'before_photo', true);
		$before_comments = get_post_meta( get_the_ID(), 'before_comment', true);
		$after_photos = get_post_meta( get_the_ID(), 'after_photo', true);
		$after_comments = get_post_meta( get_the_ID(), 'after_comment', true);

		for ($i=1; $i < 6; $i++) {


		  if ($before_photos[$i]){
		    $before_photo = $before_photos[$i];
		    $url_info = pathinfo($before_photo);//切り分ける
		    $before_photo = $url_info["dirname"];//拡張子なし
		    $before_photo = $before_photo."/".$url_info["filename"]."-480x360.".$url_info["extension"];
		    $before_photo_array = get_headers($before_photo);
		    if(!strpos($before_photo_array[0],'OK')){
		      $before_photo = $before_photos[$i];
		    }
		  }else{
		    // $before_photo = noimage_ret("thumb480360");
		    $before_photo = "";
		  }


		  if ($after_photos[$i]){
		    $after_photo = $after_photos[$i];
		    $url_info = pathinfo($after_photo);//切り分ける
		    $after_photo = $url_info["dirname"];//拡張子なし
		    $after_photo = $after_photo."/".$url_info["filename"]."-480x360.".$url_info["extension"];
		    $after_photo_array = get_headers($after_photo);
		    if(!strpos($after_photo_array[0],'OK')){
		      $after_photo = $after_photos[$i];
		    }
		  }else{
		    // $after_photo = noimage_ret("thumb480360");
		    $after_photo = "";
		  }
		/*ビフォーアフター*/
		?>

<?php if(!empty($before_photo) || !empty($after_photo)): /*ビフォーアフター画像あるかチェック*/ ?>
		<div class="vc_row wpb_row vc_row-fluid A14 beforeAfter">
			<div class="wpb_column vc_column_container vc_col-sm-12">
				<div class="vc_column-inner">
					<div class="wpb_wrapper">
						<div class="vc_row wpb_row vc_inner vc_row-fluid A14Inner_row">
								<div class="co1 wpb_column vc_column_container vc_col-sm-6">
									<div class="vc_column-inner">
										<div class="wpb_text_column wpb_content_element BeforeAfterTitle" >
											<div class="wpb_wrapper text-center">
												<h4>施工前</h4>
											</div>
										</div>
										<div class="rem05" style="height:0.5rem"></div>
										<div class="wpb_wrapper">
											<div  class="wpb_single_image wpb_content_element vc_align_center">
												<figure class="wpb_wrapper vc_figure w100">
													<div class="vc_single_image-wrapper vc_box_border_grey photo_box w100">
                            <?php if(!empty($before_photo)): ?>
														<a href="<?php echo $before_photo; ?>" rel="lightbox[BeforeAfter-group<? echo $i; ?>]">
															<img class="vc_img-placeholder vc_single_image-img h100" src="<?=$before_photo?>" />
														</a>
                          <?php endif; ?>
													</div>
												</figure>
											</div>
											<div class="vc_empty_space  rem05"   style="height: 0.5rem" >
												<span class="vc_empty_space_inner"></span>
											</div>

											<div class="wpb_text_column wpb_content_element " >
												<div class="wpb_wrapper text-center">
													<p><?=$before_comments[$i]?></p>
												</div>
											</div>
											<div class="vc_empty_space  rem1"   style="height: 1rem" >
												<span class="vc_empty_space_inner"></span>
											</div>
										</div>
									</div>
								</div>

								<div class="co2 wpb_column vc_column_container vc_col-sm-6">
									<div class="vc_column-inner">
										<div class="wpb_text_column wpb_content_element BeforeAfterTitle" >
											<div class="wpb_wrapper text-center">
												<h4>施工後</h4>
											</div>
										</div>
										<div class="rem05" style="height:0.5rem"></div>
										<div class="wpb_wrapper">
											<div  class="wpb_single_image wpb_content_element vc_align_center">
												<figure class="wpb_wrapper vc_figure w100">
													<div class="vc_single_image-wrapper vc_box_border_grey photo_box w100">
                            <?php if(!empty($after_photo)): ?>
														<a href="<?php echo $after_photo; ?>" rel="lightbox[BeforeAfter-group<? echo $i; ?>]">
															<img class="vc_img-placeholder vc_single_image-img h100" src="<?=$after_photo?>" />
														</a>
                          <?php endif; ?>
													</div>
												</figure>
											</div>
											<div class="vc_empty_space  rem05"   style="height: 0.5rem" >
												<span class="vc_empty_space_inner"></span>
											</div>
											<div class="wpb_text_column wpb_content_element " >
												<div class="wpb_wrapper text-center">
													<p><?=$after_comments[$i]?></p>
												</div>
											</div>
											<div class="vc_empty_space  rem1"   style="height: 1rem" >
												<span class="vc_empty_space_inner"></span>
											</div>
										</div>
									</div>
								</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif;/*ビフォーアフター画像あるかチェック*/ ?>
		<?php
			}
		?>

		<?php

		$next_post = get_next_post();
		$prev_post = get_previous_post();

		?>

		<div class="vc_row wpb_row vc_row-fluid A14">
			<div class="wpb_column vc_column_container vc_col-sm-12">
				<div class="vc_column-inner">
					<div class="wpb_wrapper">
						<div class="vc_row wpb_row vc_inner vc_row-fluid A14Inner_row">
							<div class="prev-btn-box">

								<?php if (!empty( $prev_post )): ?>

								<?php if (has_post_thumbnail( $prev_post->ID ) )
											$prev_image = wp_get_attachment_image_src( get_post_thumbnail_id( $prev_post->ID ), 'single-post-thumbnail' )[0];
									  else
									  		$prev_image = noimage_ret("thumb180120");
								?>

								<div class="">
									<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
										<　前の事例
									</a>

								</div>

								<?php endif; ?>

							</div>

							<div class="next-btn-box">

								<?php if (!empty( $next_post )): ?>

								<?php if (has_post_thumbnail( $next_post->ID ) )
											$next_image = wp_get_attachment_image_src( get_post_thumbnail_id( $next_post->ID ), 'single-post-thumbnail' )[0];
									  else
									  		$next_image = noimage_ret("thumb180120");
								?>

								<div class="">
									<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
										次の事例　>
									</a>
								</div>

								<?php endif; ?>

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

	</section>



	</div>


<script type="text/javascript">
	/*BEGIN Modal*/
	// // Get the modal
	// var modal = document.getElementById("myModal");

	// // Get the image and insert it inside the modal - use its "alt" text as a caption
	// var img = document.getElementById("featured_modal_image");
	// var modalImg = document.getElementById("img01");
	// var captionText = document.getElementById("caption");
	// img.onclick = function(){
	//   modal.style.display = "block";
	//   modalImg.src = this.src;
	//   captionText.innerHTML = this.alt;
	// }

	// // Get the <span> element that closes the modal
	// var span = document.getElementsByClassName("close")[0];

	// // When the user clicks on <span> (x), close the modal
	// span.onclick = function() {
	//   modal.style.display = "none";
	// }
	/*END Modal*/
</script>
