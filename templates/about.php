<?php /* Template Name: About */ ?>


<?php 


get_header('about');

while ( have_posts() ) : the_post();
  get_template_part( 'partials/content', 'page' );
endwhile;

get_footer();
