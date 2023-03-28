<?php
$allowed_blocks = ['acf/text-area', 'acf/columns', 'acf/cards', 'acf/panels', 'acf/media-text'];
$template = [['acf/text-area']];

$className = 'block section width--full';

if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

if (!empty($block['textColor'])) {
    $className .= ' has-text-color has-' . $block['textColor'] . '-color';
}

$bgImg = get_field('background_image');
if ($bgImg) {
    $className .= ' has-background has-background-image';
}

$overlayClassName = 'overlay';
if (!empty($block['backgroundColor'])) {
    $className .= ' has-background';
    $overlayClassName .= ' has-' . $block['backgroundColor'] . '-background-color';
}
?>

<div class="<?php echo $className; ?>">
    <div class="section__media">
        <?php if ($bgImg) :
            $size = 'full'; // (thumbnail, medium, large, full or custom size)
            echo wp_get_attachment_image($bgImg, $size); ?>
        <?php endif; ?>
        <div class="<?php echo esc_attr($overlayClassName); ?>">
        </div>
    </div>
    <?php echo '<InnerBlocks allowedBlocks="' . esc_attr(wp_json_encode($allowed_blocks)) . '" template="' . esc_attr(wp_json_encode($template)) . '" />'; ?>
</div>