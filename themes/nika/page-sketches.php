<?php get_header() ?>
  <?php
    $post_status = 'publish';

    if ( current_user_can( 'editor' ) || current_user_can( 'administrator' ) ) {
      $post_status = array( 'publish', 'pending', 'draft', 'private' );
    }

    $paged = 1;
    $request_url = $_SERVER['REQUEST_URI'];
    preg_match( '/page\/(\d*)\/?/', $request_url, $matches );
    if ( array_key_exists( 1, $matches ) ):
      $paged = intval( $matches[1] );
    endif;

    $args = array(
      'post_type' => array( 'sketch' ),
      'posts_per_page' => 20,
      'orderby' => 'date',
      'post_status' => $post_status,
      'paged' => $paged
    );

    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ):
      echo '<h1 class="sketch-page-title huge-serif">Sketch Book</h1>';
      echo '<div class="site-max-width on-top-fix">';
        echo '<div class="sketches masonry" id="sketches">';
          echo '<div class="grid-sizer"></div>';
          while ( $the_query->have_posts() ):
            $the_query->the_post();
            get_template_part( 'partials/sketch' );
          endwhile;
          echo '<div class="next-page-wrapper">';
            echo get_next_posts_link( 'Loading...', $the_query->max_num_pages );
          echo '</div>';
        echo '</div>';
      echo '</div>';
    wp_reset_postdata();
    else:
      echo '<p>No works are available.</p>';
    endif;
  ?>
<?php get_footer() ?>
</body>
</html>
