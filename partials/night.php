<div class="night-cover">
  <div class="moon night-moon-clone ib">
    <?php get_template_part('images/svg/'.$moon_phase_name.'.svg'); ?>
  </div>

  <div class="moon-page">
    <div class="moon-page-content">
      <div class="wrapper">
        <div class="site-max-width">
          <div class="xhuge-serif medium-width text-center">
            <?php echo 'Today, the moon is ' . round( $moon->age() ) . ' days old. ' ?>
          </div>

          <div class="large-sans">
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

          <div class="row">
            <div class="col-3">
              <div class="time-and-date">
                <div class="small-sans">
                  <div class="small-title">Luna</div>
                  <div><?php echo $phase_name; ?></div>
                  <div class="screensaver-clock"></div> on
                  <div class="screensaver-date"></div>
                  <p>
                    The next phase begins on
                    <?php
                      $next_moon_index = $acf_index;
                      $next_moon_index++;
                      if($next_moon_index > 7) $next_moon_index = 0;
                      $next_moon_phase = $moon->phase_at($next_moon_index);
                      $next_moon = sandbox_month_day_time($next_moon_phase);
                      echo sandbox_month_day_time($moon->day_of_new_phase()) . '.';
                    ?>
                  </p>
                  <p class="small-width">
                    <div class="small-sans">
                      The lunar phase is the shape of the illuminated (sunlit) portion of the moon as seen by an observer on Earth.
                    </div>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-3">
              <div class="small-title">Credits</div>
              <div class="small-sans">
                This website was designed by Nika Simovich and programmed by <a href="http://dylanfisher.com/" target="_blank">Dylan Fisher</a>.
              </div>
            </div>
            <div class="col-3">
              <div class="small-title">Typography</div>
              <div class="small-sans">
                Venus by Bauer Type Foundry and Electra by William Addison Dwiggins. Both are available through linotype.
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
