<?php get_header(); ?>

  <section class="error-404 not-found">

    <header class="page-header">
      <h1 class="page-title"><?php esc_html_e( '404', 'gmktg' ); ?></h1>
    </header><!-- .page-header -->

    <div class="page-content">
      <p>
        <?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'gmktg' ); ?><br>
        <?php esc_html_e( 'It looks like nothing was found at this location.', 'gmktg' ); ?>
      </p>
    </div><!-- .page-content -->

  </section><!-- .error-404 -->

<?php get_footer();
