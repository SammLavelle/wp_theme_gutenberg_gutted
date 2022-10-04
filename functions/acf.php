<?php

// Custom gutenberg block category
 function add_custom_gutenberg_category($categories){
    return array_merge($categories, array(
        array(
            'slug' => 'bamboo_nine',
            'title' => __('Bamboo Nine', 'bamboo_nine'),
            'icon' => 'null'
        )
    ));
}
add_filter('block_categories', 'add_custom_gutenberg_category', 10, 2);

// Register ACF fields  
function my_acf_init() {
    // check function exists
    if( function_exists('acf_register_block') ) {
        // register an accordion block
        acf_register_block(array(
            'name'              => 'sample',
            'title'             => __('Sample Block'),
            'description'       => __('Just a sample, delete it when you\'re ready.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'bamboo_nine',
            'icon'              => 'align-center',
            'keywords'          => array( 'sample'),
            'mode'              => 'preview',
            'supports'		=> [
                'align' => true, // full or wide 
                'jsx' 			=> true, //allows gutenberg blocks inside the custom acf block
                'color'	=> [
                    'gradients' => false
                ]
            ]
        )); 
    }
}
add_action('acf/init', 'my_acf_init');  

//render ACF fields
function my_acf_block_render_callback( $block ) {
    // convert name ("acf/testimonials") into path friendly slug ("testimonials")
    $slug = str_replace('acf/', '', $block['name']);
    // include a template part from within the "template-parts/block" folder
    if( file_exists( get_theme_file_path("/blocks/block-{$slug}.php") ) ) {
        include( get_theme_file_path("/blocks/block-{$slug}.php") );
    }
}