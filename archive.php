<?php get_header();

  if ( have_posts() ) {
    echo '<header class="page-header">';
    the_archive_title( '<h1 class="page-title">', '</h1>' );
    the_archive_description( '<div class="archive-description">', '</div>' );
    echo '</header>';

    while ( have_posts() ) : the_post();
      get_template_part( 'partials/content', get_post_format() );
    endwhile;

    the_posts_navigation();
  } else {
    get_template_part( 'partials/content', 'none' );
  }

get_footer();
