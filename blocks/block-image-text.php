<?php
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/previews/image-text.png" alt="Preview of image and text block">
    </figure>
<?php } else {
$template = [['acf/panel'], ['acf/image']];

$id = 'block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$className = 'block block__image-text';
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
if( !empty($block['backgroundColor']) ) {
    $className .= ' has-background has-' . $block['backgroundColor'] . '-background-color';
} 
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" >
    <?php echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $template ) ) . '" templateLock="insert"/>'; ?>
</div>

<?php } ?>