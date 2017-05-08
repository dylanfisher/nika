<?php

// Redirect all requests to the home page
function sandbox_template_redirect() {
  if ( !is_user_logged_in() && !is_front_page() ) {
    wp_redirect( home_url() );
    exit();
  }
}
add_action( 'template_redirect', 'sandbox_template_redirect' );
