<?php
$allowed_blocks = ['core/heading', 'core/paragraph', 'acf/cite'];
$template = [
    ['core/paragraph', [
        'placeholder' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sit amet aliquam est. Donec tincidunt egestas neque sit amet commodo.',
    ]],
    ['acf/cite']
];

$className = 'quote';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
$width = get_field('width');
$className .= ' width--' . $width;

if($width == 'narrow'){
    $alignment = get_field('alignment');
    $className .= ' align--' . $alignment;
}
?>

<blockquote class="<?php echo esc_attr($className); ?>">
    <?php echo '<InnerBlocks allowedBlocks="' . esc_attr(wp_json_encode($allowed_blocks)) . '" template="' . esc_attr(wp_json_encode($template)) . '" templateLock="false" />'; ?>
</blockquote>