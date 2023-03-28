<?php
/* Column Block
 * Can only be added as a child of ACF Columns Block
 * Styles can be defined using ACF fields
*/
$allowed_blocks = ['acf/image', 'core/heading', 'core/paragraph',  'core/list', 'acf/button', 'acf/quote', 'acf/icon-text' ];
$template = [
    ['core/heading', [
        'level' => 2,
        'placeholder' => 'Title Goes Here',
    ]],
    ['core/paragraph', [
        'placeholder' => 'Main Content Goes Here',
    ]],
];


$className = 'panel';

if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

if (!empty($block['textColor'])) {
    $className .= ' has-text-color has-' . $block['textColor'] . '-color';
}

if (!empty($block['backgroundColor'])) {
    $className .= ' has-background has-' . $block['backgroundColor'] . '-background-color';
}

?>

<div class="<?php echo esc_attr($className); ?>">
    <div class="panel__inner">
        <?php echo '<InnerBlocks allowedBlocks="' . esc_attr(wp_json_encode($allowed_blocks)) . '" template="' . esc_attr(wp_json_encode($template)) . '" templateLock="false" />'; ?>
    </div>  
</div>