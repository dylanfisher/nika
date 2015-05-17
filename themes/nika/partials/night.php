<div class="night-cover">
  <div class="moon-page">
    <div class="moon-page-content">
      <div class="wrapper">
        <div class="small-sans time-and-date">
          <div class="screensaver-clock"></div> on
          <div class="screensaver-date"></div>
        </div>
        <p><?php echo $phase_name; ?></p>
        <p>Next new moon begins on<br>
          <?php $next_moon = $moon->next_new_moon(); ?>
          <?php echo date('F j g:ia', $next_moon); ?>
        </p>
        <?php
          $moon_page = get_page_by_path('moon');
          $moon_content = $moon_page->post_content;
          $filtered_content = apply_filters( 'the_content', $moon_content );
          $filtered_content = str_replace( ']]>', ']]&gt;', $moon_content );
          echo $filtered_content;
        ?>
      </div>
    </div>
  </div>
  <div class="star-wrapper"></div>
  <div class="screensaver-date" id="screensaver-date"></div>
  <div class="screensaver-clock" id="screensaver-clock"></div>
</div>
