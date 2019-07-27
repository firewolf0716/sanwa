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


<form id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">

	<input type="hidden" name="post_type" value="cases" />

	<div class="vc_row wpb_row vc_row-fluid A02-01 search-check-title">
		<div class="wpb_column vc_column_container vc_col-sm-12">
			<div class="vc_column-inner">
				<div class="wpb_wrapper">
					<div class="wpb_text_column wpb_content_element " >
						<div class="wpb_wrapper">
							<h4 class="style02 border-none black-block-e">色</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="search-item-panel search-color-panel font-moto line-20-80">
		<div class="border-bottom">
			<div class="pull-left w20 padding-tb16-l6">
				<p class="color-title">外壁標準色</p>
			</div>
			<div class="pull-left w80 padding-tb16-l13">
			<?php $outwall_stand_colors = get_colors_titles('outwall-stand-color');
            foreach ($outwall_stand_colors as $oscolor) {
                if (get_the_post_thumbnail_url($oscolor['ID'],'full'))
                    $featured_img_url = get_the_post_thumbnail_url($oscolor['ID'],'thumb480360');
                else
                    $featured_img_url = noimage_ret("thumb480360"); ?>

                <label class="container search-pick">
                    <input type="checkbox" name="<?=$oscolor['key']?>" value="<?=$oscolor['value']?>">
                    <span class="checkmark" style="background-image: url(<?=$featured_img_url?>); background-size: 20px 20px;"></span>
                </label>

            <?php } ?>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="border-bottom">
			<div class="pull-left w20 padding-tb16-l6">
				<p class="color-title">外壁水性</p>
				<p class="color-title">ゾラコート</p>
			</div>
			<div class="pull-left w80 padding-tb16-l13">
			<?php

            $outwall_zola_coat_colors = get_cases_colors('outwall-zola-coat-color');

            foreach ($outwall_zola_coat_colors as $ozccolor) {
                if (get_the_post_thumbnail_url($ozccolor->ID,'full')) {
                    $featured_img_url = get_the_post_thumbnail_url($ozccolor->ID,'thumb480360');
                }else{
                    $featured_img_url = noimage_ret("thumb480360");
                }
            ?>

                <label class="container search-pick">
                    <input type="checkbox"  value="<?=$ozccolor->post_title?>">
                    <span class="checkmark" style="background-image: url(<?=$featured_img_url?>); background-size: 20px 20px;"></span>
                </label>

            <?php
            }
            ?>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="border-bottom">
			<div class="pull-left w20 padding-tb16-l6">
				<p class="color-title">外壁</p>
				<p class="color-title">コーティング</p>
			</div>
			<div class="pull-left w80 padding-tb16-l13">
			<?php

            $outwall_coat_colors = get_cases_colors('outwall-coat-color');

            foreach ($outwall_coat_colors as $occolor) {
                if (get_the_post_thumbnail_url($occolor->ID,'full')) {
                    $featured_img_url = get_the_post_thumbnail_url($occolor->ID,'thumb480360');
                }else{
                    $featured_img_url = noimage_ret("thumb480360");
                }
            ?>

                <label class="container search-pick">
                    <input type="checkbox"  value="<?=$occolor->post_title?>">
                    <span class="checkmark" style="background-image: url(<?=$featured_img_url?>); background-size: 20px 20px;"></span>
                </label>

            <?php
            }
            ?>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="">
			<div class="pull-left w20 padding-tb16-l6">
				<p class="color-title">屋根遮熱</p>
				<p class="color-title">標準色</p>
			</div>
			<div class="pull-left w80 padding-tb16-l13">
			<?php

            $roof_heat_colors = get_cases_colors('roof-heat-color');

            foreach ($roof_heat_colors as $rhcolor) {
                if (get_the_post_thumbnail_url($rhcolor->ID,'full')) {
                    $featured_img_url = get_the_post_thumbnail_url($rhcolor->ID,'thumb480360');
                }else{
                    $featured_img_url = noimage_ret("thumb480360");
                }
            ?>

                <label class="container search-pick">
                    <input type="checkbox"  value="<?=$rhcolor->post_title?>">
                    <span class="checkmark" style="background-image: url(<?=$featured_img_url?>); background-size: 20px 20px;"></span>
                </label>

            <?php
            }
            ?>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="vc_row wpb_row vc_row-fluid A02-01 search-check-title">
		<div class="wpb_column vc_column_container vc_col-sm-12">
			<div class="vc_column-inner">
				<div class="wpb_wrapper">
					<div class="wpb_text_column wpb_content_element " >
						<div class="wpb_wrapper">
							<h4 class="style02 border-none black-block-e">支店名（地域）</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="search-item-panel search-check-panel">
		<select id="branch" name="s_branch" class="w50">
			<option value=""  ></option>
			<?php
			$branchs = get_branchs_titles();
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
		<div class="clearfix"></div>
	</div>

	<div class="vc_row wpb_row vc_row-fluid A02-01 search-check-title">
		<div class="wpb_column vc_column_container vc_col-sm-12">
			<div class="vc_column-inner">
				<div class="wpb_wrapper">
					<div class="wpb_text_column wpb_content_element " >
						<div class="wpb_wrapper">
							<h4 class="style02 border-none black-block-e">戸建の様式</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="search-item-panel search-check-panel">
		<?php
			global $detacheds;
			foreach ($detacheds as $d => $detached) {
		?>
		<div class="wrapper s-check s4-check">
	    	<input id="detached-<?=$d?>"  type="radio" name="s_detacheds" value="<?=$detached?>">
			<label for="detached-<?=$d?>"><?=$detached?></label>
		</div>
		<?php
			}
		?>
		<div class="wrapper s-check s4-check">
	    	<input id="detached-o"  type="radio" name="s_detacheds" value="other">
			<label for="detached-o">その他</label>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="vc_row wpb_row vc_row-fluid A02-01 search-check-title">
		<div class="wpb_column vc_column_container vc_col-sm-12">
			<div class="vc_column-inner">
				<div class="wpb_wrapper">
					<div class="wpb_text_column wpb_content_element " >
						<div class="wpb_wrapper">
							<h4 class="style02 border-none black-block-e">ハウスメーカー</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="search-item-panel search-check-panel">
		<?php
			global $housemakers;
			foreach ($housemakers as $hmkey => $housemaker) {
		?>
		<div class="wrapper s-check s3-check">
	    	<input id="housemaker-<?=$hmkey?>" name="s_housemakers" type="radio" value="<?=$housemaker?>">
			<label for="housemaker-<?=$hmkey?>"><?=$housemaker?></label>
		</div>
		<?php
			}
		?>
		<div class="wrapper s-check s3-check">
	    	<input id="housemaker-o" name="s_housemakers" type="radio" value="other">
			<label for="housemaker-o">その他</label>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="vc_row wpb_row vc_row-fluid A02-01 search-check-title">
		<div class="wpb_column vc_column_container vc_col-sm-12">
			<div class="vc_column-inner">
				<div class="wpb_wrapper">
					<div class="wpb_text_column wpb_content_element " >
						<div class="wpb_wrapper">
							<h4 class="style02 border-none black-block-e">悩みの要素</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

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
	    	<input id="worry_element-0" name="worry_elements_0" type="checkbox" value="other">
			<label for="worry_element-0">その他</label>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="vc_row wpb_row vc_row-fluid A02-01 search-check-title">
		<div class="wpb_column vc_column_container vc_col-sm-12">
			<div class="vc_column-inner">
				<div class="wpb_wrapper">
					<div class="wpb_text_column wpb_content_element " >
						<div class="wpb_wrapper">
							<h4 class="style02 border-none black-block-e">その他の工事</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

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
	    	<input id="other_work-0" name="other_works_0" type="checkbox" value="other">
			<label for="other_work-0">その他</label>
		</div>
		<div class="clearfix"></div>
	</div>


	<div class="but_area">
		<button class="wdg-search-btn" type="submit">
            <i class="fas fa-search color-white"></i>検索
        </button>
	</div>
</form>
