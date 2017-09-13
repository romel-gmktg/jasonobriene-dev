<?php
/**
 * Custom template tags for this theme.
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package gmktg
 */

/**
 * Prints the logo of the site.
 */
if ( ! function_exists( 'gmktg_site_branding' ) ) :
function gmktg_site_branding( $desc = 'hidden' ) {
  // Get the url of the logo
  $image_src = ( has_custom_logo() ) ? wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ) : get_template_directory_uri() . '/assets/images/site-logo.png' ;
  $image_srcinfo = pathinfo( $image_src );
  $image_src_retina = $image_srcinfo['dirname'] . '/' . $image_srcinfo['filename'] . '-2x.' . $image_srcinfo['extension'];

  // Get the absolute path of the logo
  $image_path = ( has_custom_logo() ) ? get_attached_file( get_theme_mod( 'custom_logo' ) ) : get_template_directory() . '/assets/images/site-logo.png' ;
  $image_pathinfo = pathinfo( $image_path );
  $image_path_retina = $image_pathinfo['dirname'] . '/' . $image_pathinfo['filename'] . '-2x.' . $image_pathinfo['extension'];

  // Get the meta data of the logo
  $image_meta = getimagesize( $image_src );

  // Check if retina version of the logo is available
  if ( file_exists( $image_path_retina ) ) {
    $site_logo = '<a href="' . esc_url( home_url( '/' ) ) . '"><img src="' . $image_src . '" alt="' . get_bloginfo( 'name' ) . '" ' . $image_meta[3] . ' srcset="' . $image_src . ' 1x, ' . $image_src_retina . ' 2x"></a>';
  } else {
    $site_logo = '<a href="' . esc_url( home_url( '/' ) ) . '"><img src="' . $image_src . '" alt="' . get_bloginfo( 'name' ) . '" ' . $image_meta[3] . '></a>';
  }

  // Get the site's description
  $description = get_bloginfo( 'description' );
  $desc_visibility = ( 'visible' === $desc ) ? 'site-description' : 'site-description screen-reader-text' ;

  $output = '<div class="site-branding">';
  $output .= ( is_front_page() && is_home() ) ? '<h1 class="site-logo">' . $site_logo . '</h1>' : '<p class="site-logo">' . $site_logo . '</p>' ;
  $output .= ( $description ) ? '<p class="' . $desc_visibility . '">' . $description . '</p>' : '' ;
  $output .= '</div>';

  echo $output;
}
endif;

/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @param string $before Element/String before the post author
 * @param string after   Element/String after the post date
 */
if ( ! function_exists( 'gmktg_posted_on' ) ) :
function gmktg_posted_on( $before = '', $after = '' ) {
  $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
  if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
  }

  $time_string = sprintf( $time_string,
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() ),
    esc_attr( get_the_modified_date( 'c' ) ),
    esc_html( get_the_modified_date() )
  );

  $byline = sprintf(
    esc_html_x( 'By %s', 'post author', 'gmktg' ),
    '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
  );

  echo $before . '<span class="byline"> ' . $byline . '</span> <span class="posted-on">' . $time_string . '</span>' . $after ; // WPCS: XSS OK.
}
endif;

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
if ( ! function_exists( 'gmktg_entry_footer' ) ) :
function gmktg_entry_footer() {
  // Hide category and tag text for pages.
  if ( 'post' === get_post_type() ) {
    /* translators: used between list items, there is a space after the comma */
    $categories_list = get_the_category_list( esc_html__( ', ', 'gmktg' ) );
    if ( $categories_list && gmktg_categorized_blog() ) {
      printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'gmktg' ) . '</span>', $categories_list ); // WPCS: XSS OK.
    }

    /* translators: used between list items, there is a space after the comma */
    $tags_list = get_the_tag_list( '', esc_html__( ', ', 'gmktg' ) );
    if ( $tags_list ) {
      printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'gmktg' ) . '</span>', $tags_list ); // WPCS: XSS OK.
    }
  }

  if ( ! is_single() ) {
    edit_post_link(
      sprintf(
        /* translators: %s: Name of current post */
        esc_html__( 'Edit %s', 'gmktg' ),
        the_title( '<span class="screen-reader-text">"', '"</span>', false )
      ),
      '<span class="edit-link">',
      '</span>'
    );
  }
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function gmktg_categorized_blog() {
  if ( false === ( $all_the_cool_cats = get_transient( 'gmktg_categories' ) ) ) {
    // Create an array of all the categories that are attached to posts.
    $all_the_cool_cats = get_categories( array(
      'fields'     => 'ids',
      'hide_empty' => 1,
      'number'     => 2, // We only need to know if there is more than one category.
    ) );

    // Count the number of categories that are attached to the posts.
    $all_the_cool_cats = count( $all_the_cool_cats );

    set_transient( 'gmktg_categories', $all_the_cool_cats );
  }

  if ( $all_the_cool_cats > 1 ) {
    return true; // This blog has more than 1 category so gmktg_categorized_blog should return true.
  } else {
    return false; // This blog has only 1 category so gmktg_categorized_blog should return false.
  }
}

/**
 * Flush out the transients used in gmktg_categorized_blog.
 */
function gmktg_category_transient_flusher() {
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }
  // Like, beat it. Dig?
  delete_transient( 'gmktg_categories' );
}
add_action( 'edit_category', 'gmktg_category_transient_flusher' );
add_action( 'save_post',     'gmktg_category_transient_flusher' );
