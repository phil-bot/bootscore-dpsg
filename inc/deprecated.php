<?php
/*** FEATURED IMAGE ***/

if (!function_exists('bootscore_post_thumbnail')) :
  /**
   * Displays an optional post thumbnail.
   *
   * Wraps the post thumbnail in an anchor element on index views, or a div
   * element when on single views.
   **/
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


/**********************************************************
 ADD GELLERY POST TYPE
**********************************************************/


/******************
 FUNCTIONS
******************/

/*** Add BootScore-Theme BADGE for post type gallery ***/

if (!function_exists('bootscore_category_badge')) : function bootscore_category_badge( $switch = null ) {
	// Hide category and tag text for pages.
	if ('post' === get_post_type() && $switch == null ) {
		echo '<div class="category-badge mb-2">';
		$thelist = '';
		$i = 0;
		foreach (get_the_category() as $category) {
			if (0 < $i) $thelist .= ' ';
			$thelist .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="badge bg-secondary text-white text-decoration-none">' . $category->name . '</a>';
			$i++;
		}
		echo $thelist;
		echo '</div>';
	}
	/** ADDED **/
	if ('gallery' === get_post_type()) echo '<div class="category-badge mb-2"><a href="' . get_post_type_archive_link( 'gallery' ) . '" class="badge bg-secondary text-white text-decoration-none">Fotos, Bilder und Videos</a></div>';
	} endif;


/******************
 HOOKS
******************/

/*** ADD POST TYPE: gallery. ***/

add_action( 'init', function() {
	$labels = [
		"name" => __( "Galerien", "bootscore" ),
		"singular_name" => __( "Galerie", "bootscore" ),
		"archives" => __( "Fotos, Bilder und Videos", "bootscore" ),
	];
	$args = [
		"label" => __( "Galerien", "bootscore" ),
		"labels" => $labels,
		"description" => "Hier findet ihr Fotos, Bilder und Videos von unseren zahlreichen Lagern, Aktionen & Gruppenstunden.",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "gallery", "with_front" => true ],
		"query_var" => true,
		"menu_position" => 20,
		"menu_icon" => "dashicons-format-gallery",
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields", "comments", "revisions", "author", "post-formats" ],
		"taxonomies" => [ "category", "post_tag" ],
		"show_in_graphql" => false,
	];
	register_post_type( "gallery", $args );
	});


/*** CUSOM ARCHIVE TITLE BASED ON CPT gallery ***/

add_filter( 'get_the_archive_title', function ($title) {
	if ( is_post_type_archive( 'gallery' ) ) $title = get_queried_object()->labels->archives;
	return $title;    
	});

/*** EDIT QUERYS ***/

add_filter('pre_get_posts', function ($query) {
	/*** ADD GALLERY POSTS TO FRONT PAGE ***/
	if ( $query->is_home && $query->is_main_query() ) $query-> set('post_type' ,array('post','gallery'));
	return $query;
	});
