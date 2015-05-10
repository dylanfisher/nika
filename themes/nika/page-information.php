<?php /* Template Name: Information */ ?>

<?php get_header() ?>
  <?php the_post(); ?>
  <div class="ibfix">
    <div class="sidebar">
      <?php the_field('sidebar'); ?>
    </div>
    <div class="page-entry-content">
      <?php the_content(); ?>
    </div>
  </div>
<?php get_footer() ?>
</body>
</html>

