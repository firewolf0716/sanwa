<?php

// Colors Custom Post Type
function colors_init() {
	// set up cases labels
	$labels = array(
		'name' => '色',
		'singular_name' => '色',
		'parent_item_colon' => '',
		'menu_name' => '色',
	);

	// register post type
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => 'colors'),
		'query_var' => true,
		'menu_icon' => 'dashicons-randomize',
		'publicly_queryable' => true,
		'supports' => array(
			'title',
			'thumbnail'
		)
	);
	register_post_type( 'colors', $args );

	register_taxonomy(
		'colors_category',
		'colors',
		array(
			'hierarchical' => true,
			'label' => '色の分類',
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array(
				'slug' => 'colors-category'
			)
		)
	);

}
add_action( 'init', 'colors_init' );

function add_colors_meta_box() {
	remove_meta_box( 'slugdiv', 'colors', 'normal' );
}
add_action( 'add_meta_boxes', 'add_colors_meta_box' );

function add_colors_columns($columns) {
	$columns['colors_category'] = '色の分類';
	return $columns;
}
add_filter( 'manage_edit-colors_columns', 'add_colors_columns' );

function add_colors_columns_content($column_name, $post_id) {
	if ($column_name == 'colors_category') {
		$stitle = get_the_term_list($post_id, 'colors_category', '', ', ');
	}

	if (isset($stitle) && $stitle) {
		print_r($stitle);
	}
}
add_action( 'manage_colors_posts_custom_column', 'add_colors_columns_content', 10, 2 );

function add_colors_category_restrict_filter() {
	global $post_type;
	if ( 'colors' == $post_type ) {
		?>
		<select name="colors_category">
			<option value="">カテゴリー指定なし</option>
			<?php
				$terms = get_terms('colors_category');
				foreach ($terms as $term) { ?>
					<option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
			<?php } ?>
		</select>
		<?php
	}
}
add_action( 'restrict_manage_posts', 'add_colors_category_restrict_filter' );

function get_colors_titles($terms="" , $titile=""){

	$result = array();
	if(!empty($titile) && empty($terms)){
		$args = array(
			'post_type' => 'colors',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'title' => $titile,
			'orderby'   => 'title',
			'order' => 'ASC'
		);
	}else{
		$args = array(
			'post_type' => 'colors',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'tax_query' => array(
				array (
					'taxonomy' => 'colors_category',
					'field' => 'slug',
					'terms' => $terms
				)
			),
			'orderby'   => 'title',
			'order' => 'ASC'
		);
	}
	$posts = new WP_Query( $args );

//色の名前　自然順にする
	$id_array = array();
	foreach( $posts->posts as $postsvalue) {
	    $id_array[] = $postsvalue->post_title;
	}
	array_multisort($id_array,SORT_ASC,SORT_NATURAL,$posts->posts);
	$posts->posts = array_values($posts->posts);

	foreach ($posts->posts as $color) {
		$termname = "";
		$termarray = get_the_terms( $color->ID, "colors_category" );
		if ( $termarray && ! is_wp_error( $termarray ) ){
			foreach ( $termarray as $terms_name ) {
				$termname = $terms_name->slug;
			}
		}
		$result[] = array(
			'ID' => $color->ID,
			'key' => $terms . '_' . $color->ID,
			'value' => $color->post_title,
			'terms' => $termname
		);
	}

	return $result;
}


function get_cases_colors($terms){

	$args = array(
		'post_type' => 'colors',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'tax_query' => array(
			array (
				'taxonomy' => 'colors_category',
				'field' => 'slug',
				'terms' => $terms
			)
		),
		'orderby'   => 'title',
		'order' => 'ASC'
	);
	$posts = new WP_Query( $args );

	//色の名前　自然順にする
		$id_array = array();
		foreach( $posts->posts as $postsvalue) {
		    $id_array[] = $postsvalue->post_title;
		}
		array_multisort($id_array,SORT_ASC,SORT_NATURAL,$posts->posts);
		$posts->posts = array_values($posts->posts);

	return $posts->posts;
}


// add_post_type_support( 'colors', 'page-attributes' );
