<?php /* Template Name: Home */ ?>

<?php get_header() ?>
<?php the_post() ?>

  <div class="content">
    <div id="page-<?php the_ID() ?>" <?php post_class() ?>>
      <div class="landing-wrapper">
        <div class="landing-text">
          <span class="home-page__name huge-sans"><strong>Nika Fisher</strong></span>
          <span class="home-page__title large-serif">Creative Direction &amp; Design</span>
        </div>

        <div class="home__down-arrow">
          <?php get_template_part('images/svg/arrow-down.svg'); ?>
        </div>
      </div>

      <?php
        if ( have_rows( 'modules' ) ):
          echo '<div class="home-page-modules">';
            while ( have_rows( 'modules' ) ) : the_row();
              echo '<div class="module module-type--' . get_row_layout() . '">';
                get_template_part( 'partials/home-page-modules/' . get_row_layout() );
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

