<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */


get_header(); ?>

<?php



$post_type = $_GET['post_type'] ?: 'cases';
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = [
    'posts_per_page' => 10,
    'paged'          => $paged,
    'post_type' => $post_type,
    'post_status' => 'publish',
    'meta_query' => [
        'relation' => 'AND',
    ]
];

$branch = $_GET['s_branch'] ?: '';
if ( $branch ) {
    $args['meta_query'][] = [
        'key' => 'branch',
        'value' => $branch,
        'compare' => '='
    ];
}

$s_detacheds = $_GET['s_detacheds'] ?: '';
$s_detacheds_text = '';
if ( $s_detacheds ) {
    $detacheds_query = ['relation' => 'AND'];
    foreach ($s_detacheds as $s_detached) {
        $detacheds_query[] = [
            'key' => 'detacheds',
            'value' => $s_detached,
            'compare' => '='
        ];
        $s_detacheds_text .= $s_detached . '、';
    }
    $args['meta_query'][] = $detacheds_query;
    $s_detacheds_text = rtrim($s_detacheds_text,'、');
}

$s_housemakers = $_GET['s_housemakers'] ?: '';
$s_housemakers_text = '';
if ( $s_housemakers ) {
    $housemakers_query = ['relation' => 'AND'];
    foreach ($s_housemakers as $s_housemaker) {
        $housemakers_query[] = [
            'key' => 'housemakers',
            'value' => $s_housemaker,
            'compare' => '='
        ];
        $s_housemakers_text .= $s_housemaker . '、';
    }
    $args['meta_query'][] = $housemakers_query;
    $s_housemakers_text = rtrim($s_housemakers_text,'、');
}

for ($ow=0; $ow <= count($GLOBALS['other_works']); $ow++) {
    if ( array_key_exists( 'other_works_'.$ow, $_GET) ) {

        $args['meta_query'][] = [
            'key' => 'other_works_'.$ow,
            'value' => $_GET['other_works_'.$ow],
            'compare' => '='
        ];

    }
}

for ($we=0; $we <= count($GLOBALS['worry_elements']); $we++) {
    if ( array_key_exists( 'worry_elements_'.$we, $_GET) ) {

        $args['meta_query'][] = [
            'key' => 'worry_elements_'.$we,
            'value' => $_GET['worry_elements_'.$we],
            'compare' => '='
        ];

    }
}

// //使用塗料 壁
// $s_case_types = $_GET['s_case_types'] ?: '';
// $s_case_types_text = '';
// if ( $s_case_types ) {
//     $case_types_query = ['relation' => 'AND'];
//     foreach ($s_case_types as $s_case_type) {
//         $case_types_query[] = [
//             'key' => 'case_types',
//             'value' => '"'.$s_case_type.'"',
//             'compare' => 'LIKE'
//         ];
//     }
//     $args['meta_query'][] = $case_types_query;
// }

// //使用塗料　屋根
// $s_case_type_roofs = $_GET['s_case_type_roofs'] ?: '';
// $s_case_type_roofs_text = '';
// if ( $s_case_type_roofs ) {
//     $s_case_type_roofs_query = ['relation' => 'AND'];
//     foreach ($s_case_type_roofs as $s_case_type_roof) {
//         $s_case_type_roofs_query[] = [
//             'key' => 'case_type_roofs',
//             'value' => '"'.$s_case_type_roof.'"',
//             'compare' => 'LIKE'
//         ];
//     }
//     $args['meta_query'][] = $s_case_type_roofs_query;
// }

$cond_imgs = array();

$outwall_colors = get_colors_titles('outwall-stand-color');
foreach ($outwall_colors as $outwall_color) {
    if ( array_key_exists( $outwall_color['key'], $_GET) ) {

        $args['meta_query'][] = [
            'key' => $outwall_color['key'],
            'value' => $_GET[$outwall_color['key']],
            'compare' => '='
        ];
        $cond_imgs[] = $outwall_color['ID'];

    }
}

$outwall_waterzols = get_colors_titles('outwall-zola-coat-color');
foreach ($outwall_waterzols as $outwall_waterzol) {
    if ( array_key_exists( $outwall_waterzol['key'], $_GET) ) {

        $args['meta_query'][] = [
            'key' => $outwall_waterzol['key'],
            'value' => $_GET[$outwall_waterzol['key']],
            'compare' => '='
        ];
        $cond_imgs[] = $outwall_waterzol['ID'];
    }
}

