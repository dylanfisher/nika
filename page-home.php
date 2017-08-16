<?php /* Template Name: Home */ ?>

<?php get_header() ?>
<?php the_post() ?>

  <div class="content">
    <div id="page-<?php the_ID() ?>" <?php post_class() ?>>
      <div class="landing-wrapper">
        <div class="landing-text">
          <span class="home-page__name huge-sans"><strong>Nika Simovich</strong></span>
          <span class="home-page__title large-serif">Art Direction &amp; Graphic Design</span>
        </div>

        <div class="home__down-arrow">
          <?php get_template_part('images/svg/arrow-down.svg'); ?>
        </div>
      </div>

      <?php
        if ( have_rows('project_carousel') ):
          $i = -1;
          echo '<div class="home-carousel wrapper-offset">';
            while ( have_rows('project_carousel') ) : the_row(); $i++;
              echo '<div class="home-carousel__slide" data-index="' . $i . '">';
                if ( get_sub_field('video_url') ):
                  $poster_url = '';
                  if ( get_sub_field('image') ):
                    $poster_url = get_sub_field('image')['sizes']['medium'];
                  endif;
                  echo '<video src="' . get_sub_field('video_url') . '" poster="' . $poster_url . '">';
                else:
                  if ( get_sub_field('image') ):
                    sandbox_image('image', 'large');
                  endif;
                endif;
              echo '</div>';
            endwhile;
          echo '</div>';

          $i = -1;
          echo '<div class="home-carousel__slide-info-wrapper">';
            while ( have_rows('project_carousel') ) : the_row(); $i++;
              echo '<div class="home-carousel__slide-info" data-index="' . $i . '">';
                echo '<div class="site-max-width">';
                  if ( get_sub_field('description') ):
                    echo '<div class="home-carousel__description large-serif">' . get_sub_field('description') . '</div>';
                  endif;

                  if ( get_sub_field('project_link') ):
                    echo '<div class="home-carousel__project_link">';
                      echo '<a class="big-button" href="' . get_sub_field('project_link') . '">';
                        echo get_sub_field('project_link_label') ? get_sub_field('project_link_label') : get_sub_field('project_link');
                      echo '</a>';
                    echo '</div>';
                  endif;

                  if ( get_sub_field('additional_info') ):
                    echo '<div class="home-carousel__additional-info">';
                      echo '<div class="medium-sans">';
                        echo get_sub_field('additional_info');
                      echo '</div>';
                    echo '</div>';
                  endif;
                echo '</div>';
              echo '</div>';
            endwhile;
          echo '</div>';
        endif;
      ?>
    </div><!-- .post -->
  </div><!-- .content -->

<?php get_footer() ?>
</body>
</html>

