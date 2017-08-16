<?php get_header() ?>
  <?php the_post() ?>
  <div class="content">
    <div id="post-<?php the_ID() ?>" <?php post_class() ?>>
      <header class="project-header">
        <div class="project-header__title-area entry-content text-left">
          <div class="project-header__year-and-title">
            <div class="project-header__year">
              <div class="project-header__year__number large-sans">
                <strong><?php the_field( 'year' ); ?></strong>
              </div>
            </div>
            <div class="project-header__title">
              <h1 class="project-header__title-label huge-serif"><?php the_title() ?></h1>
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
              <?php
                if ( get_field('project_link') ):
                  echo '<div class="project-header__project-link small-serif">';
                    echo '<a href="' . get_field('project_link') . '">';
                      echo get_field('project_link_label') ? get_field('project_link_label') : get_field('project_link');
                    echo '</a>';
                  echo '</div>';
                endif;
              ?>
            </div>
          </div>
        </div>
      </header>
      <div class="site-max-width">
        <?php
          if ( have_rows( 'modules' ) ):
            echo '<div class="modules">';
              while ( have_rows( 'modules' ) ) : the_row();
                echo '<div class="module module-type--' . get_row_layout() . '">';
                  get_template_part( 'partials/modules/' . get_row_layout() );
                echo '</div>';
              endwhile;
            echo '</div>';
          endif;
        ?>

        <?php
          if ( get_field('additional_info') ):
            echo '<div class="entry-content text-left">';
              echo '<div class="project__additional-info-title medium-sans-caps">';
                echo 'CREDITS';
              echo '</div>';
              echo '<div class="project__additional small-serif">';
                echo get_field('additional_info');
              echo '</div>';
            echo '</div>';
          endif;
        ?>
      </div>
    </div>
  </div>
<?php get_footer() ?>
</body>
</html>
