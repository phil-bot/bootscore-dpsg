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