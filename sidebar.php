<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bootscore
 * @version 5.3.3
 */


// Exit if accessed directly
defined( 'ABSPATH' ) || exit;


if (!is_active_sidebar('sidebar-1')) {
  return;
}

/* this file exitsts to dismiss the offcanvas menu for the sidebar */
?>
<div class="col-md-4 col-lg-3 order-lg-last">
  <aside id="secondary" class="widget-area">
      <div class="flex-column">
        <?php dynamic_sidebar('sidebar-1'); ?>
      </div>
    </div>
  </aside><!-- #secondary -->
</div>
