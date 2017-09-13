<?php get_header();

while ( have_posts() ) : the_post();
  get_template_part( 'partials/content', get_post_format() );

  the_post_navigation();
endwhile;

get_footer();
