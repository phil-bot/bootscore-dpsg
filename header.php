<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bootscore
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/site.webmanifest">
  <link rel="mask-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon/safari-pinned-tab.svg" color="#0d6efd">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    
  <?php wp_body_open(); ?>

  <div id="to-top"></div>

  <div id="page" class="site main">

    <header id="masthead" class="site-header"> 
        <div class="head-main">
          <div class="container">
            <div class="d-flex flex-wrap image justify-content-center justify-content-lg-start">
              <?php if ( has_custom_logo() ): ?>
		      		<div class="logo my-3">
		        		<?php the_custom_logo(); ?>
		     			</div><!-- #logo -->
              <?php endif; ?>
		     			<?php if ( get_theme_mod('header_text') == "1" ): ?>
		      		<div class="m-3 align-self-center">
								<h1 class="display-6 m-0"><?php bloginfo('name'); ?></h1>
								<p class="lead m-0"><?php bloginfo('description'); ?></p>
						  </div><!-- #title-description -->
						  <?php endif; ?>
				    </div>
				  </div>
        </div>
    </header><!-- #masthead -->

    <nav id="nav-main" class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">

      <div class="container">

        <a class="navbar-brand m-0 p-0 me-2" href="<?php echo esc_url( home_url( '/' ) ); ?>" data-bs-toggle="tooltip" title="<?php bloginfo('description'); ?>">
          <i class="dpsgi dpsgi-lilie d-inline-flex me-1 fs-2 align-middle"></i>
          <?php if ( get_theme_mod('header_text') != "1" ): ?>
          <div class="d-inline-flex fw-lighter text-wrap align-middle"><?php bloginfo('name'); ?></div>
          <?php endif; ?>
        </a><!-- #lilie-logo -->

        <!-- Offcanvas Navbar -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas-navbar">
          <div class="offcanvas-header bg-light">
            <span class="h5 mb-0"><?php esc_html_e('Menu', 'bootscore'); ?></span>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <!-- Bootstrap 5 Nav Walker Main Menu -->
            <?php
            wp_nav_menu(array(
              'theme_location' => 'main-menu',
              'container' => false,
              'menu_class' => 'text-nowrap',
              'fallback_cb' => '__return_false',
              'items_wrap' => '<ul id="bootscore-navbar" class="navbar-nav %2$s">%3$s</ul>',
              'depth' => 4,
              'walker' => new bootstrap_5_wp_nav_menu_walker()
              // ms-auto
            ));
            ?>
            <!-- Bootstrap 5 Nav Walker Main Menu End -->
          
          <!-- Top Nav Widget -->
        <div class="my-1 mt-3 mt-lg-0 d-flex align-items-center">
          <div class="top-nav-widget mx-auto">
            <?php if (is_active_sidebar('top-nav')) : ?>
              <div>
                <?php dynamic_sidebar('top-nav'); ?>
              </div>
            <?php endif; ?>
          </div>

          </div>
          
          </div>
        </div>


        <div class="header-actions d-flex align-items-center">


          <!-- Navbar Toggler -->
          <!--<button class="navbar-toggler collapsed" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-navbar"" aria-controls="offcanvas-navbar" aria-label="Menu öffnen">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" class="bi" fill="currentColor" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"></path>
            </svg>
          </button>
            -->
          <button class="btn btn-outline-light d-lg-none ms-1 ms-md-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-navbar" aria-controls="offcanvas-navbar">
            <i class="fas fa-bars"></i>
          </button>
        </div><!-- .header-actions -->

      </div><!-- .container -->

    </nav><!-- .navbar -->
        

    <!-- Top Nav Search Mobile Collapse -->
    <div class="modal fade" id="modal-search" tabindex="-1" aria-labelledby="search" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Was suchst du?</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <?php get_search_form(); ?>
            </div>
          </div>
        </div>
    </div>