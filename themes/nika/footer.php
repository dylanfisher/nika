</div><!-- .wrapper -->

<footer class="footer small-sans">
  <?php
    global $moon_phase_name;
    for ( $i=1; $i <= 8; $i++ ):
      $active_class = '';
      if ( $moon_phase_name == 'moon_' . $i ):
        $active_class = 'moon-icon-active';
      endif;
      echo '<div class="moon-icon-wrapper ' . $active_class . '">';
        get_template_part('images/svg/moon_icon_' . $i . '.svg');
      echo '</div>';
    endfor;
  ?>

  <ul class="footer__static-links">
    <li>
      <a class="website-info-link" href="#">About this Website</a>
    </li>
  </ul>
  <?php wp_nav_menu(); ?>
</footer>

<script>
  (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
  function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
  e=o.createElement(i);r=o.getElementsByTagName(i)[0];
  e.src='https://www.google-analytics.com/analytics.js';
  r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
  ga('create','UA-38555480-1','auto');ga('send','pageview');
</script>
<?php wp_footer() ?>
