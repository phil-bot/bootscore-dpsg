<?php

/******************
 add custom js to gutenberg
******************/

add_action( 'enqueue_block_editor_assets', function() {

	// add editor.js to gutenberg editor
	wp_enqueue_script('myguten-script', get_stylesheet_directory_uri() . '/js/editor.js', array( 'wp-blocks','wp-editor' ) );

	} );

/******************
 add bootstrap css to gutenberg
******************/
add_action( 'after_setup_theme', function(){
    
	add_theme_support( 'editor-styles' );
	add_editor_style( get_stylesheet_directory_uri() . '/style.css' );
	add_editor_style( get_stylesheet_directory_uri() . '/css/lib/bootstrap.min.css' );

	});


/******************
 GUTENBERG BLOCKS
******************/

add_action( 'init', function() {
	register_block_pattern(
		'dpsg-theme/bs-card',
		[
			'title' => __( 'Bootstrap Card' ),
			'categories' => [ 'DPSG Theme' ],
			'content' => '<!-- wp:group -->
				<div class="wp-block-group"><!-- wp:column {"className":"aligncenter card"} -->
				<div class="wp-block-column aligncenter card"><!-- wp:image {"sizeSlug":"medium","linkDestination":"none","className":"card-img-top"} -->
				<figure class="wp-block-image size-medium card-img-top"><img alt=""/></figure>
				<!-- /wp:image -->
				<!-- wp:column {"className":"card-body"} -->
				<div class="wp-block-column card-body"><!-- wp:heading {"level":5,"className":"card-title"} -->
				<h5 class="card-title">Card title</h5>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"className":"card-text"} -->
				<p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
				<!-- /wp:paragraph --></div>
				<!-- /wp:column --></div>
				<!-- /wp:column --></div>
				<!-- /wp:group -->',
		]
	);
} );

add_action( 'init', function() {
	register_block_pattern_category(
		'dpsg-theme',
		[ 'label' => __( 'DPSG Theme', 'krautpress-block-pattern' ) ]
	);
} );
/*add_action( 'init', function () {



/*
	register_block_pattern(
		'dpsg-theme/bs-card',
		array(
			'title'       => 'Bootstrap Card',
			'content'     =>
          
          ,
          
          
          

		)
	);
  



	});*/


