<?php
/**
 * Template Name: Sanwa Questionnaire Filter Page
 */

get_header(); ?>
<div class="main_panel maxWidth">

	<div class="main_panel_border">

		<div class="main_content_pane font-moto color-motoya">


		<div class="vc_row wpb_row vc_row-fluid A01 maxWidth">
			<div class="wpb_column vc_column_container vc_col-sm-12">
				<div class="vc_column-inner">
					<div class="wpb_wrapper">
						<div class="wpb_text_column wpb_content_element ">
							<div class="wpb_wrapper">
								<h2 class="style02">お客様評価アンケート</h2>
								<h3 class="style02" style="text-align: center;">全て公開! 感動·満足·お叱りすべて見せます</h3>
							</div>
						</div>
						<div class="vc_empty_space  rem1" style="height: 1rem"><span class="vc_empty_space_inner"></span></div>
					</div>
				</div>
			</div>
		</div>


<?php

$hide_empty = array( 'hide_empty' => false );
$shop_args = array( 'hide_empty' => false ,'exclude' => 158);
$shops = get_terms('csquestionnaire_shop', $shop_args);
$evaluations = get_terms('csquestionnaire_evaluation', $hide_empty);

$post_type = array('csquestionnaire', 'webcsquestionnaire') ;

$paged = 1;
if (!empty($_GET['page_num'])) {
	$paged = $_GET['page_num'];
}

$show_args = [
    'paged'          => $paged,
    'post_type' => $post_type,
    'post_status' => 'publish',
    'tax_query' => [
        'relation' => 'AND',
    ]
];

$f_shop = $_GET['s_shop'] ?: '';
if ( $f_shop && $f_shop != 'all') {
    $show_args['tax_query'][] = [
        'taxonomy' => 'csquestionnaire_shop',
		'field' => 'slug',
		'terms' => $f_shop
    ];
}

$shop_args = $show_args;

$total_args = $shop_args;
$total_args['posts_per_page'] = -1;
$total_query = new WP_Query( $total_args );
$total = count($total_query->posts);

foreach ($evaluations as $evaluation) {

	$tmp_evaluation_arg = [
        'taxonomy' => 'csquestionnaire_evaluation',
		'field' => 'slug',
		'terms' => $evaluation->slug
    ];
    $tmp_percent_arg = $shop_args;
    $tmp_percent_arg['posts_per_page'] = -1;
    $tmp_percent_arg['tax_query'][] = $tmp_evaluation_arg;
    $tmp_percent_query = new WP_Query( $tmp_percent_arg );
    $tmp_percent_count = count($tmp_percent_query->posts);

    if ( $tmp_percent_count != 0) {
    	$tmp_percent = ( $tmp_percent_count / $total ) * 100;
    }else{
    	$tmp_percent = 0;
    }
    $evaluation->percent = $tmp_percent;
}

$f_evaluation = $_GET['s_evaluation'] ?: '';
if ( $f_evaluation && $f_evaluation != 'all' ) {
    $show_args['tax_query'][] = [
        'taxonomy' => 'csquestionnaire_evaluation',
		'field' => 'slug',
		'terms' => $f_evaluation
    ];
}
$show_args['posts_per_page'] = 10;
$search_query = new WP_Query( $show_args );

?>

<!-- <div class="form_title">
	<p class="small">三和ペイントではお客様から寄せられた評価アンケートを良いに評価も、お叱りのご評価も公開しております。</p>
