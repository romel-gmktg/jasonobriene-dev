<?php
/**
 * Template part for displaying pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package gmktg
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
<?php

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 4,
    'order'          => 'ASC',
    'cat'            => get_query_var('cat')
 );


$parent = new WP_Query( $args );


if ( $parent->have_posts() ) : ?>

    <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>

        <div id="parent-<?php the_ID(); ?>" class="blog-entry">
        	<?php the_post_thumbnail() ?>
            <h2 class="blog-heading"><?php the_title(); ?></h2>
            <a class="arrow-button blog-link" href="<?php the_permalink(); ?>">Read More</a>
        </div>

    <?php endwhile; ?>

<?php endif; wp_reset_query(); ?>


</article>
