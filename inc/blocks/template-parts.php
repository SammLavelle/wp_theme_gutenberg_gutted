<?php 

function sjl_add_block_template_part_support() {
    add_theme_support( 'block-template-parts' );
}
 
add_action( 'after_setup_theme', 'sjl_add_block_template_part_support' );