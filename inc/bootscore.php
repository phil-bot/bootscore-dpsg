<?php

/******************
 HOOKS
******************/

/*** OFFICIAL BOOTSCORE AFTER PRIMARY HOOK ***/

add_action('bs_after_primary', function () {
	
	/** ADD BREADCRUMB ON ALL PAGES (single posts already contain this in the template) **/
	$templates_without_breadcrumb = array (
	  'page-templates/page-blank.php',
	  'page-templates/page-full-width-image.php'
	);
	if ( !is_single() && !is_page_template($templates_without_breadcrumb) ){
		the_breadcrumb();
	}

	/** ADD CAROUSEL/SWIPER TO FRONT PAGE **/
	if ( is_home() && !is_paged() && get_theme_option('swiper') == "true" && dpsg_is_plugin_active( 'bs-swiper-main/main.php' )) {
		$sticky = get_option( 'sticky_posts' );
		rsort( $sticky );
		$sticky = array_slice( $sticky, 0, 10 );
		$post_ids = implode(', ', $sticky);
		echo '<div class="mt-2">';
		echo do_shortcode('[bs-swiper-hero type="post" id="' . $post_ids . '"]');
		echo '</div>';
	}

	/** ADD PAGINATION ON TOP WHEN PAGE 1+ **/
	if ( is_home() && is_paged()  ) {
		echo '<div class="mt-5">';
		bootscore_pagination();
		echo '</div>';
	}

});


/*** DISABLE BS TEMPLATES FROM LIST ***/

if (!function_exists('child_theme_disable_page_template')) : function child_theme_disable_page_template( $post_templates, $theme, $post, $post_type ) {
    unset( $post_templates['page-templates/page-blank-without-container.php'] );
    unset( $post_templates['page-templates/page-sidebar-left.php'] );
    return $post_templates;
}
add_filter( 'theme_templates', 'child_theme_disable_page_template', 10, 4 );
endif;

/******************
 (OVERWRITE BS) FUNCTIONS
******************/

/*** PLAY WITH THE BREADCRUMB ***/

if (!function_exists('the_breadcrumb')) : function the_breadcrumb() {

	$divider = '<span class="divider">&nbsp;/&nbsp;</span>';
	
	// ON FRONTPAGE ONLY THE ICON
	if (!is_home() && !is_front_page() && !is_page_template( array( 'page-blank-without-container.php', 'page-blank-with-container.php' ) ) ) { 
		echo '<nav class="breadcrumb mb-4 mt-2 bg-light py-2 px-3 small d-block rounded text-nowrap overflow-auto">';
		echo '<a href="' . home_url('/') . '">' . ('<i class="dpsgi dpsgi-zelt"></i>') . '</a>' . $divider;
	
		// ON CATEGORY "Categories"
		if (is_category()) {
			_e('Categories');
		
		// ON ARCHIVE DISPLAY POST TYPE
		} elseif (is_archive()) {
			$obj = get_post_type_object( get_post_type() );
			echo $obj->labels->name;
		
		// ON SINGLE DISPLAY POST TYPE AND TITLE
		} elseif (is_single()) {
			$obj = get_post_type_object( get_post_type() );
			if ( $obj->has_archive == 1 ) {
				echo '<a href="' . home_url('/' . $obj->rewrite['slug'] ) . '">'.$obj->labels->name.'</a>' . $divider;
			} else {
				echo $obj->labels->name . $divider;
			}
			the_title();
		
		// ON PAGE DISPLAY PARENTS AND TITLE
		} elseif (is_page()) {
			global $post;
			$ancestors_list = implode( ',' , get_post_ancestors( $post ) );
			$ancestors_html = str_replace("\n", "", wp_list_pages('include='.$ancestors_list.'&title_li=&depth=-1&echo=0' ));
			$parent_list = str_replace(array('<li','</li>'),array('<span', '</span>' . $divider),$ancestors_html);
			if ($post->post_parent) echo $parent_list;
				echo get_the_title();
			}
			echo '</nav>';
	}
	
} endif;

?>
