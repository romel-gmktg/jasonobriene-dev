<?php
/**
 * Displays the social media links of the site.
 */
add_shortcode( 'gmktg_social_links', 'gmktg_social_links_element' );
function gmktg_social_links_element( $atts ) {
  ob_start();
  extract( shortcode_atts( array(
    'note'     => '',
    'title'    => '',
    'el_class' => '',
  ), $atts ) );

  if ( function_exists( 'vc_map_get_attributes' ) ) {
    $atts = vc_map_get_attributes( 'gmktg_social_links', $atts );
  }

  $protocols  = array( 'https', 'http' );
  $facebook   = esc_url( get_theme_mod( 'fb_url' ), $protocols );
  $twitter    = esc_url( get_theme_mod( 'twitter_url' ), $protocols );
  $googleplus = esc_url( get_theme_mod( 'googleplus_url' ), $protocols );
  $instagram  = esc_url( get_theme_mod( 'instagram_url' ), $protocols );
  $rss        = get_theme_mod( 'rss_feed' );

  $classes = ( empty( $el_class ) ) ? 'social-links clear' : 'social-links clear ' . $el_class ;

  $link_format = '<a class="social-link" href="%s" title="%s" target="_blank" rel="noopener noreferrer"><span class="font-icon %s" aria-hidden="true"></span><span class="screen-reader-text">%s</span></a>' ?>

  <div class="<?php echo $classes; ?>">
    <?php
      echo ( ! empty( $title ) ) ? sprintf( '<h4 class="widget-title">%s</h4>', $title ) : '' ;
      echo ( ! empty( $instagram ) ) ? sprintf( $link_format, $instagram, 'Instagram', 'icon-instagram', 'Instagram' ) : '' ;
      echo ( ! empty( $facebook ) ) ? sprintf( $link_format, $facebook, 'Facebook', 'icon-facebook', 'Facebook' ) : '' ;
      echo ( ! empty( $twitter ) ) ? sprintf( $link_format, $twitter, 'Twitter', 'icon-twitter', 'Twitter' ) : '' ;
      echo ( ! empty( $googleplus ) ) ? sprintf( $link_format, $googleplus, 'Google+', 'icon-google-plus', 'Google+' ) : '' ;

      echo ( ! empty( $rss ) ) ? sprintf( $link_format, get_bloginfo( 'rss2_url' ), 'RSS Feed', 'icon-rss', 'RSS Feed' ) : '' ;
    ?>
  </div>

  <?php $social_links = ob_get_clean();
  return $social_links;
}
