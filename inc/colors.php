<?php
// Add color selection section to customiser
function sjl_customizer_color_section( $wp_customize ) {
	$wp_customize->add_section( 'sjl_theme_color_settings', array(
		'title' => __( 'Theme Colors' ),
		'priority'   => 20,
	));
}
add_action( 'customize_register', 'sjl_customizer_color_section' );

// Create object for theme colors
class Color{
	public $label, $id, $default, $selected;
	function __construct( $label, $default ){
		$this->label = $label;
		$this->id = str_replace(' ', '', strtolower( $label ) );
		$this->default = $default;
		$this->selected = get_theme_mod( $this->id, $default );
	}
}

// Set default theme colours
$theme_colors = array();

// These colours are required as they are referenced in the stylesheets (the default values can be changed)
$theme_colors[] = new Color( 'Primary Colour', '#EA5C5E' ); 
$theme_colors[] = new Color( 'Secondary Colour', '#09425E' ); 
$theme_colors[] = new Color( 'Heading Colour', '#2D3142' ); 
$theme_colors[] = new Color( 'Body Text Colour', '#2D3142' ); 

// Add or remove any additional colours as required by the theme
$theme_colors[] = new Color( 'Light Grey', '#E6E6E6' );
$theme_colors[] = new Color( 'White', '#FFFFFF' );

// Create a color picker in the customizer for each theme color
function sjl_customizer_color_options( $wp_customize ) {
	$theme_colors = $GLOBALS['theme_colors'];
	foreach( $theme_colors as $theme_color ){
		// Add settings
		$wp_customize->add_setting($theme_color->id , array(
			'default' => $theme_color->default,
			'sanitize_callback' => 'sanitize_hex_color',
		));
		// Add controls
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
		$theme_color->id, array(
			'label' => $theme_color->label . '',
			'section' => 'sjl_theme_color_settings',
			'settings' => $theme_color->id,
		)
	));
	}
}
add_action('customize_register', 'sjl_customizer_color_options');
  
// Add custom colors to gutenberg editor 
$gutenberg_colors = array();
foreach( $theme_colors as $theme_color){
	array_push( $gutenberg_colors,
		array(
			'name' => esc_html__( $theme_color->label, 'custom' ),
			'slug' => $theme_color->id,
			'color' => $theme_color->selected,
		)
	);
}
add_theme_support('editor-color-palette', $gutenberg_colors);

// Output theme colours stylesheet in header
function sjl_gutenberg_color_css(){
	$theme_colors = $GLOBALS['theme_colors'];
	$styles = '';
	foreach( $theme_colors as $theme_color ){
		$styles .= 
		'.has-' . $theme_color->id . '-color{
			color: ' . $theme_color->selected . ';
		}
		.has-' . $theme_color->id . '-color svg path{
			fill: ' . $theme_color->selected . ';
		}
		.has-' . $theme_color->id . '-background-color{
		background-color: ' . $theme_color->selected . ';
		}';
	}
	echo '<style>' . $styles . '</style>';
}
add_action( 'wp_head', 'sjl_gutenberg_color_css' );

//Get the colors formatted for use with gutenberg editor palette
function output_the_colors(){
	$color_palette = current((array) get_theme_support('editor-color-palette'));
	if (!$color_palette) {
		return;
	}
	ob_start();
	echo '[';
	foreach ($color_palette as $color) {
		echo "'" . $color['color'] . "', ";
	}
	echo ']';
	return ob_get_clean();
}

//Add the colors into ACF
function gutenberg_sections_register_acf_color_palette(){
	$color_palette = output_the_colors();
	if (!$color_palette) {
		return;
	}
	?>
	<script type="text/javascript">
		(function( $ ) {
			acf.add_filter( 'color_picker_args', function( args, $field ){
				args.palettes = <?php echo $color_palette; ?>
				return args;
			});
		})(jQuery);
	</script>
	<?php
}
add_action('acf/input/admin_footer', 'gutenberg_sections_register_acf_color_palette');