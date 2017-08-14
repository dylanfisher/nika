<?php if ( get_field( 'landing_page_text' ) ): ?>
  <div class="landing-wrapper">
    <div class="landing-text">
      <div class="page-entry-content">
        <div class="text-center">
          <?php the_field( 'landing_page_text' ); ?>
        </div>
      </div>
    </div>

    <div class="home__down-arrow">
      <?php get_template_part('images/svg/arrow-down.svg'); ?>
    </div>
  </div>
<?php endif; ?>
