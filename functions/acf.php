<?php
// Custom gutenberg block category
function add_custom_gutenberg_category($categories){
    return array_merge($categories, array(
        array(
            'slug' => 'custom',
            'title' => __('Custom'),
        )
    ));
}
add_filter('block_categories', 'add_custom_gutenberg_category', 10, 2);

// Register ACF fields  
function my_acf_init() {
    // check function exists
    if( function_exists('acf_register_block') ) {
        acf_register_block([
            'name'              => 'columns',
            'title'             => __('Columns'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'custom',
            'icon'              => '<svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m21 4c0-.478-.379-1-1-1h-16c-.62 0-1 .519-1 1v16c0 .621.52 1 1 1h16c.478 0 1-.379 1-1zm-9.75.5v15h-6.75v-15zm1.5 0h6.75v15h-6.75z" fill-rule="nonzero"/></svg>',
            'keywords'          => ['columns'],
            'mode'              => 'preview',
            'supports'		=> [
                'align' => true, // true, false, full or wide 
                'jsx' 			=> true, //allows gutenberg blocks inside the custom acf block
                'color'	=> [
                    'text' => false
                ]
            ],
            'example'  => [
                'attributes' => [
                    'mode' => 'preview',
                    'data' => [
                        '_is_preview'   => 'true'
                    ]
                ]
           ],

        ]); 
        acf_register_block([
            'name'              => 'panel',
            'title'             => __('Panel'),
            'description'       => __('A panel to fill with content.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'custom',
            'parent'            => ['acf/row'],
            'icon'              => '<svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m21 4c0-.478-.379-1-1-1h-16c-.62 0-1 .519-1 1v16c0 .621.52 1 1 1h16c.478 0 1-.379 1-1zm-16.5.5h15v15h-15zm13.5 9c0-.276-.224-.5-.5-.5h-4c-.276 0-.5.224-.5.5v4c0 .276.224.5.5.5h4c.276 0 .5-.224.5-.5zm-10.061 1.99-1.218-1.218c-.281-.281-.282-.779 0-1.061s.78-.281 1.061 0l1.218 1.218 1.218-1.218c.281-.281.779-.282 1.061 0s.281.78 0 1.061l-1.218 1.218 1.218 1.218c.281.281.282.779 0 1.061s-.78.281-1.061 0l-1.218-1.218-1.218 1.218c-.281.281-.779.282-1.061 0s-.281-.78 0-1.061zm8.561-.99v2h-2v-2zm-7.5-8.5c1.656 0 3 1.344 3 3s-1.344 3-3 3-3-1.344-3-3 1.344-3 3-3zm9 5.25c0-.399-.353-.75-.75-.75-1.153 0-2.347 0-3.5 0-.397 0-.75.351-.75.75s.353.75.75.75h3.5c.397 0 .75-.351.75-.75zm-9-3.75c-.828 0-1.5.672-1.5 1.5s.672 1.5 1.5 1.5 1.5-.672 1.5-1.5-.672-1.5-1.5-1.5zm9 1.5c0-.399-.353-.75-.75-.75-1.153 0-2.347 0-3.5 0-.397 0-.75.351-.75.75s.353.75.75.75h3.5c.397 0 .75-.351.75-.75zm0-2.25c0-.399-.353-.75-.75-.75-1.153 0-2.347 0-3.5 0-.397 0-.75.351-.75.75s.353.75.75.75h3.5c.397 0 .75-.351.75-.75z" fill-rule="nonzero"/></svg>',
            'keywords'          => ['panel'],
            'mode'              => 'preview',
            'supports'		=> [
                'align' => 'full',
                'jsx' 			=> true, 
                'color'	=> [
                    'gradients' => false
                ]
            ],
        ]); 
        acf_register_block([
            'name'              => 'image',
            'title'             => __('Image'),
            'description'       => __(''),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'custom',
            'icon'              => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M14 9l-2.519 4-2.481-1.96-5 6.96h16l-6-9zm8-5v16h-20v-16h20zm2-2h-24v20h24v-20zm-20 6c0-1.104.896-2 2-2s2 .896 2 2c0 1.105-.896 2-2 2s-2-.895-2-2z"/></svg>',
            'keywords'          => ['image'],
            'mode'              => 'edit',
        ]);
        acf_register_block(array(
            'name'              => 'image-text',
            'title'             => __('Image and Text Block'),
            'description'       => __(''),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'custom',
            'icon'              => 'media-text',
            'keywords'          => ['media', 'text'],
            'mode'              => 'preview',
            'supports'		=> [
                'align' => true, 
                'jsx' 			=> true,
                'color'	=> [
                    'gradients' => false
                ]
            ],
            'example'  => [
                'attributes' => [
                    'mode' => 'preview',
                    'data' => [
                        '_is_preview'   => 'true'
                    ]
                ]
           ],
        )); 
        acf_register_block(array(
            'name'              => 'banner',
            'title'             => __('Banner'),
            'description'       => __(''),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'custom',
            'icon'              => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21 14l-1.003 4c-.555-1.086-1.33-2.031-2.251-2.806l3.249-4.594c1.138.98 2.198 2.124 3.005 3.4h-3zm-.096-5.008l-3.486 4.929c-1.521-1.136-3.38-1.862-5.418-1.862-2.037 0-3.915.692-5.427 1.849l-3.481-4.923c2.497-1.858 5.567-2.985 8.908-2.985 3.342 0 6.41 1.128 8.904 2.992zm-17.899 1.608c-1.138.981-2.198 2.124-3.005 3.4h3l1.003 4c.556-1.086 1.33-2.031 2.251-2.806l-3.249-4.594z"/></svg>',
            'keywords'          => ['banner'],
            'mode'              => 'preview',
            'supports'		=> [
                'align' => true, 
                'jsx' 			=> true,
                'color'	=> [
                    'gradients' => false
                ]
            ],
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