<?php
/**
 * gmktg functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package gmktg
 */

if ( ! function_exists( 'gmktg_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function gmktg_setup() {
  /**
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   * If you're building a theme based on gmktg, use a find and replace
   * to change 'gmktg' to the name of your theme in all the template files.
   */
  load_theme_textdomain( 'gmktg', get_template_directory() . '/languages' );

  /**
   * Add default posts and comments RSS feed links to head.
   */
  // add_theme_support( 'automatic-feed-links' );

  /**
   * Enable support for custom logo.
   */
  add_theme_support( 'custom-logo', array(
    'height'      => 18,
    'width'       => 202,
    'header-text' => array( 'site-title', 'site-description' ),
  ) );

  /**
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );

  /**
   * Enable support for Post Thumbnails on posts and pages.
   *
   * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
   */
  add_theme_support( 'post-thumbnails' );

  /**
   * This theme uses wp_nav_menu() in one location.
   */
  register_nav_menus( array(
    'primary-nav' => esc_html__( 'Primary Navigation', 'gmktg' ),
  ) );

  /**
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ) );
}
endif;
add_action( 'after_setup_theme', 'gmktg_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gmktg_content_width() {
  $GLOBALS['content_width'] = apply_filters( 'gmktg_content_width', 640 );
}
add_action( 'after_setup_theme', 'gmktg_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gmktg_widgets_init() {
  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar', 'gmktg' ),
    'id'            => 'sidebar',
    'before_widget' => '<section id="%1$s" class="widget sidebar-widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );

  register_sidebar( array(
    'name'          => esc_html__( 'Footer', 'gmktg' ),
    'id'            => 'footer',
    'before_widget' => '<section id="%1$s" class="widget footer-widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>'
  ) );
}
add_action( 'widgets_init', 'gmktg_widgets_init' );

/**
 * Deregister wordpress widgets.
 *
 * @link https://codex.wordpress.org/Function_Reference/unregister_widget
 */
function gmktg_widgets_deregister() {
  unregister_widget( 'WP_Widget_Archives' );
  unregister_widget( 'WP_Widget_Calendar' );
  unregister_widget( 'WP_Widget_Categories' );
  unregister_widget( 'WP_Widget_Meta' );
  unregister_widget( 'WP_Widget_Pages' );
  unregister_widget( 'WP_Widget_Recent_Comments' );
  unregister_widget( 'WP_Widget_Recent_Posts' );
  unregister_widget( 'WP_Widget_RSS' );
  unregister_widget( 'WP_Widget_Search' );
  unregister_widget( 'WP_Widget_Tag_Cloud' );
}
add_action( 'widgets_init', 'gmktg_widgets_deregister' );

/**
 * Enqueue scripts and styles.
 */
function gmktg_scripts() {
  // CSS
  wp_enqueue_style( 'gmktg-vendor-css', get_template_directory_uri() . '/assets/styles/vendor.css' );
  wp_enqueue_style( 'gmktg-theme-css', get_template_directory_uri() . '/assets/styles/theme.css' );

  // Scripts
  wp_enqueue_script( 'gmktg-vendor-js', get_template_directory_uri() . '/assets/scripts/vendor-dist.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'gmktg-theme-js', get_template_directory_uri() . '/assets/scripts/theme-dist.js', array( 'jquery' ), false, true );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'gmktg_scripts' );

/**
 * Avoid script render blocking by adding async or defer attributes.
 * Don’t do anything to jQuery. jQuery is a key dependency for many other JS files, and you want to let it load early.
 *
 * @link http://wpshout.com/make-site-faster-async-deferred-javascript-introducing-script_loader_tag/
 */
function gmktg_avoid_render_block( $tag, $handle, $src ) {
  // Async downloads the file during HTML parsing and will pause the HTML parser to execute it when it has finished downloading.
  // Async is better used on external javascript files.
  $async_scripts = array();

  // Defer downloads the file during HTML parsing and will only execute it after the parser has completed.
  // Defer scripts are also guarenteed to execute in the order that they appear in the document.
  $defer_scripts = array(
    'gmktg-vendor-js',
    'gmktg-theme-js'
  );

  if ( in_array( $handle, $async_scripts ) ) {
    return '<script type="text/javascript" async src="' . $src . '"></script>' . "\n";
  }

  if ( in_array( $handle, $defer_scripts ) ) {
    return '<script type="text/javascript" defer src="' . $src . '"></script>' . "\n";
  }

  return $tag;
}
add_filter( 'script_loader_tag', 'gmktg_avoid_render_block', 10, 3 );

/**
 * Remove WordPress version.
 */
remove_action( 'wp_head', 'wp_generator' );

/**
 * Remove Visual Composer meta.
 *
 * @link http://acoda.com/forums/topic/removing-visual-composer-in-meta-tag
 */
if ( function_exists( 'visual_composer' ) ) {
  function gmktg_remove_vc_meta() {
    remove_action( 'wp_head', array( visual_composer(), 'addMetaData' ) );
  }
  add_action( 'init', 'gmktg_remove_vc_meta', 100 );
}

/**
 * Disable Emoji on Wordpress.
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * Remove query strings from static resources.
 * Removing query strings from static resources enables the server to cache the files.
 *
 * @link https://developers.google.com/speed/docs/insights/LeverageBrowserCaching
 *
 * @param  string $src CSS/JS file paths with a query string
 * @return string
 */
function gmktg_remove_versions( $src ) {
  if ( strpos( $src, 'ver=' ) ) {
    $src = remove_query_arg( 'ver', $src );
  }
  return $src;
}
// add_filter('script_loader_src', 'gmktg_remove_versions', 9999);
// add_filter('style_loader_src', 'gmktg_remove_versions', 9999);

/**
 * Load TGMPA configuration file.
 *
 * @link http://tgmpluginactivation.com/installation
 */
require get_template_directory() . '/inc/tgmpa-config.php';

/**
 * Load Kirki configuration files.
 *
 * @link https://github.com/aristath/kirki-helpers#integrating-kirki-in-your-themes
 * @link https://github.com/aristath/kirki-helpers#making-sure-that-output-works-when-kirki-is-not-installed
 */
require get_template_directory() . '/inc/kirki-include.php';
require get_template_directory() . '/inc/kirki-fallback.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Theme Shortcodes.
 */
require get_template_directory() . '/inc/shortcodes/social-links.php';

/**
 * Functions which adds additional elements by hooking into Visual Composer.
 */
require get_template_directory() . '/inc/vc-integration.php';
