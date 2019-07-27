<div class="vc_row wpb_row vc_row-fluid A02" style="display:none;">
            <div class="wpb_column vc_column_container vc_col-sm-12">
                <div class="vc_column-inner">
                    <div class="wpb_wrapper">
                        <div class="wpb_text_column wpb_content_element ">
                            <div class="wpb_wrapper">
                                <h3 class="style02">一緒に見られる事例</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<div class="rankingBox flex" style="display:none;">
<?php if (have_posts()):?>
	<?php while (have_posts()) : the_post(); ?>
		<a href="<?php the_permalink() ?>">
		    <div class="rankBox">
		        <div class="imageBox caseImage">
		          <div class="image">
		          	<?php
                ////////////////////////////////////////////////
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
                ////////////////////////////////////////////////
                if (!empty($after_photo)) {
                  $image_url = $after_photo;
                }elseif(!empty($before_photo)){
                  $image_url = $before_photo;
                }else {
                  $image_url = noimage_ret("thumb480360");
                }
                 ?>
                 <img src="<?php echo $image_url; ?>" alt="施工事例アイキャッチ">
		          </div>
		          <div class="caseInfo flex">
		            <p class="caseInfoText"><?php echo get_the_title(); ?></p>
		          </div>
		        </div><!--end imageBox-->
		        <?php $vr_catch = get_post_meta( get_the_ID(), 'catch', true) ?:'&nbsp;'; ?>
		        <p class="catchText"><?=$vr_catch?></p>
		    </div>
		</a>
	<?php endwhile; ?>
<?php else: ?>
  関連する事例がございません。
<?php endif; ?>
</div>
