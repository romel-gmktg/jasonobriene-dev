<?php get_header();

  if ( have_posts() ) {
    if ( is_home() && ! is_front_page() ) {
      echo '<h1 class="page-title screen-reader-text">' . single_post_title( '', false ) . '</h1>';
    }

    while ( have_posts() ) : the_post();
      get_template_part( 'partials/content', get_post_format() );
    endwhile;

    the_posts_navigation();
  } else {
    get_template_part( 'partials/content', 'none' );
  }

get_footer();
