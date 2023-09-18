<?php


/******************
 HOOKS
******************/

/*** ADD BODY CLASSES ***/

add_filter('body_class', function ($classes) {

	// ADD CLASS WITH POST NAME TO BODY IF IS PAGE
	if ( is_page() ) {
		global $post;
		$classes[] = $post->post_type . '-' . $post->post_name;
	}

	return $classes;
});

/*** EDIT QUERYS ***/

add_filter('pre_get_posts', function ( $query ) {

	// REMOVE STICKY POSTS FROM FRONT PAGE 
	if ( $query->is_home && $query->query['ignore_sticky_posts'] === 2 ) $query->set( 'post__in', array(0) );

	return $query;
	});

/*** EDIT CONTENT ***/

add_filter( 'the_content', function ( $content ) {

	// ADD EMPTY PARAGRAPH FOR SPACING IF IS PAGE
	if ( is_page() && !is_page_template( array( 'page-templates/page-blank-without-container.php', 'page-templates/page-blank-with-container.php' ) ) ) ;//$content = '<p></p>' . $content;
	return $content;

	});

/*** SHORTDER EXCERPT LENGTH ***/

add_filter( 'excerpt_length', function ( $length ) {

	return 35;

	}, 999 );


?>
