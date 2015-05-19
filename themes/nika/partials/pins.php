<?php
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
?>
