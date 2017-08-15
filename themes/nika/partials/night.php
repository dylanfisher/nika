<div class="night-cover">
  <div class="moon night-moon-clone ib">
    <?php get_template_part('images/svg/'.$moon_phase_name.'.svg'); ?>
  </div>

  <div class="moon-page">
    <div class="moon-page-content">
      <div class="wrapper">
        <div class="huge-serif small-width">
          <?php echo 'Today, the Moon is ' . round( $moon->age() ) . ' days old. ' ?>
        </div>
        <div class="entry-content">
          <?php
            $moon_page = get_page_by_path('moon');
            $moon_content = $moon_page->post_content;
            $filtered_content = apply_filters( 'the_content', $moon_content );
            $filtered_content = str_replace( ']]>', ']]&gt;', $moon_content );
            echo '<div class="night-content">';
              echo $filtered_content;
            echo '</div>';
          ?>
        </div>

        <div class="time-and-date__line"></div>

        <div class="time-and-date">
          <div class="small-sans">
            <div><?php echo $phase_name; ?></div>
            <div class="screensaver-clock"></div> on
            <div class="screensaver-date"></div>
            <div>
              The next phase begins on
              <?php
                $next_moon_index = $acf_index;
                $next_moon_index++;
                if($next_moon_index > 7) $next_moon_index = 0;
                $next_moon_phase = $moon->phase_at($next_moon_index);
                $next_moon = sandbox_month_day_time($next_moon_phase);
                echo sandbox_month_day_time($moon->day_of_new_phase()) . '.';
              ?>
            </div>
            <br>
            <div class="small-width">
              <div class="small-sans">
                The lunar phase is the shape of the illuminated (sunlit) portion of the moon as seen by an observer on Earth.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="star-wrapper"></div>
  <div class="screensaver-date" id="screensaver-date"></div>
  <div class="screensaver-clock" id="screensaver-clock"></div>
</div>
