<?php
/**
 * Functions which adds additional elements by hooking into Visual Composer.
 *
 * @package gmktg
 */

/**
 * A custom parameter type that shows only the Heading and Description.
 * This can be used if you want to add a Note, Warning, or Tip inside your custom VC Element.
 */
if ( function_exists( 'vc_add_shortcode_param' ) ) {
  vc_add_shortcode_param( 'el_desc', 'el_desc_settings_field' );
  function el_desc_settings_field( $settings, $value ) {
    return false;
  }
}

/**
 * Add the theme's shortcodes to the Visual Composer content element list.
 */
add_action( 'vc_before_init', 'gmktg_vc_intergation' );
function gmktg_vc_intergation() {
  vc_map( array(
    'name'              => 'Social Links',
    'base'              => 'gmktg_social_links',
    'category'          => 'Social',
    'admin_enqueue_css' => get_template_directory_uri() . '/inc/styles/vc.css',
    'icon'              => 'icon-gmktg-social_links',
    'params'            => array(
      array(
        'type'        => 'el_desc',
        'heading'     => 'Note',
        'param_name'  => 'note',
        'description' => 'Social media links can be updated <a href="' . admin_url( 'customize.php' ) . '">here</a>',
      ),
      array(
        'type'        => 'textfield',
        'class'       => 'hide',
        'heading'     => 'Title',
        'param_name'  => 'title',
        'admin_label' => true,
      ),
      array(
        'type'        => 'textfield',
        'heading'     => 'Extra Class',
        'param_name'  => 'el_class',
        'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gmktg' ),
      ),
    ),
  ) );
}
