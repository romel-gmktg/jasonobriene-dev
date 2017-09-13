<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'gmktg_register_required_plugins' );
function gmktg_register_required_plugins() {
  $plugins = array(
    array(
      'name'     => 'ACF Pro',
      'slug'     => 'advanced-custom-fields-pro',
      'required' => true,
      'source'   => 'https://www.dropbox.com/s/1diufmg1an9du9h/advanced-custom-fields-pro.zip?dl=1',
    ),
    array(
      'name'     => 'ACF: Theme Code',
      'slug'     => 'acf-theme-code',
      'required' => true,
    ),
    array(
      'name'     => 'AdRotate Professional',
      'slug'     => 'adrotate-pro',
      'required' => true,
      'source'   => 'https://www.dropbox.com/s/2wd97p9jkkux085/adrotate-pro.zip?dl=1',
    ),
    array(
      'name'     => 'Enable Media Replace',
      'slug'     => 'enable-media-replace',
      'required' => true,
    ),
    array(
      'name'     => 'Gravity Forms',
      'slug'     => 'gravityforms',
      'required' => true,
      'source'   => 'https://www.dropbox.com/s/ue63nq4thqs32gw/gravityforms.zip?dl=1',
    ),
    array(
      'name'               => 'Kirki Toolkit',
      'slug'               => 'kirki',
      'required'           => true,
      'force_deactivation' => true,
    ),
    array(
      'name'     => 'Kraken Image Optimizer',
      'slug'     => 'kraken-image-optimizer',
      'required' => true,
    ),
    array(
      'name'     => 'WPBakery Visual Composer',
      'slug'     => 'js_composer',
      'required' => true,
      'source'   => 'https://www.dropbox.com/s/wwqairqa059qp2x/js_composer.zip?dl=1',
    ),
    array(
      'name'     => 'Yoast SEO',
      'slug'     => 'wordpress-seo',
      'required' => true,
    ),

    array(
      'name' => 'AddToAny Share Buttons',
      'slug' => 'add-to-any',
    ),
    array(
      'name' => 'Admin Columns',
      'slug' => 'codepress-admin-columns',
    ),
    array(
      'name' => 'Custom Post Type UI',
      'slug' => 'custom-post-type-ui',
    ),
    array(
      'name'   => 'Envira Gallery',
      'slug'   => 'envira-gallery',
      'source' => 'https://www.dropbox.com/s/n2hl1xrz83aiqet/envira-gallery.zip?dl=1',
    ),
    array(
      'name'   => 'New RoyalSlider',
      'slug'   => 'new-royalslider',
      'source' => 'https://www.dropbox.com/s/jiompsxsvu90y44/new-royalslider.zip?dl=1',
    ),
    array(
      'name' => 'Widget CSS Classes',
      'slug' => 'widget-css-classes',
    ),
    array(
      'name' => 'WooSidebars',
      'slug' => 'woosidebars',
    ),
  );

  $config = array(
    'id'           => 'gmktg',
    'menu'         => 'theme-plugins',
    'has_notices'  => true,
    'dismissable'  => true,
    'is_automatic' => true,
    'strings'      => array(
      'page_title' => __( 'Install Theme Plugins', 'gmktg' ),
      'menu_title' => __( 'Theme Plugins', 'gmktg' ),
      'return'     => __( 'Return to Theme Plugins Installer', 'gmktg' ),
    ),
  );

  tgmpa( $plugins, $config );
}
