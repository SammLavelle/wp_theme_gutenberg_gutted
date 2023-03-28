<?php
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/previews/panel.png" alt="Preview of panel block">
    </figure>
<?php } else {

$allowed_blocks = ['core/heading', 'core/paragraph', 'core/buttons', 'core/quote'];
$template = [
	['core/heading', [
		'level' => 2,
		'placeholder' => 'Title Goes Here',
	]],
    ['core/paragraph', [
		'placeholder' => 'Main Content Goes Here',
	]],
    ['core/buttons', [
		['core/button'],
	]],
];

$id = 'block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$className = 'block block__panel';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['textColor']) ) {
    $className .= ' has-text-color has-' . $block['textColor'] . '-color';
}
$bgImg = get_field('background_image');
if( $bgImg) {
    $className .= ' has-background has-background-image';
}
if( !empty($block['backgroundColor']) ) {
    $className .= ' has-background has-' . $block['backgroundColor'] . '-background-color';
}
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <?php if($bgImg) { 
        $size = 'medium_large'; // (thumbnail, medium, large, full or custom size)
        echo wp_get_attachment_image( $bgImg, $size);
	} ?>
    <?php echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" templateLock="false" />'; ?>
</div>

<?php } ?>