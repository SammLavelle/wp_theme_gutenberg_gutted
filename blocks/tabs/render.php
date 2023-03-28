<?php
$allowed_blocks = ['acf/tab'];
$template = [['acf/tab'], ['acf/tab'], ['acf/tab']];

$className = 'block tabs';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

$width = get_field('width');
$className .= ' width--' . $width;

if($width == 'narrow'){
    $alignment = get_field('alignment');
    $className .= ' align--' . $alignment;
}

if (!empty($block['textColor'])) {
    $className .= ' has-text-color has-' . $block['textColor'] . '-color';
}

if (!empty($block['backgroundColor'])) {
    $className .= ' has-background has-' . $block['backgroundColor'] . '-background-color';
}
?>

<div class="<?php echo $className; ?>">
    <?php echo '<InnerBlocks allowedBlocks="' . esc_attr(wp_json_encode($allowed_blocks)) . '" template="' . esc_attr(wp_json_encode($template)) . '" />'; ?>
</div>