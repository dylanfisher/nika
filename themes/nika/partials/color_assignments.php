<?php
  $moon = new Solaris\MoonPhase();

  function getAcfIndex($name, $array){
    foreach($array as $key => $value){
      if(is_array($value) && $value['acf_fc_layout'] == $name)
        return $key;
    }
    return null;
  }

  $phase_names = array(
    'New Moon' => 'moon_1',
    'Waxing Crescent' => 'moon_2',
    'First Quarter' => 'moon_3',
    'Waxing Gibbous' => 'moon_4',
    'Full Moon' => 'moon_5',
    'Waning Gibbous' => 'moon_6',
    'Third Quarter' => 'moon_7',
    'Waning Crescent' => 'moon_8'
  );

  $phase_name = $moon->phase_name();
  $acf_phases = get_field('phases', 'option');
  $moon_phase = $phase_names[$phase_name];

  $acf_index = getAcfIndex($moon_phase, $acf_phases);
  $phase_assignment = $acf_phases[$acf_index];

  $neutral = $phase_assignment['neutral_color'];
  $accent = $phase_assignment['accent_color'];
  $direction = $phase_assignment['gradient_direction'];
  $direction = $direction == 'horizontal' ? 'left' : 'top';

  $colors = $phase_assignment['gradient_colors'];
  $colors = array_map(function($c){
    return $c['color'].' '.$c['color_position'].'%';
  }, $colors);
  $colors = implode($colors, ', ');
?>

<style type="text/css">
  /* Moon phase: <?php echo $phase_name; ?> */

  .neutral                 { background-color: <?php echo $neutral; ?>; }
  .accent-background       { background-color: <?php echo $accent; ?>; }
  .accent                  { color: <?php echo $accent; ?>; }
  a                        { border-color: <?php echo $accent; ?>; }
  a:hover                  { color: <?php echo $accent; ?>; }
  a:hover:before           { background: <?php echo $accent; ?> !important; }
  .entry-content a,
  .sidebar a               { border-color: <?php echo $accent; ?>; }

  ::-moz-selection         { background: <?php echo $accent; ?>; }
  ::selection              { background: <?php echo $accent; ?>; }

  .gradient {
    background: #939393;
    background: <?php echo $neutral ?>;
    background: -moz-linear-gradient(<?php echo $direction; ?>, <?php echo $colors; ?>);
    background: -webkit-linear-gradient(<?php echo $direction; ?>, <?php echo $colors; ?>);
    background: -o-linear-gradient(<?php echo $direction; ?>, <?php echo $colors; ?>);
    background: -ms-linear-gradient(<?php echo $direction; ?>, <?php echo $colors; ?>);

    <?php if($direction == 'left'){ ?>
      background: linear-gradient(to right, <?php echo $colors; ?>);
    <?php } else { ?>
      background: linear-gradient(to bottom, <?php echo $colors; ?>);
    <?php } ?>
  }
</style>
