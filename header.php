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
  <meta name="msapplication-TileColor" content="#003056">
  <meta name="theme-color" content="#003056">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    
  <?php wp_body_open(); ?>

  <div id="page" class="site main">

    <!-- Top Header - configurable with Customizer -->
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
    </header><!-- #Top Header -->

    <!-- Top Nav Search Mobile Collapse -->
    <nav id="nav-main" class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">

      <div class="<?= bootscore_container_class(); ?>">

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
              'items_wrap' => '<ul id="bootscore-navbar" class=" navbar-nav %2$s">%3$s</ul>',
              'depth' => 4,
              'walker' => new bootstrap_5_wp_nav_menu_walker()
              // ms-auto
            ));
            ?>
          
            <!-- Top Nav Search Mobile Collapse -->
            <?php if (is_active_sidebar('top-nav-search')) : ?>
              <div class="d-lg-none bg-light mx-n3 p-3 mt-3 ">
                <?php dynamic_sidebar('top-nav-search'); ?>
              </div>
            <?php endif; ?>

            <!-- Top Nav Widget -->
            <?php if (is_active_sidebar('top-nav-2')) : ?>
              <div class="d-lg-none bg-light m-n3 p-3 h-100 d-block">
                <?php dynamic_sidebar('top-nav-2'); ?>
              </div>
            <?php endif; ?>
          
          </div>
        </div>

        <div class="header-actions d-flex align-items-center">

          <!-- Top Nav 2 Widget -->
          <?php if (is_active_sidebar('top-nav')) : ?>
            <div class="d-lg-flex d-none">
              <?php dynamic_sidebar('top-nav'); ?>
                  </div>
          <?php endif; ?>

          <!-- Navbar Toggler -->          
          <button class="btn btn-outline-light d-lg-none ms-1 ms-md-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-navbar" aria-controls="offcanvas-navbar">
            <i class="fas fa-bars"></i>
          </button>
        </div><!-- .header-actions -->

      </div><!-- .container -->

    </nav><!-- #Top Nav -->
        
    <!-- Search Button Modal -->
    <div class="modal fade" id="modal-search" tabindex="-1" aria-labelledby="search" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Was suchst du?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body"><?php get_search_form(); ?></div>
        </div>
      </div>
    </div>