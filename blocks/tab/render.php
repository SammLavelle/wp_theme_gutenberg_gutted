<?php
$allowed_blocks = ['acf/tab-label', 'acf/tab-content'];
$template = [
    ['acf/tab-label'], 
    ['acf/tab-content']
];

$className = 'tab';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
?>

<div class="<?php echo esc_attr($className); ?>">
    <?php echo '<InnerBlocks allowedBlocks="' . esc_attr(wp_json_encode($allowed_blocks)) . '" template="' . esc_attr(wp_json_encode($template)) . '" templateLock="true" />'; ?>
</div>