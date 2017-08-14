<?php

//  ____                  _ _
// | ___|  __ _ _ __   __| | |__   _____  __
// |___ \ / _` | '_ \ / _` | '_ \ / _ \ \/ /
//  ___) | (_| | | | | (_| | |_) | (_) >  <
// |____/ \__,_|_| |_|\__,_|_.__/ \___/_/\_\

include 'lib/MoonPhase.php';

// CSS and JS script enqueues
require_once('functions/enqueue_scripts.php');

// Include all functions
foreach (glob(get_stylesheet_directory() . '/functions/functions/*.php') as $filename) {
  require_once $filename;
}

//
// Enables
//

// Custom menus
add_theme_support( 'menus' );

// Custom Image Sizes (Name, Width, Height, Hard Crop boolean)
// add_image_size( 'medium-crop', 600, 325, true );

// Check for custom Single Post templates by category ID. Format for new template names is single-category[ID#].php (ommiting the brackets)
// add_filter('single_template', create_function('$t', 'foreach( (array) get_the_category() as $cat ) { if ( file_exists(TEMPLATEPATH . "/single-{$cat->term_id}.php") ) return TEMPLATEPATH . "/single-{$cat->term_id}.php"; } return $t;' ));

if( function_exists('acf_add_options_page') ) {
  acf_add_options_page();
}

//
// Disables
//

// Disable Admin Bar
add_filter('show_admin_bar', '__return_false');

// Disable Wordpress Generator meta tag
function sandbox_version_info() {
   return '';
}
add_filter('the_generator', 'sandbox_version_info');

// Remove unnecessary wp_head items
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

// Remove meta boxes from dashboard
function sandbox_remove_dashboard_widgets(){
  global $wp_meta_boxes;
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);}
add_action('wp_dashboard_setup', 'sandbox_remove_dashboard_widgets' );

// Remove unneccesary admin menu panels. Uncomment to disable
function sandbox_remove_menus(){
  // remove_menu_page( 'index.php' );                  //Dashboard
  // remove_menu_page( 'edit.php' );                   //Posts
  // remove_menu_page( 'upload.php' );                 //Media
  // remove_menu_page( 'edit.php?post_type=page' );    //Pages
  remove_menu_page( 'edit-comments.php' );          //Comments
  // remove_menu_page( 'themes.php' );                 //Appearance
  // remove_menu_page( 'plugins.php' );                //Plugins
  // remove_menu_page( 'users.php' );                  //Users
  // remove_menu_page( 'tools.php' );                  //Tools
  // remove_menu_page( 'options-general.php' );        //Settings
}
add_action( 'admin_menu', 'sandbox_remove_menus' );


//
// Custom functions
//

function sandbox_month_day_time($timestamp) {
  return strftime( "%B %e", $timestamp );
}

// Get an <img> at size from an ACF image field
function sandbox_image($acf_image_field_name, $image_size) {
  $image = get_field($acf_image_field_name);
  if(!$image) $image = get_sub_field($acf_image_field_name);
  $alt = $image['alt'];
  if(empty($alt)) $alt = $image['title'];
  $size = $image_size;
  $url = $image['sizes'][$size];
  $width = $image['sizes'][$size.'-width'];
  $height = $image['sizes'][$size.'-height'];
  echo '<img src="'.$url.'" width="'.$width.'" height="'.$height.'" alt="nika simovich '.$alt.'">';
}

// Function to create slug out of text
function sandbox_slugify( $text ) {
  $str = strtolower( trim( $text ) );
  $str = preg_replace( '/[^a-z0-9-]/', '-', $str );
  $str = preg_replace( '/-+/', "-", $str );
  return trim( $str, '-' );
}

// Custom excerpt size
function sandbox_custom_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

// Limit content
function sandbox_content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}


//
// Filters
//

// Add page slug to body class
function sandbox_add_slug_body_class( $classes ) {
  global $post;
  if ( isset( $post ) ) {
    $classes[] = $post->post_type . '-' . $post->post_name;
  }
  return $classes;
}
add_filter( 'body_class', 'sandbox_add_slug_body_class' );

function sandbox_add_slug_class_to_menu_item($output){
  $ps = get_option('permalink_structure');
  if(!empty($ps)){
    $idstr = preg_match_all('/<li id="menu-item-(\d+)/', $output, $matches);
    foreach($matches[1] as $mid){
      $id = get_post_meta($mid, '_menu_item_object_id', true);
      $slug = basename(get_permalink($id));
      $output = preg_replace('/menu-item-'.$mid.'">/', 'menu-item-'.$mid.'" data-slug="'.$slug.'">', $output, 1);
    }
  }
  return $output;
}
add_filter('wp_nav_menu', 'sandbox_add_slug_class_to_menu_item');

// Apply parent page template theme to child pages
function sandbox_child_page_template_inheriter() {
  global $post;
  // Checks if current post type is a page, rather than a post
  if (is_page()) {
    // Checks if page is parent, if yes, return
    if ($post->post_parent == 0)
      return true;
    else if ($post->post_parent != $post->ID) {
      $parent_page_template = get_post_meta($post->post_parent,'_wp_page_template',true);

      $template = TEMPLATEPATH . "/{$parent_page_template}";
      if (file_exists($template)) {
        load_template($template);
        exit;
      }
    }
  }
}
add_action('template_redirect','sandbox_child_page_template_inheriter');

function sandbox_embed_oembed_html($html, $url, $attr, $post_id) {
  return '</div><div class="embed-wrapper project-image-outer neutral"><div class="project-image">' . $html . '</div></div><div class="entry-content entry-content-after-embed">';
}
add_filter('embed_oembed_html', 'sandbox_embed_oembed_html', 99, 4);

//
// Shortcode functions
//

// function sandbox_example_shortcode( $atts, $content = null ) {
//   $a = shortcode_atts( array(
//       'name' => 'Name of staff',
//       'title' => 'Title of staff'
//   ), $atts );

//   return '<div class="staff-member"><div class="staff-member-name">'.$a['name'].'</div><div class="staff-member-title">'.$a['title'].'</div><div class="staff-member-bio">'.$content.'</div><div class="staff-member-bio-link">View Bio</div></div>';
// }
// add_shortcode( 'example', 'sandbox_example_shortcode' );

//
// Post types
//

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
    'taxonomies'        => array('post_tag')
  ) );
}
add_action( 'init', 'project_init' );

?>
