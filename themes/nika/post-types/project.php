<?php

function project_init() {
	register_post_type( 'project', array(
		'labels'            => array(
			'name'                => __( 'Projects', 'nika' ),
			'singular_name'       => __( 'Project', 'nika' ),
			'all_items'           => __( 'Projects', 'nika' ),
			'new_item'            => __( 'New project', 'nika' ),
			'add_new'             => __( 'Add New', 'nika' ),
			'add_new_item'        => __( 'Add New project', 'nika' ),
			'edit_item'           => __( 'Edit project', 'nika' ),
			'view_item'           => __( 'View project', 'nika' ),
			'search_items'        => __( 'Search projects', 'nika' ),
			'not_found'           => __( 'No projects found', 'nika' ),
			'not_found_in_trash'  => __( 'No projects found in trash', 'nika' ),
			'parent_item_colon'   => __( 'Parent project', 'nika' ),
			'menu_name'           => __( 'Projects', 'nika' ),
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'supports'          => array( 'title', 'editor' ),
		'has_archive'       => true,
		'rewrite'           => true,
		'query_var'         => true,
	) );

}
add_action( 'init', 'project_init' );

function project_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['project'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Project updated. <a target="_blank" href="%s">View project</a>', 'nika'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'nika'),
		3 => __('Custom field deleted.', 'nika'),
		4 => __('Project updated.', 'nika'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Project restored to revision from %s', 'nika'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Project published. <a href="%s">View project</a>', 'nika'), esc_url( $permalink ) ),
		7 => __('Project saved.', 'nika'),
		8 => sprintf( __('Project submitted. <a target="_blank" href="%s">Preview project</a>', 'nika'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Project scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview project</a>', 'nika'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Project draft updated. <a target="_blank" href="%s">Preview project</a>', 'nika'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'project_updated_messages' );
