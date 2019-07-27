<?php

// Branchs Custom Post Type
function branchs_init() {
    // set up cases labels
    $labels = array(
        'name' => '支店',
        'singular_name' => '支店',
        'parent_item_colon' => '',
        'menu_name' => '支店',
    );

    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'branchs'),
        'query_var' => true,
        'menu_icon' => 'dashicons-randomize',
        'publicly_queryable' => true,
        'supports' => array(
            'title',
        )
    );
    register_post_type( 'branchs', $args );

}
add_action( 'init', 'branchs_init' );

function add_branchs_meta_box() {
	remove_meta_box( 'slugdiv', 'branchs', 'normal' );
}
add_action( 'add_meta_boxes', 'add_branchs_meta_box' );

function get_branchs_titles(){

    $result = array();

    $args = array(
        'post_type' => 'branchs',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby'   => 'menu_order',
        'order' => 'ASC',
        'post__not_in' => array(1546),/*本社除外*/
    );
    $posts = new WP_Query( $args );

    foreach ($posts->posts as $branch) {
        $result[] = $branch->post_title;
    }

    return $result;
}
