<?php

$allowed_blocks = ['acf/quote'];
$template = [['acf/quote'], ['acf/quote']];

$className = 'block testimonials';
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

<div class="<?php echo esc_attr($className); ?>">
    <div class="testimonials__viewport" tabindex="0">
         <div class="testimonials__slider">
            <?php echo '<InnerBlocks allowedBlocks="' . esc_attr(wp_json_encode($allowed_blocks)) . '" template="' . esc_attr(wp_json_encode($template)) . '" />'; ?>
        </div>
    </div>
</div>