</div> -->
		<div class="action_box">
			<div class="chartWrap">
				<div class="chart_box">
					<div class="chart_boxInner">
						<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js" charset="utf-8"></script>
						<canvas id="myChart" width="200" height="200"></canvas>
						<script>
							  <?php
							  	$total = 0;
							  	$labels = "";
								  foreach ($evaluations as $i => $evaluation) {
								  	$labels .= "'".$evaluation->name."',";
								  	$percentData .= "'".number_format( $evaluation->percent, 2)."',";
								  	// $percentData .= "['".$evaluation->name."',".number_format( $evaluation->percent, 2)."],";
								  	$total = $total + number_format( $evaluation->percent, 2);
								  }
								  $percentData = substr($percentData, 0, -1);
								  $labels = substr($labels, 0, -1);
							  ?>
							    //["total",<?php echo $total; ?>],
							    // <?php echo $percentData; ?>


							var ctx = document.getElementById("myChart").getContext('2d');
							var myChart = new Chart(ctx, {
							    type: 'doughnut',
							    data: {
							        labels: [<?php echo $labels; ?>],
							        datasets: [{
							            label: '',
							            data: [<?php echo $percentData; ?>],
							            backgroundColor: [
							                '#36B3EC',
							                '#0085C1',
							                '#78B705',
							                '#A42903',
							            ],
							            borderColor: [
							                '#fff',
							                '#fff',
							                '#fff',
							                '#fff',
							            ],
							            borderWidth: 1
							        }]
							    },

							    options: {
							    	legend:{
							    		display:false,
							    		// position:"right",
							    	},
							    	tooltips:{

							    	},
							    	responsive:true,
							    }
							});


						</script>
					</div>
				</div>
				<?php
				foreach ($evaluations as $i => $evaluation) {
					// print_r($evaluation->name.":". number_format( $evaluation->percent, 2) . '%' . "\n");
					// $name[$i] = $evaluation->name;
					$labelBox .= "
					<div class='labelrow'>
						<span data-labelName='".$evaluation->name."'></span>
						<span class='name'>".$evaluation->name."</span>
						<span>:</span>
						<span class='percentData'>".number_format( $evaluation->percent, 2)."%</span>
					</div>
					";
				}
				?>
				<div class="labelBox">
					<?php echo $labelBox; ?>
				</div>
			</div>

			<div class="evaluationDesc">
				<div class="descTitle"><span>三和ペイントの評価とは？</span></div>
				<div class="descWrap">
					<div class="descRow flex"><span class="labelBox">感動：</span><span class="valueBox"></span></div>
					<div class="descRow flex"><span class="labelBox">満足：</span><span class="valueBox"></span></div>
					<div class="descRow flex"><span class="labelBox">普通：</span><span class="valueBox"></span></div>
					<div class="descRow flex"><span class="labelBox">ハートコール：</span><span class="valueBox"></span></div>
				</div>
			</div>

		</div>

		<div class="form_box">
			<form id="cs_form" name="cs_form"
				action="<?php echo esc_url( home_url( '/cs' ) ); ?>"
				method="get"
			>
				<div class="form_item cs-hide">
					<div class="form_label">
						<label>お客様評価</label>
					</div>
					<div class="form_cont cs_radio">
						<?php foreach ($evaluations as $evaluation) {
							if ( $evaluation->slug != 'heartcall') : ?>
						<span class="cs_list_item">
							<label>
								<input type="radio" name="s_evaluation" class="evaluation_val" value="<?=$evaluation->slug?>"
								<?php
									if ( $f_evaluation == $evaluation->slug) echo "checked='checked'";
								?>
								>
								<span class="cs_list_label"><?=$evaluation->name?></span>
							</label>
						</span>
						<?php endif; } ?>
						<span class="cs_list_item">
							<label>
								<input type="radio" name="s_evaluation" class="evaluation_val" value="all"
								<?php
									if (  $f_evaluation == '' || $f_evaluation == 'all') echo "checked='checked'";
								?>
								>
								<span class="cs_list_label">全て</span>
							</label>
						</span>
					</div>
				</div>

				<div class="form_item flex shopSelect">
					<div class="form_label">
						<label>支店で選択が可能です。</label>
					</div>
					<div class="form_cont cs_select">
						<select name="s_shop" id="shop">
							<option value="all">全ての支店</option>
							<?php foreach ($shops as $shop) { ?>
							<option value="<?=$shop->slug?>"
							<?php
							 	if ( $f_shop == $shop->slug ) echo "selected";
							?>
							><?=$shop->name?></option>
							<?php } ?>
						</select>
					</div>
				</div>


			</form>

			<script type="text/javascript">
				$(document).ready(function() {

					$('#shop').on('change', function() {
						document.forms["cs_form"].submit();
					});

					$('input[type=radio].evaluation_val').on('change', function() {
					    document.forms["cs_form"].submit();
					});

				});
			</script>

		</div>



