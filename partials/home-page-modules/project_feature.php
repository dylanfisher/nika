<?php
  $slide_count = count( get_sub_field( 'slides' ) );

  if ( have_rows('slides') ):
    echo '<div class="home-carousel home-carousel-slide-count-' . $slide_count . ' wrapper-offset">';
      while ( have_rows('slides') ) : the_row();
        echo '<div class="home-carousel__slide">';
          if ( get_sub_field( 'video_url' ) ):
            $poster_url = '';
            if ( get_sub_field('image') ):
              $poster_url = get_sub_field('image')['sizes']['medium'];
            endif;
            if ( $poster_url ):
              echo '<video src="' . get_sub_field('video_url') . '" poster="' . $poster_url . '" loop>';
            else:
              echo '<video src="' . get_sub_field('video_url') . '" loop>';
            endif;
          else:
            sandbox_image('image', 'large');
          endif;
        echo '</div>';
      endwhile;
    echo '</div>';
  endif;

  echo '<div class="home-carousel__slide-info-wrapper">';
    echo '<div class="home-carousel__slide-info">';
      echo '<div class="site-max-width">';
        if ( get_sub_field('description') ):
          echo '<div class="home-carousel__description large-serif">' . get_sub_field('description') . '</div>';
        endif;

        if ( get_sub_field('additional_info') ):
          echo '<div class="home-carousel__additional-info">';
            echo '<div class="small-serif">';
              echo get_sub_field('additional_info');
            echo '</div>';
          echo '</div>';
        endif;

        echo '<div class="home-carousel__slide__link-area">';
          if ( get_sub_field('project_link') ):
            echo '<a class="big-button" href="' . get_sub_field('project_link') . '">';
              echo get_sub_field('project_link_label') ? get_sub_field('project_link_label') : get_sub_field('project_link');
            echo '</a>';
          endif;

          if ( get_sub_field('project_link_internal') ):
            $url = get_permalink( get_sub_field( 'project_link_internal' ) );
            echo '<a class="big-button" href="' . $url . '">';
              echo 'Learn more';
            echo '</a>';
          endif;
        echo '</div>';

      echo '</div>';
    echo '</div>';
  echo '</div>';
?>
