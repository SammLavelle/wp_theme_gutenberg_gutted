<?php 
// Adds a default image option when creating an acf image field. Pre-populates blocks with selected image.
// Added to improve User Experience when using the block editor - allow us to keep image fields in preview mode and keep settings off in the sidebar by default.
function sjl_add_default_value_to_image_field($field) {
    acf_render_field_setting( $field, array(
      'label'      => __('Default Image ID','acf'),
      'type'      => 'image',
      'name'      => 'default_value',
    ));
  }
add_action('acf/render_field_settings/type=image', 'sjl_add_default_value_to_image_field', 20);

// Removed ACF's additional div wrapping inner blocks
function acf_should_wrap_innerblocks( $wrap, $name ) {
    return false;
}
add_filter( 'acf/blocks/wrap_frontend_innerblocks', 'acf_should_wrap_innerblocks', 10, 2 );