<?php
$link = get_field('link');

$link_url = $link['url'];
$link_title = $link['title'];
$link_target = $link['target'] ? $link['target'] : '_self';

$id = 'block-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$className = 'btn';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align--' . $block['align'];
} else {
    $className .= ' align--left';
}

?>
<?php if($link): ?>
    <a id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
        <span><?php echo esc_html($link_title); ?></span>
    </a>
<?php endif; ?>