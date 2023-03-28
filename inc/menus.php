<?php
// Register menus
function sjl_register_menus(){
    register_nav_menu( 'main-menu', __( 'Main Menu' ));
    register_nav_menu( 'footer-menu', __( 'Footer Menu' ));
}
add_action( 'init', 'sjl_register_menus' );