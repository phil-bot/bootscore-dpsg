<?php

/*** DPSG ICONS ***/

function get_dpsgi( $icon = '', $classes = '' ) {

	if ( isset( $icon ) ) $icon = '<i class="dpsgi dpsgi-' . $icon . ' ' . $classes . '"></i>';
	return $icon;
	}


/*** SHORTCODES ***/

add_shortcode('bs-childs', function ( $atts ) {

	$child = 'hallo' . ' hallo';

	return $child;
	});

add_shortcode('bs-button', function ( $atts ) {

	return '<a href="' . $atts['link'] . '" class="btn ' . $atts['classes'] . '">' . $atts['text'] . get_dpsgi($atts['icon'], 'ms-2') . '</a>';
	});

add_shortcode('bs-grid-childs', function ( $atts ) {

	return do_shortcode('[bs-grid type="' . get_post_type() . '" post_parent="' . get_the_ID() . '" order="ASC" orderby="menu_order"]');
	});

add_shortcode('bs-list-childs', function ( $atts ) {

	return do_shortcode('[bs-list type="' . get_post_type() . '" post_parent="' . get_the_ID() . '" order="ASC" orderby="menu_order"]');
	});

add_shortcode('bs-swiper-card-childs', function ( $atts ) {

	return do_shortcode('[bs-swiper-card type="' . get_post_type() . '" post_parent="' . get_the_ID() . '" order="ASC" orderby="menu_order"]');
	});



?>