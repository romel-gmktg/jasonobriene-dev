<?php
/**
 * Template part for displaying pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package gmktg
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="page-header">
    <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
  </header>

  <div class="page-content clear">
    <?php the_content(); ?>

    <?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gmktg' ), 'after' => '</div>' ) ); ?>
  </div>
</article>
