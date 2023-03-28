<?php 
// Adds link to resusable blocks to the WordPress dashboard
// WP Documentation: https://developer.wordpress.org/reference/functions/add_menu_page/
function sjl_reusable_blocks(){
	add_menu_page( 'Reusable Blocks', 'Reusable Blocks', 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22);
}
add_action( 'admin_menu', 'sjl_reusable_blocks' );

