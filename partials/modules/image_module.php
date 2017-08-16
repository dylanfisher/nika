<?php
  if( have_rows('images') ):
    while ( have_rows('images') ) : the_row();
      $pin_class = get_sub_field('pins') ? ' project-with-pin' : '';
      echo '<div class="project-image-outer'.$pin_class.'">';
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