<?php

if ( $search_query->have_posts() ): ?>
			<div id="og-grid" class="cs_box og-grid">
<?php
	$pagepostnum = $search_query->post_count;
	if($pagepostnum > 10)$pagepostnum = 10;
	$pagepostnum = $pagepostnum - 1;
	// $b1_index = rand(0,9);
	$b1_index = rand(0,$pagepostnum);
	if($pagepostnum !== 0){
		do {
			// $b2_index = rand(0,9);
			$b2_index = rand(0,$pagepostnum);
		} while ($b1_index == $b2_index);
	}

	$cs_item_index = 0;
	$ank = 1;
	while ( $search_query->have_posts() ) {
        $search_query->the_post();

        if ($cs_item_index == $b1_index) : ?>
        		<div class="cs_item cocorobanner">
					<div class="cs_content">
						<div class="cs_banner_box btnWrapper">
							<!-- <a href="/cocorotosou" class="bannerlink"> -->
								<!-- <p class="cs_banner">ココロトソウバナ一</p> -->
								<?php //$banner1 = wp_get_attachment_image_src(18521, ''); ?>
<!-- 								<img src="<?=$banner1[0]?>" alt="ココロトソウバナ一">
 -->
<!-- </a> -->
<a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-flat vc_btn3-block vc_btn3-color-grey" href="/cocorotosou">詳細を見る</a>


						</div>
					</div>
				</div>
		<?php endif;
		if ($cs_item_index == $b2_index) :?>
				<div class="cs_item kantanmitsumori">
					<div class="cs_content">
						<div class="cs_banner_box btnWrapper">
							<!-- <a href="/simple-estimation" class="bannerlink"> -->
								<!-- <p class="cs_banner">簡単見積リバナ</p> -->
								<?php //$banner2 = wp_get_attachment_image_src(18519, ''); ?>
								<!-- <img src="<?=$banner2[0]?>" alt="簡単見積リバナー"> -->
							<!-- </a> -->
<a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-flat vc_btn3-block vc_btn3-color-grey" href="/simple-estimation">詳細を見る</a>
						</div>
					</div>
				</div>
		<?php endif;

        		// get_template_part( 'template-parts/csquestionnaire_post/content', 'csquestionnaire' );
        		include locate_template( 'template-parts/csquestionnaire_post/content-csquestionnaire.php' );
						$ank++;

        $cs_item_index++;
    }
    wp_reset_postdata();

    if ( $b1_index > $cs_item_index ) { ?>
		   		<div class="cs_item">
					<div class="cs_content">
						<div class="cs_banner_box">
							<a href="/cocorotosou" class="bannerlink ga_cs_cocorotosou">
								<!-- <p class="cs_banner">ココロトソウバナ一</p> -->
								<?php $banner1 = wp_get_attachment_image_src(18521, ''); ?>
								<img src="<?=$banner1[0]?>" alt="ココロトソウバナ一">
							</a>
						</div>
					</div>
				</div>
    <?php }
    if ( $b2_index > $cs_item_index ) { ?>
		    	<div class="cs_item">
					<div class="cs_content">
						<div class="cs_banner_box">
							<a href="/simple-estimation" class="bannerlink ga_cs_sekoujirei">
								<!-- <p class="cs_banner">簡単見積リバナ</p> -->
								<?php $banner2 = wp_get_attachment_image_src(18519, ''); ?>
								<img src="<?=$banner2[0]?>" alt="簡単見積リバナー">
							</a>
						</div>
					</div>
				</div>
	<?php } ?>


			</div>

        	<div class="pagination_box">
	            <?php
	            cs_pagination($search_query->max_num_pages, $paged, $s_evaluation, $f_shop);
	            ?>
	        </div>

<?php
else:
    get_template_part( 'template-parts/case_post/content', 'none' );
endif;
?>



		</div>

	</div>

</div>

<div style="margin-bottom: 50px;"></div>



<?php get_footer();
