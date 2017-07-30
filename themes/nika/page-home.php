<?php /* Template Name: Home */ ?>

<?php get_header() ?>
<?php the_post() ?>

  <div class="content">
    <div id="page-<?php the_ID() ?>" <?php post_class() ?>>
      <h1 class="text-left"><?php echo get_bloginfo('name'); ?></h1>
      <div class="entry-content entry-content--left">
        <div class="home-landing-text large-serif">
          <?php the_content(); ?>
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
                if ( get_sub_field('description') ):
                  echo '<div class="entry-content">';
                    echo '<div class="home-carousel__description large-serif">' . get_sub_field('description') . '</div>';
                  echo '</div>';
                endif;

                if ( get_sub_field('project_url') ):
                  echo '<div class="home-carousel__project_url">' . get_sub_field('project_url') . '</div>';
                endif;
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

