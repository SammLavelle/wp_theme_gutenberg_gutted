<?php

$allowed_blocks = ['core/list-item'];
$template = [['core/list-item']];

$className = 'check-list';
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

<ul class="<?php echo esc_attr($className); ?>">
    <?php echo '<InnerBlocks allowedBlocks="' . esc_attr(wp_json_encode($allowed_blocks)) . '" template="' . esc_attr(wp_json_encode($template)) . '" />'; ?>
</ul>