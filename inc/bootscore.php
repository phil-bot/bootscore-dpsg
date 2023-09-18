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
	
	/** ADD SLIDER TO FRONT PAGE **/
	if ( is_home() && !is_paged()  ) {
		$sticky = get_option( 'sticky_posts' );
		rsort( $sticky );
		$sticky = array_slice( $sticky, 0, 10 );
		$post_ids = implode(', ', $sticky);
		//echo '<div class="w-100 mt-n3">';
		echo '<div class="mt-2">';
		echo do_shortcode('[bs-swiper-hero type="post,gallery" id="' . $post_ids . '"]');
		echo '</div>';
	}
	/** ADD PAGINATION ON TOP WHEN PAGE 1+ **/
	if ( is_home() && is_paged()  ) {
		echo '<div class="mt-5">';
		bootscore_pagination();
		echo '</div>';
	}	
	/*** REMOVE BLOGINFO ON FRONT PAGE ***/
	if ( is_home() ) {
		// vergy ugly .. i know ...
		//echo '<style>main#main.site-main div.py-3.py-md-5.text-center { display:none; }</style>';
	}

	});


/*** DISABLE BS TEMPLATES FROM LIST ***/

function child_theme_disable_page_template( $post_templates, $theme, $post, $post_type ) {
    unset( $post_templates['page-templates/page-blank-without-container.php'] );
    unset( $post_templates['page-templates/page-sidebar-left.php'] );
    return $post_templates;
}
add_filter( 'theme_templates', 'child_theme_disable_page_template', 10, 4 );
	
	
/******************
 (OVERWRITE BS) FUNCTIONS
******************/

/*** PLAY WITH THE BREADCRUMB ***/

if (!function_exists('the_breadcrumb')) : function the_breadcrumb() {

	$divider = '<span class="divider">&nbsp;/&nbsp;</span>';
	
	// ON FRONTPAGE ONLY THE ICON
	if (!is_home() && !is_front_page() && !is_page_template( array( 'page-blank-without-container.php', 'page-blank-with-container.php' ) ) ) { 
		echo '<nav class="breadcrumb mb-4 mt-2 bg-light py-2 px-3 small rounded">';
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



/*** FEATURED IMAGE ***/

if (!function_exists('bootscore_post_thumbnail')) :
  /**
   * Displays an optional post thumbnail.
   *
   * Wraps the post thumbnail in an anchor element on index views, or a div
   * element when on single views.
   */
  function bootscore_post_thumbnail() {
  
    if ( is_page_template( array( 'page-without-thumbnail.php', 'page-sidebar-none-without-thumbnail.php' ) ) ) { return null; }
  
    if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
      return;
    }

    if (is_singular()) : ?>
	  <p class="lead"><?php echo get_the_excerpt(); ?></p>
      <div class="post-thumbnail">
        <?php the_post_thumbnail('full', array('class' => 'rounded mb-3')); ?>
      </div><!-- .post-thumbnail -->

    <?php else : ?>

      <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
        <?php
        the_post_thumbnail('post-thumbnail', array(
          'alt' => the_title_attribute(array(
            'echo' => false,
          )),
        ));
        ?>
      </a>

<?php
    endif; // End is_singular().
  }
endif;
// Featured Image End

/*** CATEGORY BADGE ***/

if (!function_exists('bootscore_category_badge')) :
	function bootscore_category_badge() {
	  // Hide category and tag text for pages.
	  if ('post' === get_post_type()) {
		echo '<p class="category-badge">';
		$thelist = '';
		$i       = 0;
		foreach (get_the_category() as $category) {
		  if (0 < $i) $thelist .= ' ';
		  $thelist .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="badge bg-secondary text-decoration-none">' . $category->name . '</a>';
		  $i ++;
		}
		echo $thelist;
		echo '</p>';
	  }
	}
  endif;
  // Category Badge End

?>
