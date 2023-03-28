<?php
/* Image Block
 * Uses ACF image field
 * Uses ACF selection field to set classes for custom styling
 * Can be added as a top level element.
*/
$img = get_field('image');
$style = get_field('image_style');
$height = get_field('height') . get_field('units');

if (!empty($block['align'])) {
    $align = $block['align'];
} else {
    $align = 'default';
}

$className = 'block image ';
$className .= ' image--' . $style;
$className .= ' align--' . $align;

if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

?>

<div class="<?php echo esc_attr($className); ?>" <?php if ($style == "crop") { ?>style="height: <?php echo $height; ?>" <?php } ?>>
    <?php if ($img) {
        if($align == 'full') {
            $size = 'full';
        } else {
            $size = 'large';
        }
        echo wp_get_attachment_image($img, $size);
    } ?>
</div>