<?php

function sjl_enqueue_scripts_styles(){

	// Remove Gutenberg native stylesheets
	wp_dequeue_style( 'wc-blocks-style' );
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );

	// Add custom stylesheets
	wp_enqueue_style( 'sjl-style', get_template_directory_uri() . '/assets/css/style.min.css' );

	// Add custom scripts (handle, src, dependencies, version, output in footer)
	wp_enqueue_script( 'sjl-functions', get_template_directory_uri() . '/assets/functions.js', array(), '1.0.0', true );
	
}
add_action( 'wp_enqueue_scripts', 'sjl_enqueue_scripts_styles' );