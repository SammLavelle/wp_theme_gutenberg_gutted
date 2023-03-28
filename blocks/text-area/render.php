<?php
/* Text Area Block
 * Used within 
 * - Banner Block
 * - Media & Text Block
 * Can be added as a top level element
*/
$allowed_blocks = ['core/heading', 'core/paragraph', 'core/list', 'acf/quote', 'acf/button', 'core/shortcode', 'acf/icon-text'];
$template = [
    ['core/heading', [
        'level' => 2,
        'placeholder' => 'Heading',
    ]],
    ['core/paragraph', [
        'placeholder' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sit amet aliquam est. Donec tincidunt egestas neque sit amet commodo. Phasellus ac odio hendrerit, bibendum nunc quis, pharetra lectus. Duis congue varius ultricies.',
    ]],
];

$className = 'block text-area';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

$width = get_field('width');
if($width){
    $className .= ' width--' . $width;
} else{
    $className .= ' width--default';
}


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
    <?php echo '<InnerBlocks allowedBlocks="' . esc_attr(wp_json_encode($allowed_blocks)) . '" template="' . esc_attr(wp_json_encode($template)) . '" templateLock="false" />'; ?>
</div>