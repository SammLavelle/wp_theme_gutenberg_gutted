<?php
if( !empty( $block['data']['_is_preview'] ) ) { ?>
    <figure>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/previews/columns.png" alt="Preview of columns">
    </figure>
<?php } else {
$allowed_blocks = ['acf/panel'];
$template = [['acf/panel'], ['acf/panel'], ['acf/panel']];
$id = 'block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}
$className = 'block block__columns';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align-' . $block['align'];
} else{
    $className .= ' align-default';
}
if( !empty($block['backgroundColor']) ) {
    $className .= ' has-background has-' . $block['backgroundColor'] . '-background-color';
} 
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" >
    <?php echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />'; ?>
</div>
<?php } ?>