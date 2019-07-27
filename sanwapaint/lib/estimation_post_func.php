<?php

add_filter( 'manage_edit-estimation_columns', 'my_columns' );
function my_columns( $columns ) {
	$date = $colunns['date'];
  	unset( $columns['date'] );
    $columns['estimation_cat'] = '費用プランの分類';
    $columns['dimen'] = '面積';
    $materials = get_field_object('materials')['sub_fields'];
    foreach ($materials as $material) {
    	$columns[$material['name']] = $material['label'];
    }
   	$columns['date'] = '日付';
    return $columns;
}

add_action( 'manage_estimation_posts_custom_column', 'populate_columns' );
function populate_columns( $column ) {
	if ( 'estimation_cat' == $column ) {
		echo get_the_term_list($post_id, 'estimation_cat', '', ', ');
	}
    if ( 'dimen' == $column ) {
        echo get_field('dimen');
    }
    $materials = get_field_object('materials')['sub_fields'];
    $mat_values = get_field_object('materials')['value'];
    foreach ($materials as $material) {
    	if ( $material['name'] == $column )
	       echo '&#165;' . $mat_values[$material['name']];
    }
}

function add_estimation_category_restrict_filter() {
	global $post_type;
	if ( 'estimation' == $post_type ) { ?>
		<select name="estimation_cat">
			<option value="">カテゴリー指定なし</option>
			<?php
				$terms = get_terms('estimation_cat');
				foreach ($terms as $term) { ?>
					<option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
			<?php } ?>
		</select> <?php
	}
}
add_action( 'restrict_manage_posts', 'add_estimation_category_restrict_filter' );

function get_estimation_dimens($term) {
	$args = array(
		'post_type' => 'estimation',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'tax_query' => array(
			array (
				'taxonomy' => 'estimation_cat',
				'field' => 'slug',
				'terms' => $term
			)
		),
		'orderby'   => 'title',
		'order' => 'ASC'
	);
	$posts = new WP_Query( $args );
	$result = array();
	foreach ($posts->posts as $estcat1) {
		$result[] = get_field('dimen', $estcat1->ID);
	}
	natsort( $result );
	return $result;
}

function get_estimation_materials($f = '')
{
	$materials = acf_get_field( 'materials' )['sub_fields'];
	$result = array();
	if ($f) {
		foreach ($materials as $material) {
			if ($f == $material['name'])
				$result = array('label' => $material['label']);
		}
	}else{
		foreach ($materials as $material) {
			$result[] = array(	'label' => $material['label'],
							'field' => $material['name'] );
		}
	}
	return $result;
}

function get_rest_front_part($string, $sub)
{
    $string = ' '.$string.' ';
    $pos = mb_strpos($string, $sub);
    $front = mb_substr($string, 0, $pos);
    return rtrim(ltrim($front));
}

function get_estimation_value($dimen, $mat, $dimen2, $mat2)
{
	$args1 = array(
		'post_type' => 'estimation',
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'relation' => 'AND',
		'meta_query' => array(
			array(
			  'key' => 'dimen',
			  'value' => $dimen,
			  'compare' => '='
			),
		),
		'tax_query' => array(
			array (
				'taxonomy' => 'estimation_cat',
				'field' => 'slug',
				'terms' => 'est-cat-01'
			)
		),
	);
	$result1 = get_post_meta( get_posts( $args1 )[0]->ID, 'materials_' . $mat, true) ;

	$args2 = array(
		'post_type' => 'estimation',
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'relation' => 'AND',
		'meta_query' => array(
			array(
			  'key' => 'dimen',
			  'value' => $dimen2,
			  'compare' => '='
			),
		),
		'tax_query' => array(
			array (
				'taxonomy' => 'estimation_cat',
				'field' => 'slug',
				'terms' => 'est-cat-02'
			)
		),
	);
	$result2 = get_post_meta( get_posts( $args2 )[0]->ID, 'materials_' . $mat2, true) ;

	return array( 'wall' => $result1, 'roof' => $result2);
}


function my_acf_admin_head() {
    ?>
    <style type="text/css">

	.acf-fields.-left>.acf-field.materials>.acf-label{
		width: 45%;
	}
	.acf-fields.-left>.acf-field.materials:before{
		width: 45%;
	}
	.acf-fields.-left>.acf-field.materials>.acf-input{
		width: 55%;
	}

    </style>
    <?php
}

add_action('acf/input/admin_head', 'my_acf_admin_head');
