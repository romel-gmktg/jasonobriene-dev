<?php
/**
 * Functions which enhance the theme by hooking into WordPress.
 *
 * @package gmktg
 */

/**
 * Customize WordPress login form
 *
 * @link https://codex.wordpress.org/Customizing_the_Login_Form
 */
function gmktg_login_stylesheet() {
  wp_enqueue_style( 'gmkg-custom-login', get_stylesheet_directory_uri() . '/inc/styles/login.css' );
}
add_action( 'login_enqueue_scripts', 'gmktg_login_stylesheet' );

/**
 * Change WordPress login logo link
 *
 * @link https://codex.wordpress.org/Customizing_the_Login_Form
 */
function gmktg_login_logo_url() {
  return home_url();
}
add_filter( 'login_headerurl', 'gmktg_login_logo_url' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param  array $classes Classes for the body element
 * @return array
 */
function gmktg_body_classes( $classes ) {
  // Adds a class of group-blog to blogs with more than 1 published author.
  if ( is_multi_author() ) {
    $classes[] = 'group-blog';
  }

  // Adds a class of hfeed to non-singular pages.
  if ( ! is_singular() ) {
    $classes[] = 'hfeed';
  }

  // Adds a class depending on what template the page is using.
  if ( is_404() || is_page_template( 'templates/full-width.php' ) ) {
    $classes[] = 'full-width';
  } elseif ( is_page_template( 'templates/right-sidebar.php' ) ) {
    $classes[] = 'right-sidebar';
  } else {
    $classes[] = 'full-width';
  }

  // Remove the version class of visual composer on the body element.
  if ( defined( 'WPB_VC_VERSION' ) ) {
    $remove_class = array( 'wpb-js-composer js-comp-ver-' . WPB_VC_VERSION );
    $classes = array_diff( $classes, $remove_class );
    $classes[] = 'wpb-js-composer';
  }

  return $classes;
}
add_filter( 'body_class', 'gmktg_body_classes', 100 );

/**
 * Add scripts inside <head> of the site.
 */
function gmktg_head_scripts() {
  echo get_theme_mod( 'scripts_head' );
}
add_action( 'wp_head', 'gmktg_head_scripts' );

/**
 * Add scripts after <body> of the site.
 */
function gmktg_body_scripts() {
  echo get_theme_mod( 'scripts_body_start' );
}
add_action( 'gmktg_after_body', 'gmktg_body_scripts' );

/**
 * Add scripts before </body> of the site.
 */
function gmktg_footer_scripts() {
  echo get_theme_mod( 'scripts_body_end' );
}
add_action( 'wp_footer', 'gmktg_footer_scripts' );

/**
 * Enable Gravity Form field label visibility setting
 */
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

/**
 * Set a Google API key for the ACF Google Map field to work
 *
 * @link https://www.advancedcustomfields.com/resources/google-map/
 *
 * @param  array $api API information
 * @return array
 */
function gmktg_acf_google_map_api( $api ) {
  $api['key'] = 'xxx';
  return $api;
}
// add_filter( 'acf/fields/google_map/api', 'gmktg_acf_google_map_api' );
