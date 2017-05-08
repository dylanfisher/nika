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
<body <?php body_class('gradient') ?>>
  <?php include(locate_template('partials/night.php')); // The moon page ?>
  <div class="wrapper">
    <header class="relative center">
      <h1 class="site-title absolute absolute-left absolute-top large-sans">
        <a href="<?php bloginfo('url') ?>/" rel="home"><?php bloginfo('name') ?></a>
      </h1>
      <?php if ( is_front_page() ): ?>
        <div class="header__description huge-sans">
          <?php echo get_bloginfo('description'); ?>
        </div>
      <?php endif; ?>
      <h2 class="absolute absolute-right absolute-top large-sans">
        <a href="<?php echo get_the_permalink(get_page_by_path('information')); ?>">Information</a>
      </h2>
    </header>
    <?php if(!is_front_page()) { echo '<a href="'.get_home_url().'">'; } ?>
      <div class="moon ib" id="moon">
        <?php get_template_part('images/svg/'.$moon_phase_name.'.svg'); ?>
      </div>
    <?php if(!is_front_page()) { echo '</a>'; } ?>
