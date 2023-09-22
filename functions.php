<?php

// style and scripts
add_action('wp_enqueue_scripts', 'bootscore_child_enqueue_styles');
function bootscore_child_enqueue_styles() {

  // style.css
  wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

  // Compiled main.css
  $modified_bootscoreChildCss = date('YmdHi', filemtime(get_stylesheet_directory() . '/css/main.css'));
  wp_enqueue_style('main', get_stylesheet_directory_uri() . '/css/main.css', array('parent-style'), $modified_bootscoreChildCss);

}

// custom.js as last one
function dpsg_load_script_last() {
  wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/js/custom.js', false, '', true);
  wp_localize_script('custom-js', 'dpsg_theme_options', get_option('dpsg_theme_options'));
}
add_action( 'wp_enqueue_scripts', 'dpsg_load_script_last', 99999 );


// custom-logo support
add_action( 'after_setup_theme', function(){
  $defaults = array(
    'height'               => 78,
    'flex-height'          => true,
    'flex-width'           => true,
    'header-text'          => array( 'site-title', 'site-description' ),
    'unlink-homepage-logo' => false
  );
  add_theme_support( 'custom-logo', $defaults );
});

/** ADD CSS & JS TO GUTENBERG EDITOR + ADD GUTENBERG BLOCKS**/
include_once('inc/gutenberg.php');

/** EDIT SOME BOOTSCORE FUNCTIONS **/
include_once('inc/bootscore.php');

/** ADD CUSTOM FUNCTIONS **/
include_once('inc/custom.php');

/** ADD CUSTOM SHORTCODES **/
include_once('inc/shortcode.php');

/** ADD THEME OPTIONS **/
include_once('inc/options.php');