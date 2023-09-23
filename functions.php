<?php

// style and scripts
add_action('wp_enqueue_scripts', function() {
  // style.css
  wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
  // Compiled main.css
  $modified_bootscoreChildCss = date('YmdHi', filemtime(get_stylesheet_directory() . '/css/main.css'));
  wp_enqueue_style('main', get_stylesheet_directory_uri() . '/css/main.css', array('parent-style'), $modified_bootscoreChildCss);

  });

// pre.js as first one
add_action( 'wp_enqueue_scripts', function() {
  wp_enqueue_script('custom-pre-js', get_stylesheet_directory_uri() . '/js/pre.js', false, '', true);
  wp_localize_script('custom-pre-js', 'dpsg_theme_options', get_option('dpsg_theme_options'));
  }, 0 );

// after.js as last one
add_action( 'wp_enqueue_scripts', function() {
  wp_enqueue_script('custom-after-js', get_stylesheet_directory_uri() . '/js/after.js', false, '', true);
  wp_localize_script('custom-after-js', 'dpsg_theme_options', get_option('dpsg_theme_options'));
  }, 99999 );

// custom-logo support
add_action( 'after_setup_theme', function(){
  add_theme_support( 'custom-logo', array(
    'height'               => 78,
    'flex-height'          => true,
    'flex-width'           => true,
    'header-text'          => array( 'site-title', 'site-description' ),
    'unlink-homepage-logo' => false
    ));
  });

/** ADD CSS & JS TO GUTENBERG EDITOR + ADD GUTENBERG BLOCKS**/
include_once(get_stylesheet_directory_uri() . '/inc/gutenberg.php');

/** ADD THEME CLASSES **/
include_once(get_stylesheet_directory_uri() . '/inc/classes.php');

/** EDIT SOME BOOTSCORE FUNCTIONS **/
include_once(get_stylesheet_directory_uri() . '/inc/bootscore.php');

/** ADD CUSTOM FUNCTIONS **/
include_once(get_stylesheet_directory_uri() . '/inc/custom.php');

/** ADD CUSTOM SHORTCODES **/
include_once(get_stylesheet_directory_uri() . '/inc/shortcode.php');

/** ADD THEME OPTIONS **/
include_once(get_stylesheet_directory_uri() . '/inc/options.php');