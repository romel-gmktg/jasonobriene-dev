<?php
  /**
   * Check if given template has a sidebar.
   */
  if ( is_404() || is_page_template( 'templates/full-width.php' ) ) {
    return;
  }
?>

<aside id="sidebar" class="widget-area sidebar-widget-area">
  <?php dynamic_sidebar( 'sidebar' ); ?>
</aside><!-- #sidebar -->
