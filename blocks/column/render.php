<?php
/* Column Block
 * Can only be added as a child of ACF Columns Block
 * Styles can be defined using ACF fields
*/
$allowed_blocks = ['acf/image', 'core/heading', 'core/paragraph',  'core/list', 'acf/check-list', 'acf/button', 'acf/quote', 'core/shortcode','acf/icon-text' ];
$template = [
    ['core/heading', [
        'level' => 2,
        'placeholder' => 'Title Goes Here',
    ]],
    ['core/paragraph', [
        'placeholder' => 'Main Content Goes Here',
    ]],
];

$className = 'column';

if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

?>

<div class="<?php echo esc_attr($className); ?>">
    <?php echo '<InnerBlocks allowedBlocks="' . esc_attr(wp_json_encode($allowed_blocks)) . '" template="' . esc_attr(wp_json_encode($template)) . '" templateLock="false" />'; ?>
</div>