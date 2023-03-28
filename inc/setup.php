<?php
// Sets up theme defaults and registers support for various WordPress features.
function sjl_custom_setup(){

	// Make theme available for translation. Translations can be filed in the /languages/ directory.
	load_theme_textdomain( 'sjl', get_template_directory() . '/languages' ); 

	// Enable thumbnails for posts and pages
	add_theme_support( 'post-thumbnails' );

	// Add logo control to the customizer
	add_theme_support( 'custom-logo' );

	// Declare that this theme does not use a hard-coded <title> tag so WordPress (or Yoast) will provide it.
	add_theme_support( 'title-tag' );

	// Allow the use of HTML5 markup for the search forms, comment forms, comment lists, gallery, and caption.
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' )); 

	// Add responsive iframes
	add_theme_support( 'responsive-embeds' );

	// Remove core block patterns.
	remove_theme_support( 'core-block-patterns' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );
	add_editor_style( 'editor.css' );
   
}
add_action( 'after_setup_theme', 'sjl_custom_setup' );

// Disable Emojis
function disable_wp_emojicons()
{
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    add_filter('emoji_svg_url', '__return_false');
}
add_action('init', 'disable_wp_emojicons');

add_filter('show_admin_bar','__return_false'); 