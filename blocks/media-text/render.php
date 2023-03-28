<?php
/* Media & Text Block
 * ACF fields for media (image or video)
 * Styles can be selected using ACF fields
 * Can be added as a top level element.
*/
$allowed_blocks = ['core/heading', 'core/paragraph', 'core/list', 'acf/quote', 'acf/button', 'acf/columns'];
$template = [
    ['core/heading', [
        'level' => 2,
        'placeholder' => 'Heading',
    ]],
    ['core/paragraph', [
        'placeholder' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sit amet aliquam est. Donec tincidunt egestas neque sit amet commodo. Phasellus ac odio hendrerit, bibendum nunc quis, pharetra lectus. Duis congue varius ultricies.',
    ]],
];

$layout = get_field('layout');
$media = get_field('media');
$img = get_field('image');
$img_style = get_field('image_style');
$video = get_field('video');
$vertical = get_field('vertical_alignment');
$width = get_field('width');

$className = 'block media-text align--center';
$className .= ' media-text--' . $layout;
$className .= ' media-text--' . $vertical;
$className .= ' media-text--media-' . $img_style;
$className .= ' width--' . $width;

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
    <div class="media-text__text">
        <div class="media-text__text__inner">
            <?php echo '<InnerBlocks allowedBlocks="' . esc_attr(wp_json_encode($allowed_blocks)) . '" template="' . esc_attr(wp_json_encode($template)) . '" />'; ?>
        </div>
    </div>
    <?php if ($media == 'image') : ?>
        <div class="media-text__media image image--<?php echo $img_style; ?>">
            <?php if ($img) {
                 if($width == 'full') {
                    $size = 'full';
                } else {
                    $size = 'large';
                }
                echo wp_get_attachment_image($img, $size);
            } ?>
        </div>
    <?php endif; ?>
    <?php if ($media == 'video') : ?>
        <div class="media-text__media video">
            <?php echo $video; ?>
        </div>
    <?php endif; ?>
</div>
