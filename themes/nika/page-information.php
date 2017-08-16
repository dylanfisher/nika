<?php /* Template Name: Information */ ?>

<?php get_header() ?>
  <?php the_post(); ?>
  <div class="ibfix">
    <?php get_template_part( 'partials/landing_text' ); ?>
    <div class="site-max-width">
      <div class="entry-content entry-content--left text-left">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
<?php get_footer() ?>
</body>
</html>

