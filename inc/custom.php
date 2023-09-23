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
	if ( $query->is_home && $query->query['ignore_sticky_posts'] === 2 && get_theme_option('swiper') == "true") $query->set( 'post__in', array(0) );
	return $query;

	});

/*** SHORTDER EXCERPT LENGTH ***/

add_filter( 'excerpt_length', function ( $length ) {

	return 35;

	}, 999 );

/******************
 FUNCTIONS
******************/

/*** IS PLUGIN ACTIVE ***/

function dpsg_is_plugin_active($plugin){
	if(in_array($plugin, apply_filters('active_plugins', get_option('active_plugins')))) return true;
	}

/*** URL-KUERZUNG ***/

function dpsg_short_url($url, $length = 100) {
	$url = parse_url(trim($url));
	$furl = array_filter(explode('/', $url['path']));
	if(count($furl) > 1) $u = '../';
	$url['path'] = $u.array_pop($furl);
	$ausgabe = $url['scheme'].'://'.$url['host'].'/'.$url['path'];
	print substr($ausgabe, 0, $length);
	}


/*** DPSG ICONS ***/

function get_dpsgi( $icon = '', $classes = '' ) {
	if ( isset( $icon ) ) $icon = '<i class="dpsgi dpsgi-' . $icon . ' ' . $classes . '"></i>';
	return $icon;
	}

?>