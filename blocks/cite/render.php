<?php
$allowed_blocks = ['core/heading', 'core/paragraph'];
$template = [
    ['core/paragraph', [
        'placeholder' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sit amet aliquam est. Donec tincidunt egestas neque sit amet commodo.',
    ]],
    ['acf/cite']
];
?>

<cite><?php the_field('cite'); ?></cite>