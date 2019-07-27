<?php

$wall_dimen = $_POST['wall_dimen'] ?: '';
$wall_material = $_POST['wall_material'] ?: '';
$roof_dimen = $_POST['roof_dimen'] ?: '';
$roof_material = $_POST['roof_material'] ?: '';
$wall_flag = 0;
$roof_flag = 0;

$estiamtion_val = get_estimation_value( $wall_dimen, $wall_material, $roof_dimen, $roof_material);

?>


<!--estimation-->
<div id="wholeContents" class="wholeContents page-php" role="main">
	<div id="secondLayer" class="secondLayer">

		<div id="mainContents" class="mainContents">


			<div id="contentsWrapper" class="contentsWrapper">
				<div id="main" class="main-content">


					<!--content page-->
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-content">
							<div class="maxWidth">

								<div class="vc_row wpb_row vc_row-fluid A02-01">
								    <div class="wpb_column vc_column_container vc_col-sm-12">
								        <div class="vc_column-inner">
								            <div class="wpb_wrapper">
								                <div class="wpb_text_column wpb_content_element " >
								                    <div class="wpb_wrapper">
								                        <h4 class="style02 element price_title">参考価値</h4>
								                    </div>
								                </div>
								            </div>
								        </div>
								    </div>
								</div>

								<div class="price_cond price_container">

									<div class="clearfix"></div>
								</div>

								<div class="price_body price_container">
		
									<div class="price_total">
										<div class="total_val">
											<div class="totalInner">
												<span class="total_title">合計</span><span class="total_value">～<?php
												echo number_format($estiamtion_val['roof'] + $estiamtion_val['wall']);
											?></span><span class="total_currency">円</span>
											</div>
										</div>		
									</div>
									<div class="price_sub">
										<?php if ($wall_dimen && $wall_material) : 
											$wall_flag = 1;	?>
											<div class="sub_condi gaihekiryokin">		
												<p>外壁の大きき&nbsp;:&nbsp;~<?=get_rest_front_part($wall_dimen, '㎡') . '&#13217;'?>未満</p>			
												<p>塗料ランク&nbsp;:&nbsp;<?=get_estimation_materials($wall_material)['label']?></p>
											</div>
											<div class="sub_price gaihekiryokin">
												<span class="label">外壁料金 &nbsp;</span>
												<span>～<?=number_format($estiamtion_val['wall'])?><span class="yen">円</span></span>
											</div>
										<?php endif; ?>
										<?php if ($roof_dimen && $roof_material) : 
											$roof_flag = 1;	?>
											<div class="sub_condi yaneryokin">
												<p>屋根の大きさ&nbsp;:&nbsp;~<?=get_rest_front_part($roof_dimen, '㎡') . '&#13217;'?>未満</p>
												<p>塗料ランク&nbsp;:&nbsp;<?=get_estimation_materials($roof_material)['label']?></p>
											</div>
											<div class="sub_price yaneryokin">
												<span class="label">屋根料金&nbsp;</span>
												<span>～<?=number_format($estiamtion_val['roof'])?><span class="yen">円</span></span>
											</div>		
										<?php endif; ?>
									</div>
								</div>
												<!--button-->
												<div class="vc_row wpb_row vc_inner vc_row-fluid">
													<div class="co1 wpb_column vc_column_container vc_col-sm-3">
														<div class="vc_column-inner">
															<div class="wpb_wrapper"></div>
														</div>
													</div>
													<div class="co2 wpb_column vc_column_container vc_col-sm-6">
														<div class="vc_column-inner">
															<div class="wpb_wrapper">
																<div class="vc_btn3-container  submitBtn btns btn2 vc_btn3-center">
																	<button class="ga_simple-estimation_simple-estimation-result vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-flat vc_btn3-block vc_btn3-icon-right vc_btn3-color-sky" onclick="event.preventDefault(); document.getElementById('est_result_form').submit();">このプランで問い合わせ</button>
																</div>
															</div>
														</div>
													</div>
													<div class="co3 wpb_column vc_column_container vc_col-sm-3">
														<div class="vc_column-inner">
															<div class="wpb_wrapper"></div>
														</div>
													</div>
												</div>
												<div class="rem5" style="height:5rem;"></div>

				<?php echo do_shortcode('[ins_get_page slug="ryoukinmeyasusimulation-footer"]'); ?>
											
												<div class="rem5" style="height:5rem;"></div>

								<?php get_template_part( 'template-parts/page/price', 'letter' ); ?>


										


<!-- 								<div class="price_ask">
									<div class="total_ask">



										<button class="" onclick="event.preventDefault();
								             document.getElementById('est_result_form').submit();">
											<i class="fas fa-question-circle"></i>このプランで問い合わせ
										</button>
									</div>
								</div> -->



								<form id="est_result_form" method="post" style="display: none;"
									action="<?php echo esc_url( home_url( '/contact' ) ); ?>">

									<?php if ($wall_flag == 1) : ?>
									<input type="hidden" name="er_wall_flag" value="<?=$wall_flag?>">
									<input type="hidden" name="er_wall_dimen" 
										value="外壁の大きき : ~<?=get_rest_front_part($wall_dimen, '㎡') . '&#13217;'?>未満">
									<input type="hidden" name="er_wall_material" 
										value="塗料ランク : <?=get_estimation_materials($wall_material)['label']?>">
									<input type="hidden" name="er_wall_price" 
										value="外壁料金 : ～<?=number_format($estiamtion_val['wall'])?>円">
									<?php endif; ?>

									<?php if ($roof_flag == 1) : ?>
									<input type="hidden" name="er_roof_flag" value="<?=$roof_flag?>">
									<input type="hidden" name="er_roof_dimen" 
										value="屋根の大きさ : ~<?=get_rest_front_part($roof_dimen, '㎡') . '&#13217;'?>未満">
									<input type="hidden" name="er_roof_material" 
										value="塗料ランク : <?=get_estimation_materials($roof_material)['label']?>">
									<input type="hidden" name="er_roof_price" 
										value="屋根料金 : ～<?=number_format($estiamtion_val['roof'])?>円">
									<?php endif; ?>

									<input type="hidden" name="er_total_price" 
										value="合計 : ～<?=number_format($estiamtion_val['roof'] + $estiamtion_val['wall'])?>円">

								</form>


							</div><!-- .maxWidth -->
						</div><!-- .entry-content -->

					</article><!-- #post-## -->


				</div>
			</div><!--contentsWrapper-->


		</div><!--#mainContents-->
	</div><!-- #secondLayer -->
</div><!--#wholeContents-->

