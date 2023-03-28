<?php
// Register ACF blocks from their json files
// note: glob() returns an array of filenames matching /blocks/whatever/blocks.json
function sjl_register_blocks() {
	foreach ( glob( get_stylesheet_directory() . "/blocks/*/block.json" ) as $file ) {
		register_block_type( $file );
	}
}
add_action( 'init', 'sjl_register_blocks' );

// required to conditionally load css
add_filter( 'should_load_separate_core_block_assets', '__return_true' );
// loads the css as it's own file rather than inline
add_filter( 'styles_inline_size_limit', '__return_zero' );

// block js
wp_register_script( 'testimonial-carousel-script', get_template_directory_uri() . '/blocks/testimonials/view.js');
wp_register_script( 'accordion-script', get_template_directory_uri() . '/blocks/accordion/view.js');

// register additional core block styles
register_block_style(
    'core/list',
    array(
        'name' => 'columns-2',
        'label' => __( '2 Columns', 'textdomain' )
	)
);


