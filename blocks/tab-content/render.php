<?php
$allowed_blocks = ['core/heading', 'core/paragraph', 'core/list', 'acf/quote', 'acf/button', 'acf/image'];
$template = [
    ['core/heading', [
        'level' => 2,
        'placeholder' => 'Heading',
    ]],
    ['core/paragraph', [
        'placeholder' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sit amet aliquam est. Donec tincidunt egestas neque sit amet commodo. Phasellus ac odio hendrerit, bibendum nunc quis, pharetra lectus. Duis congue varius ultricies.',
    ]],
];

$className = 'tab__content';
?>

<div class="<?php echo esc_attr($className); ?>">
    <?php echo '<InnerBlocks allowedBlocks="' . esc_attr(wp_json_encode($allowed_blocks)) . '" template="' . esc_attr(wp_json_encode($template)) . '" templateLock="false" />'; ?>
</div>