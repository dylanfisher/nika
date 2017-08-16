<?php

function sketch_init() {
	register_post_type( 'sketch', array(
		'labels'            => array(
			'name'                => __( 'Sketches', 'nika' ),
			'singular_name'       => __( 'Sketch', 'nika' ),
			'all_items'           => __( 'All Sketches', 'nika' ),
			'new_item'            => __( 'New Sketch', 'nika' ),
			'add_new'             => __( 'Add New', 'nika' ),
			'add_new_item'        => __( 'Add New Sketch', 'nika' ),
			'edit_item'           => __( 'Edit Sketch', 'nika' ),
			'view_item'           => __( 'View Sketch', 'nika' ),
			'search_items'        => __( 'Search Sketches', 'nika' ),
			'not_found'           => __( 'No Sketches found', 'nika' ),
			'not_found_in_trash'  => __( 'No Sketches found in trash', 'nika' ),
			'parent_item_colon'   => __( 'Parent Sketch', 'nika' ),
			'menu_name'           => __( 'Sketches', 'nika' ),
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'supports'          => array( 'title', 'editor' ),
		'has_archive'       => false,
		'rewrite'           => true,
		'query_var'         => true,
		'menu_icon'         => 'dashicons-admin-post',
		'show_in_rest'      => true,
		'rest_base'         => 'sketch',
		'taxonomies'        => array('sketch_category'),
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'sketch_init' );

function sketch_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['sketch'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Sketch updated. <a target="_blank" href="%s">View Sketch</a>', 'nika'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'nika'),
		3 => __('Custom field deleted.', 'nika'),
		4 => __('Sketch updated.', 'nika'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Sketch restored to revision from %s', 'nika'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Sketch published. <a href="%s">View Sketch</a>', 'nika'), esc_url( $permalink ) ),
		7 => __('Sketch saved.', 'nika'),
		8 => sprintf( __('Sketch submitted. <a target="_blank" href="%s">Preview Sketch</a>', 'nika'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Sketch scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Sketch</a>', 'nika'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Sketch draft updated. <a target="_blank" href="%s">Preview Sketch</a>', 'nika'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'sketch_updated_messages' );
