<?php get_header() ?>
  <?php the_post() ?>
  <div class="content">
    <div id="post-<?php the_ID() ?>" <?php post_class() ?>>
      <h2 class="entry-title"><?php the_title() ?></h2>
      <div class="entry-content">
        <?php the_content() ?>
      </div>
      <?php
        if( have_rows('images') ):
          while ( have_rows('images') ) : the_row();
            $pin_class = get_sub_field('pins') ? ' project-with-pin' : '';
            echo '<div class="project-image-outer neutral'.$pin_class.'">';
              echo '<div class="project-image-content">';
                echo '<div class="project-image">';
                  sandbox_image('image', 'large');
                echo '</div>';

                get_template_part('partials/pins');

              echo '</div>';
            echo '</div>';
          endwhile;
        endif;
      ?>
    </div>
  </div>

  <div class="adjacent-post-wrapper relative">
    <div class="previous-post-link large-sans absolute abolute-left absolute-top">
      <?php next_post_link( '%link', '<div class="hidden-title">%title</div>Previous' ); ?>
    </div>
    <div class="next-post-link large-sans absolute absolute-right absolute-top">
      <?php previous_post_link( '%link', '<div class="hidden-title">%title</div>Next' ); ?>
    </div>
  </div>

<?php get_footer() ?>
</body>
</html>
