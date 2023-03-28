<?php
$allowed_blocks = ['core/heading', 'core/paragraph'];
$template = [
    ['core/paragraph', [
        'placeholder' => 'Lorem ipsum dolor sit amet',
    ]],
];

$className = 'icon-text';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
$icon = get_field('icon');

?>

<div class="<?php echo esc_attr($className); ?>">

    <?php if($icon){
        echo file_get_contents( $icon ); 
    }; ?>
    <div class="icon-text__text">
        <?php echo '<InnerBlocks allowedBlocks="' . esc_attr(wp_json_encode($allowed_blocks)) . '" template="' . esc_attr(wp_json_encode($template)) . '" templateLock="false" />'; ?>
    </div>
</div>