<?php

function sketch_category_init() {
	register_taxonomy( 'sketch_category', array( 'sketch' ), array(
		'hierarchical'      => false,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_admin_column' => false,
		'query_var'         => true,
		'rewrite'           => true,
		'capabilities'      => array(
			'manage_terms'  => 'edit_posts',
			'edit_terms'    => 'edit_posts',
			'delete_terms'  => 'edit_posts',
			'assign_terms'  => 'edit_posts'
		),
		'labels'            => array(
			'name'                       => __( 'Sketch categories', 'YOUR-TEXTDOMAIN' ),
			'singular_name'              => _x( 'Sketch category', 'taxonomy general name', 'YOUR-TEXTDOMAIN' ),
			'search_items'               => __( 'Search sketch categories', 'YOUR-TEXTDOMAIN' ),
			'popular_items'              => __( 'Popular sketch categories', 'YOUR-TEXTDOMAIN' ),
			'all_items'                  => __( 'All sketch categories', 'YOUR-TEXTDOMAIN' ),
			'parent_item'                => __( 'Parent sketch category', 'YOUR-TEXTDOMAIN' ),
			'parent_item_colon'          => __( 'Parent sketch category:', 'YOUR-TEXTDOMAIN' ),
			'edit_item'                  => __( 'Edit sketch category', 'YOUR-TEXTDOMAIN' ),
			'update_item'                => __( 'Update sketch category', 'YOUR-TEXTDOMAIN' ),
			'add_new_item'               => __( 'New sketch category', 'YOUR-TEXTDOMAIN' ),
			'new_item_name'              => __( 'New sketch category', 'YOUR-TEXTDOMAIN' ),
			'separate_items_with_commas' => __( 'Sketch categories separated by comma', 'YOUR-TEXTDOMAIN' ),
			'add_or_remove_items'        => __( 'Add or remove sketch categories', 'YOUR-TEXTDOMAIN' ),
			'choose_from_most_used'      => __( 'Choose from the most used sketch categories', 'YOUR-TEXTDOMAIN' ),
			'not_found'                  => __( 'No sketch categories found.', 'YOUR-TEXTDOMAIN' ),
			'menu_name'                  => __( 'Sketch categories', 'YOUR-TEXTDOMAIN' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'sketch_category',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'sketch_category_init' );
