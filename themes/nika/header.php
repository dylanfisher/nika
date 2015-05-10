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
 \  ,,/ |    \   D    .'  \
  `""`   \  nnh  D_.-'L__nnh
          `"""`

Website developed by Dylan Fisher
-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php wp_title( '-', true, 'right' ); echo esc_html( get_bloginfo('name'), 1 ) ?></title>
  <meta name="description" content="<?php echo get_bloginfo('description') ?>">
  <meta name="keywords" content="">
  <meta name="viewport" content="width=device-width">
  <link rel="icon" type="image/png" href="<?php echo get_bloginfo('template_url'); ?>/images/favicon.png">
  <link rel="stylesheet" type="text/css" href="<?php echo  bloginfo('stylesheet_url'); ?>" />
  <?php include(locate_template('partials/color_assignments.php')); ?>
  <script src="<?php echo get_bloginfo('template_url'); ?>/js/modernizr.custom.45797.js"></script>
  <?php wp_enqueue_script('jquery') // runs in noConflict mode ?>
  <?php wp_head() // For plugins ?>
</head>
<body <?php body_class('gradient') ?>>
  <!--[if lte IE 9]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
  <![endif]-->
  <div class="wrapper">
    <header class="relative center">
      <h1 class="site-title absolute absolute-left absolute-top">
        <a href="<?php bloginfo('url') ?>/" title="<?php echo esc_html( bloginfo('name'), 1 ) ?>" rel="home"><?php bloginfo('name') ?></a>
      </h1>
      <div class="moon ib">
        <a href="<?php echo home_url(); ?>">
          <?php get_template_part('images/svg/'.$moon_phase.'.svg'); ?>
        </a>
      </div>
      <h2 class="absolute absolute-right absolute-top">
        <a href="#Information">Information</a>
      </h2>
    </header>
