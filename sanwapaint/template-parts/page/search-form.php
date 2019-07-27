<?php
/**
 * Displays right part for search page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<script type="text/javascript">

</script>

<form id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">

	<input type="hidden" name="post_type" value="cases" />

		<div class="searchWrapper">
			<div class="brushWrapper left">

				<div class="vc_row wpb_row vc_row-fluid A02-01 maxWidth">
					<div class="wpb_column vc_column_container vc_col-sm-12">
						<div class="vc_column-inner">
							<div class="wpb_wrapper">
								<div class="wpb_text_column wpb_content_element ">
									<div class="wpb_wrapper">
										<h4 class="style02">Step1.色をお選びください（複数選択可）</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="brush">
				  <div class="searchColor flex fWrap_wrap">
						<?php
						$colorarray = array(
							"サンタンオレンジ","アンティークブラウン","SP-376","アンバーブラウン","セピアブラウン","SP-385"
							,"新ブラウン","ベージュ","SP-356","SP-357","AZE-310","AZE-325","SP-176","AZE-326","AZE-312","SP-350","AZE-315"
							,"AZE-317","AZE-316","AZE-318","SP-367","SP-127","SP-337","AZE-314","SP-336","AZE-319","AZE-311","AZE-324","SP-120"
							,"AZE-322","AZE-303","SP-141","SP-147","SP-150","AZE-327","SP-112","SP-121","SP-111","SP-310","新クリーム","SP-330"
							,"SP-347","SP-110","SP-221","SP-131","SP-247","AZE-328","AZE-301","AZE-302","SP-80","SP-75","SP-70","シルバーホワイト","グレー","AZE-306","カーボングレー"
							,"SP-352","AZE-320","AZE-321","AZE-323","AZE-329","SP-170","SP-50","SP-185","セピア","ビスタブラウン","AZE-330","ネオブラック","ナスコン","ブルー"
							,"リリーホワイト","SP-223","SP-133","ミストグリーン","フォレストグリーン","アイビーグリーン","ネオモスグリーン","イエローオーカー","ガーネットオレンジ"
							,"チョコレート","ブラウン","コーヒーブラウン"
						);
						foreach ($colorarray as $colorarrayvalue) {
							$outwall_stand_colors = get_colors_titles('',$colorarrayvalue);
						    foreach ($outwall_stand_colors as $oscolor) {
						      if (get_the_post_thumbnail_url($oscolor['ID'],'full'))
						        $featured_img_url = get_the_post_thumbnail_url($oscolor['ID'],'thumb180120');
						      else
						        $featured_img_url = noimage_ret("thumb180120"); ?>

						      <label class="container search-pick" data-colorname="<?=$oscolor['value']?>">
						       <input type="checkbox" name="<?=$oscolor['terms'].$oscolor['key']?>" value="<?=$oscolor['value']?>">
						       <span class="checkmark bs-w100-h100 br-no" style="background-image: url(<?=$featured_img_url?>);"></span>
						      </label>
						    <?php }
						}
						 ?>
						 <!-- 特注色 外壁標準色 -->
				     <label class="container wdg-color-pick specialcolor">
				       <input type="checkbox" name="outwall-stand-color_0" value="other" <?php
				         if (is_singular('cases') && get_post_meta( get_the_ID(), 'outwall-stand-color_0', true))
				             echo 'checked';
				         if (is_archive() && array_key_exists('outwall-stand-color_0', $_GET))
				             echo 'checked';
				       ?>>

				     <!-- 特注色 外壁標準色 -->
				     <!-- 特注色 外壁水性ゾラコート -->
				       <input type="checkbox" name="outwall-zola-coat-color_0" value="other" <?php
				         if (is_singular('cases') && get_post_meta( get_the_ID(), 'outwall-zola-coat-color_0', true))
				             echo 'checked';
				         if (is_archive() && array_key_exists('outwall-zola-coat-color_0', $_GET))
				             echo 'checked';
				      ?>>
				     <!-- 特注色 外壁水性ゾラコート -->
				     <!-- 特注色 外壁コーティング -->
				       <input type="checkbox" name="outwall-coat-color_0" value="other" <?php
				         if (is_singular('cases') && get_post_meta( get_the_ID(), 'outwall-coat-color_0', true))
				             echo 'checked';
				         if (is_archive() && array_key_exists('outwall-coat-color_0', $_GET))
				             echo 'checked';
				      ?>>
				     <!-- 特注色 外壁コーティング -->
				     <!-- 特注色 屋根遮熱標準色 -->
				       <input type="checkbox" name="roof-heat-color_0" value="other" <?php
				         if (is_singular('cases') && get_post_meta( get_the_ID(), 'roof-heat-color_0', true))
				             echo 'checked';
				         if (is_archive() && array_key_exists('roof-heat-color_0', $_GET))
				             echo 'checked';
				      ?>>
				      <span class="checkmark" style="background-image:url(<?php echo content_url();?>/uploads/2019/07/_-_-_colorTest.png)"></span>
				     </label>
				     <!-- 特注色 屋根遮熱標準色 -->
				  </div>
				  <div class="handle">
				      <div class="imageBox">
				        <div class="image">
				            <img src="<?php echo content_url();?>/uploads/haek_768.png" alt="">
				        </div><!--end image-->
				      </div><!--end imageBox-->
				  </div>
				</div><!--brush-->

			</div>
			<div class="detailselectionWrapper right">
				<div class="vc_row wpb_row vc_row-fluid A02-01 maxWidth">
					<div class="wpb_column vc_column_container vc_col-sm-12">
						<div class="vc_column-inner">
							<div class="wpb_wrapper">
								<div class="wpb_text_column wpb_content_element ">
									<div class="wpb_wrapper">
										<h4 class="style02">Step2.戸建の様式をお選びください（複数選択可）</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="search-item-panelWrapper search-check-panelWrapper">
					<div class="search-item-panel search-check-panel">
						<?php
							global $detacheds;
							foreach ($detacheds as $d => $detached) {
						?>
						<div class="wrapper s-check s4-check">
					    	<input id="detached-<?=$d?>"  type="checkbox" name="s_detacheds[]" value="<?=$detached?>">
							<label for="detached-<?=$d?>"><?=$detached?></label>
						</div>
						<?php
							}
						?>
						<div class="wrapper s-check s4-check">
					    	<input id="detached-o"  type="checkbox" name="s_detacheds[]" value="その他">
							<label for="detached-o">その他</label>
						</div>
					</div>
				</div>
				<div class="vc_row wpb_row vc_row-fluid A02-01 maxWidth">
					<div class="wpb_column vc_column_container vc_col-sm-12">
						<div class="vc_column-inner">
							<div class="wpb_wrapper">
								<div class="wpb_text_column wpb_content_element ">
									<div class="wpb_wrapper">
										<h4 class="style02">Step3.ハウスメーカーをお選びください（複数選択可）</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="search-item-panelWrapper search-check-panelWrapper">
					<div class="search-item-panel search-check-panel">
						<?php
							global $housemakers;
							foreach ($housemakers as $hmkey => $housemaker) {
						?>
						<div class="wrapper s-check s3-check">
					    	<input id="housemaker-<?=$hmkey?>" name="s_housemakers[]" type="checkbox" value="<?=$housemaker?>">
							<label for="housemaker-<?=$hmkey?>"><?=$housemaker?></label>
						</div>
						<?php
							}
						?>
						<div class="wrapper s-check s3-check">
					    	<input id="housemaker-o" name="s_housemakers[]" type="checkbox" value="その他">
							<label for="housemaker-o">その他</label>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>

				<div class="vc_row wpb_row vc_row-fluid A02-01 maxWidth">
					<div class="wpb_column vc_column_container vc_col-sm-12">
						<div class="vc_column-inner">
							<div class="wpb_wrapper">
								<div class="wpb_text_column wpb_content_element ">
									<div class="wpb_wrapper">
										<h4 class="style02">Step4.悩みの要素</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="search-item-panelWrapper search-check-panelWrapper">
					<div class="search-item-panel search-check-panel">
						<?php
							global $worry_elements;
							foreach ($worry_elements as $we_key => $worry_element) {
						?>
						<div class="wrapper s-check s3-check">
					    	<input id="worry_element-<?=$we_key?>" name="<?=$worry_element['key']?>" type="checkbox" value="<?=$worry_element['value']?>">
							<label for="worry_element-<?=$we_key?>"><?=$worry_element['value']?></label>
						</div>
						<?php
							}
						?>
						<div class="wrapper s-check s3-check">
					    	<input id="worry_element-o" name="worry_elements_0" type="checkbox" value="other">
							<label for="worry_element-o">その他</label>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>

				<div class="vc_row wpb_row vc_row-fluid A02-01 maxWidth">
					<div class="wpb_column vc_column_container vc_col-sm-12">
						<div class="vc_column-inner">
							<div class="wpb_wrapper">
								<div class="wpb_text_column wpb_content_element ">
									<div class="wpb_wrapper">
										<h4 class="style02">Step5.その他の工事（複数選択可）</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="search-item-panelWrapper search-check-panelWrapper">

					<div class="search-item-panel search-check-panel">
						<?php
							global $other_works;
							foreach ($other_works as $other_work_key => $other_work) {
						?>
						<div class="wrapper s-check s3-check">
					    	<input id="other_work-<?=$other_work_key?>" name="<?=$other_work['key']?>" type="checkbox" value="<?=$other_work['value']?>">
							<label for="other_work-<?=$other_work_key?>"><?=$other_work['value']?></label>
						</div>
						<?php
							}
						?>
						<div class="wrapper s-check s3-check">
					    	<input id="other_work-o" name="other_works_0" type="checkbox" value="other">
							<label for="other_work-o">その他</label>
						</div>
					</div>
				</div>

				<div class="vc_row wpb_row vc_row-fluid A02-01 maxWidth">
					<div class="wpb_column vc_column_container vc_col-sm-12">
						<div class="vc_column-inner">
							<div class="wpb_wrapper">
								<div class="wpb_text_column wpb_content_element ">
									<div class="wpb_wrapper">
										<h4 class="style02">Step6.支店名（地域）</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="search-item-panelWrapper search-check-panelWrapper">

				  <div class="search-item-panel search-check-panel search-check-White">
				    <select id="branch" name="s_branch" class="">
				      <option value="" >全て選択</option>
				      <?php
				      $branchs = get_branchs_titles();
							$m_branch = $_GET['s_branch'];
				      foreach ($branchs as $branch) {
				        if ( !empty($m_branch) && $branch == $m_branch) {
				      ?>
				      <option value="<?=$branch?>" selected ><?=$branch?></option>
				      <?php
				        }else{
				      ?>
				      <option value="<?=$branch?>" ><?=$branch?></option>
				      <?php
				        }
				      }
				      ?>
				    </select>
				  </div>

				</div>
				

			</div>


		</div>

		<div class="search-item-panelWrapper search-check-panelWrapper">
		  	<div class="vc_btn3-container otherBtn4 btns btn8 btnWrapper vc_btn3-center">
		    	<button type="submit" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-flat vc_btn3-block vc_btn3-color-grey">検索</button>
			</div>
		</div>
<!-- 	<div class="but_area">
		<button class="wdg-search-btn" type="submit">
            <i class="fas fa-search color-white"></i>検索
        </button>
	</div> -->


	</form>
