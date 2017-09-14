<?php
/**
 * Customizer additions.
 *
 * @package gmktg
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function gmktg_customize_register( $wp_customize ) {
  $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
  $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
}
add_action( 'customize_register', 'gmktg_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function gmktg_customize_preview_js() {
  wp_enqueue_script( 'gmktg-customizer-preview', get_template_directory_uri() . '/inc/scripts/customizer.js', array( 'customize-preview' ), null, true );
}
add_action( 'customize_preview_init', 'gmktg_customize_preview_js' );

/**
 * Custom styling to make Theme Customizer preview look better.
 */
function gmktg_customize_preview_css() {
  wp_enqueue_style( 'gmktg-customizer-preview', get_template_directory_uri() . '/inc/styles/customizer.css', array(), null );
}
add_action( 'customize_controls_print_styles', 'gmktg_customize_preview_css' );

/**
 * Create Kirki Configuration
 * @link https://aristath.github.io/kirki/
 */
GMKTG_kirki::add_config( 'gmktg_config', array(
  'capability'     => 'edit_theme_options',
  'option_type'    => 'theme_mod',
  'disable_output' => true,
) );

/**
 * Section: AdRotate Popups
 */
GMKTG_Kirki::add_section( 'adrotate_popups', array(
  'title'       => 'AdRotate Popups',
  'description' => __( 'Enter your adrotate shortcode to your preferred page(s).', 'gmktg' ),
  'priority'    => 160,
  'capability'  => 'edit_theme_options',
) );

/**
 * Control: Homepage
 */
GMKTG_Kirki::add_field( 'gmktg_config', array(
  'type'     => 'text',
  'settings' => 'homepage_popup',
  'label'    => 'Homepage',
  'section'  => 'adrotate_popups',
) );

/**
 * Section: Social Links
 */
GMKTG_Kirki::add_section( 'social_links', array(
  'title'       => 'Social Links',
  'priority'    => 160,
  'capability'  => 'edit_theme_options',
) );

/**
 * Control: Facebook
 */
GMKTG_Kirki::add_field( 'gmktg_config', array(
  'type'     => 'text',
  'settings' => 'fb_url',
  'label'    => 'Facebook',
  'section'  => 'social_links',
) );

/**
 * Control: Twitter
 */
GMKTG_Kirki::add_field( 'gmktg_config', array(
  'type'      => 'text',
  'settings'  => 'twitter_url',
  'label'     => 'Twitter',
  'section'   => 'social_links',
) );

/**
 * Control: Google+
 */
GMKTG_Kirki::add_field( 'gmktg_config', array(
  'type'      => 'text',
  'settings'  => 'googleplus_url',
  'label'     => 'Google+',
  'section'   => 'social_links',
) );

/**
 * Control: Instagram
 */
GMKTG_Kirki::add_field( 'gmktg_config', array(
  'type'      => 'text',
  'settings'  => 'instagram_url',
  'label'     => 'Instagram',
  'section'   => 'social_links',
) );

/**
 * Control: RSS Feed
 */
GMKTG_Kirki::add_field( 'gmktg_config', array(
  'type'     => 'switch',
  'settings' => 'rss_feed',
  'label'    => 'RSS Feed',
  'section'  => 'social_links',
  'default'  => 0,
  'choices'  => array(
    'on'  => __( 'ON', 'gmktg' ),
    'off' => __( 'OFF', 'gmktg' ),
  ),
) );

/**
 * Section: Scripts
 */
GMKTG_Kirki::add_section( 'scripts', array(
  'title'       => 'Scripts',
  'priority'    => 160,
  'capability'  => 'edit_theme_options',
) );

/**
 * Control: <head>
 */
GMKTG_Kirki::add_field( 'gmktg_config', array(
  'type'        => 'code',
  'settings'    => 'scripts_head',
  'label'       => 'Inside &lt;head&gt;',
  'section'     => 'scripts',
  'choices'     => array(
    'language' => 'html',
    'theme'    => 'monokai',
    'height'   => 250,
  ),
) );

/**
 * Control: <body>
 */
GMKTG_Kirki::add_field( 'gmktg_config', array(
  'type'        => 'code',
  'settings'    => 'scripts_body_start',
  'label'       => 'After &lt;body&gt;',
  'section'     => 'scripts',
  'choices'     => array(
    'language' => 'html',
    'theme'    => 'monokai',
    'height'   => 250,
  ),
) );

/**
 * Control: </body>
 */
GMKTG_Kirki::add_field( 'gmktg_config', array(
  'type'        => 'code',
  'settings'    => 'scripts_body_end',
  'label'       => 'Before &lt;&#47;body&gt;',
  'section'     => 'scripts',
  'choices'     => array(
    'language' => 'html',
    'theme'    => 'monokai',
    'height'   => 250,
  ),
) );


/**
 * Blog: Hero
 */
GMKTG_Kirki::add_section( 'blog_hero', array(
  'title'       => 'Blog: Hero',
  'description' => __( 'Contents', 'gmktg' ),
  'priority'    => 160,
  'capability'  => 'edit_theme_options',
) );

/**
 * Control: Hero Heading
 */
GMKTG_Kirki::add_field( 'gmktg_config', array(
  'type'     => 'text',
  'settings' => 'blog_hero_text',
  'label'    => 'Hero Heading',
  'section'  => 'blog_hero',
) );

/**
 * Control: Hero Background
 */
GMKTG_Kirki::add_field( 'gmktg_config', array(
  'type'     => 'image',
  'settings' => 'blog_hero_bg',
  'label'    => 'Hero Background',
  'section'  => 'blog_hero',
) );

/**
 * Control: Button Text
 */
GMKTG_Kirki::add_field( 'gmktg_config', array(
  'type'     => 'text',
  'settings' => 'blog_button_text',
  'label'    => 'Button Text',
  'section'  => 'blog_hero',
) );

/**
 * Control: Button Link
 */
GMKTG_Kirki::add_field( 'gmktg_config', array(
  'type'     => 'text',
  'settings' => 'blog_button_link',
  'label'    => 'Button Link',
  'section'  => 'blog_hero',
) );