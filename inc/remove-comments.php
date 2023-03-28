<?php
// Removes comments area from post and pages
function sjl_remove_comment_support(){
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}
add_action( 'init', 'sjl_remove_comment_support', 100);

// Removes comment link from admin menu
function sjl_remove_admin_menus(){
    remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'sjl_remove_admin_menus' );

// Removes comments link from admin bar
function sjl_admin_bar_render(){
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'comments' );
}
add_action( 'wp_before_admin_bar_render', 'sjl_admin_bar_render' );