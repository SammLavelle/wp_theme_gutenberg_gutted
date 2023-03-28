<?php
// Defines which blocks are available in the block editor sidebar
function sjl_allow_blocks( $allowed_blocks ) {
    $acf_blocks = array(
        'acf/section',
        'acf/image',
        'acf/text-area',
        'acf/button',
        'acf/media-text',
        'acf/columns',
        'acf/column',
        'acf/cards',
        'acf/card',
        'acf/panels',
        'acf/panel',
        'acf/testimonials',
        'acf/quote',
        'acf/cite',
        'acf/tabs',
        'acf/tab',
        'acf/tab-label',
        'acf/tab-content',
        'acf/accordion',
        'acf/accordion-label',
        'acf/accordion-content',
        'acf/check-list',
        'acf/icon-text'
    );

    // Core blocks which can be added can be found here: https://developer.wordpress.org/block-editor/reference-guides/core-blocks/
    $core_blocks = array(
        'core/heading',
        'core/paragraph',
        'core/list',
        'core/list-item',
        'core/table',
        'core/shortcode',
        // enables resuable blocks
        'core/block',
        'core/site-logo',
    );

    $all_blocks = array_merge($core_blocks, $acf_blocks);

	return $all_blocks;
}
add_filter( 'allowed_block_types', 'sjl_allow_blocks' );