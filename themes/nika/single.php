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

                if( have_rows('pins') ):
                  echo '<div class="pin-wrapper">';
                    while ( have_rows('pins') ) : the_row();
                      if(get_sub_field('content')):
                        if(get_sub_field('link')):
                          echo '<a class="pin" href="'.get_sub_field('link').'" target="_blank">';
                            echo '<div class="pin-content">';
                              the_sub_field('content');
                            echo '</div>';
                          echo '</a>';
                        else:
                          echo '<div class="pin">';
                            echo '<div class="pin-content">';
                              the_sub_field('content');
                            echo '</div>';
                          echo '</div>';
                        endif;
                      endif;
                    endwhile;
                  echo '</div>';
                endif;

              echo '</div>';
            echo '</div>';
          endwhile;
        endif;
      ?>
    </div>
  </div>

  <div class="previous-post-link large-sans">
    <?php previous_post_link( '%link', '<div class="hidden-title">%title</div>Previous' ); ?>
  </div>

  <div class="next-post-link large-sans">
    <?php next_post_link( '%link', '<div class="hidden-title">%title</div>Next' ); ?>
  </div>

<?php get_footer() ?>
</body>
</html>
