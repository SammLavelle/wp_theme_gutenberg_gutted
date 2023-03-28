<?php
$className = 'accordion__label';
?>

<button class="<?php echo esc_attr($className); ?>">
   <?php the_field('accordion_label'); ?>
</button>