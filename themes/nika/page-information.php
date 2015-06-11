<?php /* Template Name: Information */ ?>

<?php get_header() ?>
  <?php the_post(); ?>
  <div class="ibfix">
    <div class="sidebar">
      <?php $information_page = get_page_by_path('/information'); ?>
      <?php the_field('sidebar', $information_page->ID); ?>
    </div>
    <div class="page-entry-content">
      <?php the_content(); ?>
    </div>
  </div>
<?php get_footer() ?>
</body>
</html>

