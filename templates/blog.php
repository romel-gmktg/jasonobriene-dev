<?php /* Template Name: Blog */ ?>


<?php 

get_header('blog');

while ( have_posts() ) : the_post();
  get_template_part( 'partials/content-blog', 'page' );
endwhile;

get_footer();
