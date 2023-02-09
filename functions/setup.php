<?php
/* ----- Set up ----- */
function custom_setup()
{

    load_theme_textdomain('custom', get_template_directory() . '/languages'); // Localisation Support

    add_theme_support('title-tag'); //allows Yoast to manage title tags

    add_theme_support( 'custom-logo' );

    add_theme_support('post-thumbnails');

    add_image_size('large', 1280, '', true); // Large Thumbnail
    add_image_size('medium_large', 1024, '', true); // Small Thumbnail
    add_image_size('medium', 786, '', true); // Medium Thumbnail
    add_image_size('small', 300, '', true); // Small Thumbnail
    add_image_size('medium-square', 768, 768, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');
    
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script')); //This feature allows the use of HTML5 markup for the search forms, comment forms, comment lists, gallery, and caption.

    // Gutenberg theme support
    //add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
   

    //cleanup header
    remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
    remove_action('wp_head', 'wp_generator'); // remove wordpress version
    remove_action('wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
    remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
    remove_action('wp_head', 'index_rel_link'); // remove link to index page
    remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
    remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
    remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); // Remove shortlink (google ignores it so it's pointless)

    add_filter('show_admin_bar','__return_false');  //hides admin bar
}
add_action('after_setup_theme', 'custom_setup');

add_filter('xmlrpc_enabled', '__return_false'); //Disable xmlrpc.php (for security)



//change logo class
function change_logo_class( $html ) {

    $html = str_replace( 'custom-logo', 'logo', $html );
    $html = str_replace( 'custom-logo-link', 'logo__link', $html );

    return $html;
}

/* ----- Disable Emoji mess ----- */
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

/* ----- Remove comments ----- */
// Removes from admin menu
function my_remove_admin_menus()
{
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'my_remove_admin_menus');

// Removes from post and pages
function remove_comment_support()
{
    remove_post_type_support('post', 'comments');
    remove_post_type_support('page', 'comments');
}
add_action('init', 'remove_comment_support', 100);

// Removes from admin bar
function mytheme_admin_bar_render()
{
    global $wp_admin_bar;

    $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'mytheme_admin_bar_render');

/* ----- Enqueue stylesheet  & js ----- */
function enqueue_scripts_styles()
{
    wp_dequeue_style( 'wc-blocks-style' );
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_register_style('gfonts', 'https://fonts.googleapis.com/css2?family=Merriweather:wght@300&family=Open+Sans:wght@400;700&display=swap', [], null);
    wp_enqueue_style('gfonts');
    wp_enqueue_style('custom-css', get_template_directory_uri() . '/assets/css/style.min.css');

    wp_deregister_script('jquery');
    wp_enqueue_script('functions-js', get_template_directory_uri() . '/assets/functions.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_scripts_styles');

function load_dashicons_front_end()
{
    wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'load_dashicons_front_end');

/* ----- Add reusable blocks to dash ----- */
function be_reusable_blocks_admin_menu()
{
    add_menu_page('Reusable Blocks', 'Reusable Blocks', 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22);
}
add_action('admin_menu', 'be_reusable_blocks_admin_menu');

/* ----- Add MIME type for SVG uploads. ----- */
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/* -----  Create menus ----- */
function register_my_menu()
{
    register_nav_menu('main-menu', __('Main Menu'));
    register_nav_menu('footer-menu', __('Footer Menu'));
}
add_action('init', 'register_my_menu');

/* -----  Create widget area (Sidebar) ----- */
function wpdocs_theme_slug_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'post-sidebar', 'textdomain' ),
        'id'            => 'post-sidebar',
        'description'   => __( 'Widgets in this area will be shown on all posts.', 'textdomain' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widgettitle">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'wpdocs_theme_slug_widgets_init' );

/* ----- Gutenberg ----- */
// Add custom editor font sizes
add_theme_support(
    'editor-font-sizes',
    array(
        array(
            'name'      => esc_html__('Small', 'custom'),
            'shortName' => esc_html_x('S', 'Font size', 'custom'),
            'size'      => 12,
            'slug'      => 's',
        ),
        array(
            'name'      => esc_html__('Normal', 'custom'),
            'shortName' => esc_html_x('N', 'Font size', 'custom'),
            'size'      => 16,
            'slug'      => 'default',
        ),
        array(
            'name'      => esc_html__('Large', 'custom'),
            'shortName' => esc_html_x('L', 'Font size', 'custom'),
            'size'      => 24,
            'slug'      => 'l',
        ),
        array(
            'name'      => esc_html__('Extra Large', 'custom'),
            'shortName' => esc_html_x('XL', 'Font size', 'custom'),
            'size'      => 32,
            'slug'      => 'xl',
        ),
        array(
            'name'      => esc_html__('XXL', 'custom'),
            'shortName' => esc_html_x('XXL', 'Font size', 'custom'),
            'size'      => 40,
            'slug'      => 'xxl',
        ),
        array(
            'name'      => esc_html__('XXXL', 'custom'),
            'shortName' => esc_html_x('XXXL', 'Font size', 'custom'),
            'size'      => 48,
            'slug'      => 'xxxl',
        ),
    )
);

/*add color section to customiser*/
function customize_register( $wp_customize ) {
    $wp_customize->add_section( 
        'gutenberg_color_settings', array(
            'title' => __( 'Gutenberg Color Options' ),
            'priority'   => 20,
        ) 
    );
  }
add_action( 'customize_register', 'customize_register' );
/* Customiser modifications */
function customize_additional_settings($wp_customize) {
    /* Add settings for the site colours */
    $wp_customize->add_setting('custom_1_color', array(
      'default' => '#dd3333',
    ));
    $wp_customize->add_setting('custom_2_color', array(
      'default' => '#dd9933',
    ));
    $wp_customize->add_setting('custom_3_color', array(
      'default' => '#eeee22',
    ));
    $wp_customize->add_setting('custom_4_color', array(
      'default' => '#81d742',
    ));
    $wp_customize->add_setting('custom_5_color', array(
      'default' => '#1e73be',
    ));
    $wp_customize->add_setting('custom_6_color', array(
      'default' => '#8224e3',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
     'custom_1_color',
      array(
        'label' => 'Custom Color 1',
        'section' => 'gutenberg_color_settings',
        'settings' => 'custom_1_color',
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
     'custom_2_color',
      array(
        'label' => 'Custom Color 2',
        'section' => 'gutenberg_color_settings',
        'settings' => 'custom_2_color',
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
     'custom_3_color',
      array(
        'label' => 'Custom Color 3',
        'section' => 'gutenberg_color_settings',
        'settings' => 'custom_3_color',
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
     'custom_4_color',
      array(
        'label' => 'Custom Color 4',
        'section' => 'gutenberg_color_settings',
        'settings' => 'custom_4_color',
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
     'custom_5_color',
      array(
        'label' => 'Custom Color 5',
        'section' => 'gutenberg_color_settings',
        'settings' => 'custom_5_color',
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
     'custom_6_color',
      array(
        'label' => 'Custom Color 6',
        'section' => 'gutenberg_color_settings',
        'settings' => 'custom_6_color',
    )));
  
    
  }
  
  add_action('customize_register', 'customize_additional_settings');
  
  /* Create a custom colour object */
  $colours = (object) [
      "custom1" => get_theme_mod('custom_1_color', '#dd3333'),
      "custom2" => get_theme_mod('custom_2_color', '#dd9933'),
      "custom3" => get_theme_mod('custom_3_color', '#eeee22'),
      "custom4" => get_theme_mod('custom_4_color', '#81d742'),
      "custom5" => get_theme_mod('custom_5_color', '#1e73be'),
      "custom6" => get_theme_mod('custom_6_color', '#8224e3'),
      "white" => "#ffffff",
      "black" => "#000000"
      
  ];
  
  add_action('wp_head', function ($args) use ($colours) {my_custom_styles($colours);}, 1);
  
  /* add css file with colours to the head */
  function my_custom_styles($colours)
  {
    echo "
    <style>
      .has-custom1-color{
        color: " . $colours->custom1 . ";
      }
      .has-custom2-color{
        color: " . $colours->custom2 . ";
      }
      .has-custom3-color{
        color: " . $colours->custom3 . ";
      }
      .has-custom4-color{
        color: " . $colours->custom4 . ";
      }
      .has-custom5-color{
        color: " . $colours->custom5 . ";
      }
      .has-custom6-color{
        color: " . $colours->custom6 . ";
      }
      .has-custom1-background-color{
        background-color: " . $colours->custom1 . ";
      }
      .has-custom2-background-color{
        background-color: " . $colours->custom2 . ";
      }
      .has-custom3-background-color{
        background-color: " . $colours->custom3 . ";
      }
      .has-custom4-background-color{
        background-color: " . $colours->custom4 . ";
      }
      .has-custom5-background-color{
        background-color: " . $colours->custom5 . ";
      }
      .has-custom6-background-color{
        background-color: " . $colours->custom6 . ";
      }
    </style>
   ";
  }
  
  /* Add custom colours to gutenberg editor */
  add_theme_support('editor-color-palette', array(
      array(
          'name' => esc_html__('Custom Colour 1', 'custom'),
          'slug' => 'custom1',
          'color' => $colours->custom1,
      ),
      array(
          'name' => esc_html__('Custom Colour 2', 'custom'),
          'slug' => 'custom2',
          'color' => $colours->custom2,
      ),
      array(
          'name' => esc_html__('Custom Colour 3', 'custom'),
          'slug' => 'custom3',
          'color' => $colours->custom3,
      ),
      array(
          'name' => esc_html__('Custom Colour 4', 'custom'),
          'slug' => 'custom4',
          'color' => $colours->custom4,
      ),
      array(
          'name' => esc_html__('Custom Colour 5', 'custom'),
          'slug' => 'custom5',
          'color' => $colours->custom5,
      ),
      array(
          'name' => esc_html__('Custom Colour 6', 'custom'),
          'slug' => 'custom6',
          'color' => $colours->custom6,
      ),
      array(
          'name'  => esc_html__('White', 'custom'),
          'slug'  => 'white',
          'color' => $colours->white,
      ),
      array(
          'name'  => esc_html__('Black', 'custom'),
          'slug'  => 'black',
          'color' => $colours->black,
      ),
  
    )
  );
  
  
  //Get the colors formatted for use with gutenberg editor palette
  function output_the_colors()
  {
  
      // get the colors
      $color_palette = current((array) get_theme_support('editor-color-palette'));
  
      // bail if there aren't any colors found
      if (!$color_palette) {
          return;
      }
  
      // output begins
      ob_start();
  
      // output the names in a string
      echo '[';
      foreach ($color_palette as $color) {
          echo "'" . $color['color'] . "', ";
      }
      echo ']';
  
      return ob_get_clean();
  
  }
  
  //Add the colors into ACF
  function gutenberg_sections_register_acf_color_palette()
  {
  
      $color_palette = output_the_colors();
      if (!$color_palette) {
          return;
      }
  
      ?>
      <script type="text/javascript">
          (function( $ ) {
              acf.add_filter( 'color_picker_args', function( args, $field ){
  
                  // add the hexadecimal codes here for the colors you want to appear as swatches
                  args.palettes = <?php echo $color_palette; ?>
  
                  // return colors
                  return args;
  
              });
          })(jQuery);
      </script>
      <?php
  }

add_action('acf/input/admin_footer', 'gutenberg_sections_register_acf_color_palette');

/* ----- Pagination ----- */
function custom_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base'      => str_replace($big, '%#%', get_pagenum_link($big)),
        'format'    => '?paged=%#%',
        'current'   => max(1, get_query_var('paged')),
        'total'     => $wp_query->max_num_pages,
        'next_text' => '→',
        'prev_text' => '←',
        'mid_size'  => 5,
    ));
}

/* ----- Excerpts ----- */
// create get_excerpt function allowing you to customise excerpt length
function get_excerpt($limit, $source = null)
{

    if ($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));
    $excerpt = preg_replace(" (\[.*?\])", '', $excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace('/\s+/', ' ', $excerpt));
    $excerpt = $excerpt . '...';
    return $excerpt;
}

// Changing excerpt 'more' (amends gutenberg's 'latest post' excerpt output)
function new_excerpt_more($more)
{
    global $post;
    return '…';
}
add_filter('excerpt_more', 'new_excerpt_more');

add_action( 'admin_init', 'wpdocs_add_editor_styles' );
function wpdocs_add_editor_styles() {
  add_theme_support( 'editor-styles' );
  add_editor_style( 'editor.css' );
}