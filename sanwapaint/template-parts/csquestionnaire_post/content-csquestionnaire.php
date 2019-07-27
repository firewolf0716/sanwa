<?php
/**
 * Template part for displaying posts with excerpts
 *
 */
$t_title = wp_trim_words(get_the_title(), 9, "  ...");
$e_title = wp_trim_words(get_the_title(), 30, "  ...");
$t_content = get_the_content();
$t_url = esc_url( get_permalink() );

$t_evalution = wp_get_post_terms(get_the_ID(), 'csquestionnaire_evaluation')[0];

$catchtext = get_post_meta( get_the_ID(), 'catchtext', true);
$t_catchtext = wp_trim_words( $catchtext, 30, "  ...");
$e_catchtext = wp_trim_words( $catchtext, 30, "  ...");

$t_scanimage = get_field('scanimage');

if ( $t_scanimage )
	$main_image = $t_scanimage['url'];
else
	$main_image = noimage_ret("thumb480360");

$ytb_url = get_stylesheet_directory_uri().'/assets/images/youtube.png';

?>

<div class="cs_item item<?=$ank ?>">
	<a data-largesrc="<?=$main_image?>"
		data-title="<?=$e_title?>"
		data-description="<?=$t_content?>"
		data-evol_class="<?='hk_'.$t_evalution->slug?>"
		data-evol_name="<?=$t_evalution->name?>"
		data-evol_title="<?=$e_title?>"
		data-evol_catch="<?=$e_catchtext?>"
		data-ytb_url="<?=$ytb_url?>"
	>


	<!--<?='hk_'.$t_evalution->slug?>-->
		<div class="cs_content <?='hk_'.$t_evalution->slug?>">
			<div class="top">
				<div class="evol">
					<img src="/wp-content/uploads/2019/07/<?='hk_'.$t_evalution->slug?>.png" alt="評価" class="">
					<!-- <p><?=$t_evalution->name?></p> -->
				</div>
				<div class="title">
					<p class="line">
						<?=$t_title?>
					</p>
					<p>
						<?=$t_catchtext?>
					</p>
				</div>
			</div>

			<div class="figure">
				<img src="<?=$main_image?>" alt="<?=the_title()?>">
			</div>
			<div class="csBtn vc_btn3-container otherBtn4 btns btn8 btnWrapper vc_btn3-center">
		      <button class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-flat vc_btn3-block vc_btn3-color-grey">詳細を見る</button>
		  </div>

			<div class="clearfix"></div>

		</div>
	</a>
</div>
