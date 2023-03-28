<?php
/* Columns Block
 * Only contains ACF Column blocks
 * Can be added as a top level element.
*/
$allowed_blocks = ['acf/column'];
$template = [['acf/column'], ['acf/column'], ['acf/column']];

$className = 'block columns align--center';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
$width = get_field('width');
$className .= ' width--' . $width;

if (!empty($block['textColor'])) {
    $className .= ' has-text-color has-' . $block['textColor'] . '-color';
}
if (!empty($block['backgroundColor'])) {
    $className .= ' has-background has-' . $block['backgroundColor'] . '-background-color';
}
?>

<div class="<?php echo esc_attr($className); ?>">
    <?php echo '<InnerBlocks allowedBlocks="' . esc_attr(wp_json_encode($allowed_blocks)) . '" template="' . esc_attr(wp_json_encode($template)) . '" />'; ?>
</div>