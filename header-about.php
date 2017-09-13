<?php /*

The header for the ABOUT page.
It has a different colored navigation and 50 - 50 width header.

*/
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> style="background-color: #242424;">

  <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to Content', 'gmktg' ); ?></a>
  <a class="skip-link screen-reader-text" href="#site-navigation"><?php esc_html_e( 'Skip to Navigation', 'gmktg' ); ?></a>
  <a class="skip-link screen-reader-text" href="<?php echo esc_url( home_url( '/' ) ) . 'site-map'; ?>"><?php esc_html_e( 'Site Map', 'gmktg' ); ?></a>

  <!--[if lt IE 8]>
  <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="<?php echo esc_url('http://browsehappy.com/'); ?>" target="_blank" rel="noopener noreferrer">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->

  <?php do_action( 'gmktg_after_body' ); ?>

  <div id="page" class="site">
    <?php get_field( 'about_hero_image'); ?>
    <header id="masthead" class="site-header" >
        <div id="about-header" style="background-image: url('<?php the_field( 'about_hero_image' ); ?>');">
          <div class="page-row">
            <div class="site-name">
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
            </div>
            <nav id="site-navigation" class="primary-navigation base-navigation">
              <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'gmktg' ); ?></button>
              <?php
                wp_nav_menu( array(
                  'container_class' => 'menu',
                  'theme_location'  => 'primary-nav'
                ) );
              ?>
              <?php echo do_shortcode('[gmktg_social_links]'); ?>
            </nav>

            <div class="about-content">
              <h1><?php the_field( 'about_name' ); ?></h1>
              <p><?php the_field( 'about_description' ); ?></p>
              <p><?php the_field( 'about_email' ); ?></p>
            </div>
          </div><!-- .page-row -->
        </div>
    </header><!-- #masthead -->

    <div id="content" class="site-content">

      <div class="page-row">

        <main id="main" class="content-area">
