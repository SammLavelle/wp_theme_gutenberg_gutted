<?php
$allowed_blocks = ['core/heading', 'core/paragraph', 'core/buttons', 'core/quote'];
$template = [
	['core/heading', [
		'level' => 2,
		'placeholder' => 'Title Goes Here',
        'textAlign' => 'center',
	]],
    ['core/paragraph', [
		'placeholder' => 'Main Content Goes Here',
        'align' => 'center',
	]],
];

$id = 'block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$className = 'block block__banner';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align-' . $block['align'];
} else{
    $className .= ' align-default';
}
if( !empty($block['textColor']) ) {
    $className .= ' has-text-color has-' . $block['textColor'] . '-color';
}
$bgImg = get_field('background_image');
if( $bgImg) {
    $className .= ' has-background has-background-image';
}
$overlayClassName = 'overlay';
if( !empty($block['backgroundColor']) ) {
    $overlayClassName .= ' has-background has-' . $block['backgroundColor'] . '-background-color';
} 
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo $className; ?>">
    <?php if($bgImg) { 
        $size = 'full'; // (thumbnail, medium, large, full or custom size)
        echo wp_get_attachment_image( $bgImg, $size);
	} ?>
    <div class="<?php echo esc_attr($overlayClassName); ?>">
    </div>
    <?php echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />'; ?>
</div>
