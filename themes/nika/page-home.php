<?php /* Template Name: Home */ ?>

<?php get_header() ?>
  <div class="project-thumbnail-wrapper">
    <?php
      $args = array(
        'post_type' => 'project',
        'posts_per_page' => -1,
        'orderby' => 'menu_order'
      );

      $home_query = new WP_Query($args);

      if ( $home_query->have_posts() ):
        while ( $home_query->have_posts() ):
          $home_query->the_post();
          get_template_part('partials/project_thumbnail');
        endwhile;
      endif;
      $home_query->reset_postdata();
    ?>
  </div>
<?php get_footer() ?>
</body>
</html>

