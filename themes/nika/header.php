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
  <meta name="keywords" content="nika simovich, graphic design, designer, new york, nyc">
  <link rel="icon" type="image/png" href="<?php echo get_bloginfo('template_url'); ?>/images/favicon.png">
  <?php include(locate_template('partials/color_assignments.php')); ?>
  <?php wp_head(); // For plugins ?>
</head>
<body <?php body_class('gradient'); ?>>
  <?php include(locate_template('partials/night.php')); // The moon page ?>
  <div class="wrapper">
    <div class="info-button" id="info-button">
      <?php get_template_part('images/svg/info_icon.svg'); ?>
    </div>
    <div class="moon ib" id="moon">
      <?php get_template_part('images/svg/'.$moon_phase_name.'.svg'); ?>
    </div>