$outwall_coatings = get_colors_titles('outwall-coat-color');
foreach ($outwall_coatings as $outwall_coating) {
    if ( array_key_exists( $outwall_coating['key'], $_GET) ) {

        $args['meta_query'][] = [
            'key' => $outwall_coating['key'],
            'value' => $_GET[$outwall_coating['key']],
            'compare' => '='
        ];
        $cond_imgs[] = $outwall_coating['ID'];
    }
}

$roof_hscolors = get_colors_titles('roof-heat-color');
foreach ($roof_hscolors as $roof_hscolor) {
    if ( array_key_exists( $roof_hscolor['key'], $_GET) ) {

        $args['meta_query'][] = [
            'key' => $roof_hscolor['key'],
            'value' => $_GET[$roof_hscolor['key']],
            'compare' => '='
        ];
        $cond_imgs[] = $roof_hscolor['ID'];
    }
}

$roof_standcols = get_colors_titles('roof-stand-color');
foreach ($roof_standcols as $roof_standcol) {
    if ( array_key_exists( $roof_standcol['key'], $_GET) ) {

        $args['meta_query'][] = [
            'key' => $roof_standcol['key'],
            'value' => $_GET[$roof_standcol['key']],
            'compare' => '='
        ];
        $cond_imgs[] = $roof_standcol['ID'];
    }
}




$sp_color_other = ['relation' => 'OR'];
if (array_key_exists( 'outwall-stand-color_0', $_GET)) {
    $sp_color_other[] = [
        'key' => 'outwall-stand-color_0',
        'value' => $_GET['outwall-stand-color_0'],
        'compare' => '='
    ];
}
if (array_key_exists( 'outwall-zola-coat-color_0', $_GET)) {
    $sp_color_other[] = [
        'key' => 'outwall-zola-coat-color_0',
        'value' => $_GET['outwall-zola-coat-color_0'],
        'compare' => '='
    ];
}
if (array_key_exists( 'outwall-coat-color_0', $_GET)) {
    $sp_color_other[] = [
        'key' => 'outwall-coat-color_0',
        'value' => $_GET['outwall-coat-color_0'],
        'compare' => '='
    ];
}
if (array_key_exists( 'roof-heat-color_0', $_GET)) {
    $sp_color_other[] = [
        'key' => 'roof-heat-color_0',
        'value' => $_GET['roof-heat-color_0'],
        'compare' => '='
    ];
}
if (array_key_exists( 'roof-stand-color_0', $_GET)) {
    $sp_color_other[] = [
        'key' => 'roof-stand-color_0',
        'value' => $_GET['roof-stand-color_0'],
        'compare' => '='
    ];
}
$args['meta_query'][] = $sp_color_other;



$total_args = $args;
$total_args['posts_per_page'] = -1;
$total_query = new WP_Query( $total_args );

$search_query = new WP_Query( $args );  

?>

 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<div class="main_panel font-noto maxWidth2">
    <div class="main_panel_border">
        <div class="main_content_pane list_page">
            <!--Title-->
            <div class="search_title_box">
                <div class="vc_row wpb_row vc_row-fluid A01">
                    <div class="wpb_column vc_column_container vc_col-sm-12">
                        <div class="vc_column-inner">
                            <div class="wpb_wrapper">
                                <div class="wpb_text_column wpb_content_element ">
                                    <div class="wpb_wrapper">
                                        <h2 class="style02">施工事例検索結果</h2>
                                        <!-- <h3 class="style02">施工事例検索結果</h2> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
              <div class="page_main_content">

                <section class="page_left_pane">
                  <?php //count($total_query->posts)//件数 ?>
                  <?php //検索項目 ?>
                  <?php //$s_housemakers_textハウスメーカー検索条件 ?>
                  <?php //$s_detacheds_text戸建て検索条件 ?>
                  <?php //色
                  // $cond_imgs//色　配列
                  // $cond_img_url = plugins_url() . '/js_composer/assets/vc/no_image.png';//NOIMG
                  // $cond_img_url = get_the_post_thumbnail_url($cimg,'full');//色画像
                  ?>
                    <div id="detail_view">

<?php
if ( $search_query->have_posts() ):
    while ( $search_query->have_posts() ) {
        $search_query->the_post();

        get_template_part( 'template-parts/case_post/content', 'cases' );
    }
    wp_reset_postdata();
?>

        <div class="pagination_box">
            <?php sanwa_pagination($search_query->max_num_pages); ?>
        </div>

<?php
else:
    get_template_part( 'template-parts/case_post/content', 'none' );
endif;
?>

                    </div>

                </section>

                <?php get_template_part( 'template-parts/page/detail', 'right' ); ?>

                <div class="clearfix"></div>
            </div>

        </div>
    </div>
</div>
</article>
<?php get_footer();
