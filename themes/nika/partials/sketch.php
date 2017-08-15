<?php
  $grid_item_class = sandbox_image_orientation( get_field( 'image' ) ) == 'portrait' ? 'portrait' : 'landscape';
?>

<div class="grid-item grid-item--<?php echo $grid_item_class; ?>">
  <a href="<?php the_permalink(); ?>" data-lightbox>
    <?php sandbox_image( 'image', 'large' ); ?>
  </a>
</div>
