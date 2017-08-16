<?php get_header(); ?>
  <?php the_post(); ?>
  <div class="single-sketch-outer-wrapper on-top-fix">
    <div class="sketch-wrapper">
      <div class="site-max-width">
        <header class="sketch-header text-left">
          <h1 class="large-serif">
            <?php the_title(); ?>
          </h1>

          <?php
            $category_names = get_field('metadata');

            if ( $category_names ):
              echo '<div class="sketch__categories small-serif">';
                echo $category_names;
              echo '</div>';
            endif;
          ?>

          <a class="close-icon-wrapper" href="<?php echo get_home_url() . '/sketches' ?>">
            <?php get_template_part('images/svg/close_icon.svg'); ?>
          </a>
        </header>
        <div class="sketch__image">
          <?php sandbox_image( 'image', 'large' ); ?>
        </div>

        <div class="sketch__description small-width small-width--left medium-sans text-left">
          <?php the_field( 'description' ); ?>
        </div>
      </div>
    </div>
  </div>
  <?php get_footer(); ?>
</body>
</html>
