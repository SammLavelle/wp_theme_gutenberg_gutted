<?php
/* Columns Block
 * Only contains ACF Column blocks
 * Can be added as a top level element.
*/
$allowed_blocks = ['acf/panel'];
$template = [['acf/panel'], ['acf/panel'], ['acf/panel']];

$className = 'block panels align--center';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
$width = get_field('width');
$className .= ' width--' . $width;

?>

<div class="<?php echo esc_attr($className); ?>">
    <?php echo '<InnerBlocks allowedBlocks="' . esc_attr(wp_json_encode($allowed_blocks)) . '" template="' . esc_attr(wp_json_encode($template)) . '" />'; ?>
</div>