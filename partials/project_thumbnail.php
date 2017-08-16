<?php $max_width = get_field('featured_image_size') ? get_field('featured_image_size') : '80'; ?>
<?php $full_width_class = $max_width == '100' ? 'full-width' : ''; ?>
<div class="project-thumbnail neutral <?php echo $full_width_class; ?>">
  <a class="project-thumbnail-content" href="<?php the_permalink(); ?>">
    <div class="cover accent-background"></div>
    <div class="project-thumbnail-image" style="max-width: <?php echo $max_width; ?>%;">
      <?php sandbox_image('featured_image', 'medium'); ?>
    </div>
  </a>
</div>
