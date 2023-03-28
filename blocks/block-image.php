<?php
$img = get_field('image');
$style = get_field('image_style');

$id = 'block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$className = 'block block__image ';
if($style){
    $className .= ' block__image--crop';
}
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <?php if($img) { 
        $size = 'large'; // (thumbnail, medium, large, full or custom size)
        echo wp_get_attachment_image( $img, $size);
	} ?>
</div>