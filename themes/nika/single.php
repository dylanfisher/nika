<?php get_header() ?>
  <?php the_post() ?>
  <div class="content">
    <div id="post-<?php the_ID() ?>" <?php post_class() ?>>
      <header class="project-header">
        <div class="project-header__title-area entry-content text-left">
          <div class="project-header__title">
            <div class="project-header__year">
              <div class="project-header__year__number huge-sans">
                <?php the_field( 'year' ); ?>
              </div>
            </div>
            <h1 class="huge-serif"><?php the_title() ?></h1>
          </div>
          <div class="project-header__tags small-serif">
            <?php
              $tags = wp_get_post_tags( $post->ID );
              $tag_names = array();
              foreach ( $tags as $key => $value ):
                array_push( $tag_names, $value->name );
              endforeach;
              echo join( ', ', $tag_names );
            ?>
          </div>
        </div>
      </header>
      <div class="entry-content text-left">
        <?php the_content() ?>
      </div>
      <div class="site-max-width">
        <?php
          if ( get_field('project_link') ):
            echo '<div class="entry-content text-center">';
              echo '<a class="big-button" href="' . get_field('project_link') . '">';
                echo get_field('project_link_label') ? get_field('project_link_label') : get_field('project_link');
              echo '</a>';
            echo '</div>';
          endif;

          if ( get_field('additional_info') ):
            echo '<div class="entry-content">';
              echo '<div class="medium-sans">';
                echo get_field('additional_info');
              echo '</div>';
            echo '</div>';
          endif;
        ?>
        <?php
          if( have_rows('images') ):
            while ( have_rows('images') ) : the_row();
              $pin_class = get_sub_field('pins') ? ' project-with-pin' : '';
              echo '<div class="project-image-outer'.$pin_class.'">';
                echo '<div class="project-image-content">';
                  echo '<div class="project-image">';
                    sandbox_image('image', 'large');
                  echo '</div>';

                  get_template_part('partials/pins');

                echo '</div>';
              echo '</div>';
            endwhile;
          endif;
        ?>
      </div>
    </div>
  </div>
<?php get_footer() ?>
</body>
</html>
