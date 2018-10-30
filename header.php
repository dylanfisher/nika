<!DOCTYPE html>
<html class="no-js neutral">
<head>
  <meta charset="utf-8">
<!--
                          _
                        .' `'.__
                       /      \ `'"-,
      .-''''--...__..-/ .     |      \
    .'               ; :'     '.  a   |
   /                 | :.       \     =\
  ;                   \':.      /  ,-.__;.-;`
 /|     .              '--._   /-.7`._..-;`
; |       '                |`-'      \  =|
|/\        .   -' /     /  ;         |  =/
(( ;.       ,_  .:|     | /     /\   | =|
 ) / `\     | `""`;     / |    | /   / =/
   | ::|    |      \    \ \    \ `--' =/
  /  '/\    /       )    |/     `-...-`
 /    | |  `\    /-'    /;
 \  ,,/ |    \   D    .'  \                          ,-,
  `""`   \  nnh  D_.-'L__nnh                        /.(
          `"""`                                     \ {
                                                     `-`
Website developed by Dylan Fisher
-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php wp_title( '-', true, 'right' ); echo esc_html( get_bloginfo('name'), 1 ); ?></title>
  <meta name="description" content="<?php echo get_bloginfo('description'); ?>">
  <meta name="keywords" content="nika fisher, nika simovich, graphic design, designer, new york, nyc, labud">
  <link rel="icon" type="image/png" href="<?php echo get_bloginfo('template_url'); ?>/images/favicon.png">
  <?php include(locate_template('partials/color_assignments.php')); ?>
  <?php wp_head(); // For plugins ?>
</head>
<?php
  $body_class = '';
  if ( !is_single() ):
    $body_class = 'gradient';
  endif;
?>
<body <?php body_class( $body_class ); ?>>
  <?php include(locate_template('partials/night.php')); // The moon page ?>
  <div class="wrapper">
    <header class="header">
      <div class="site-max-width relative">
        <h1 class="text-left">
          <a href="<?php echo get_home_url(); ?>">
            <strong><?php echo get_bloginfo('name'); ?></strong>
          </a>
        </h1>
        <div class="info-button">
          <?php $info_page = get_page_by_path('information/'); ?>
          <a href="<?php echo get_permalink( $info_page ); ?>">
            <?php get_template_part('images/svg/info_icon.svg'); ?>
          </a>
        </div>
      </div>
    </header>
    <div class="moon ib" id="moon">
      <?php get_template_part('images/svg/'.$moon_phase_name.'.svg'); ?>
    </div>
