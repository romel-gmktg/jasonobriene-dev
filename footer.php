        </main><!-- #main -->

        <?php get_sidebar(); ?>

      </div><!-- .page-row -->

    </div><!-- #content -->

    <footer id="colophon" class="site-footer">

      <div class="site-widgets">
        <?php if ( is_active_sidebar( 'footer' ) ) : ?>
          <div class="widget-area footer-widget-area page-row">
            <?php dynamic_sidebar( 'footer' ); ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="page-row site-map">
        <div class="company-name">
          <span>&#64; 2017 Jason O'Beirne</span>
        </div>
        <div class="site-info">
          <a href="<?php echo esc_url( 'https://www.gourmetmarketing.net/hospitality-website-design/' ); ?>" target="_blank" rel="noopener noreferrer">Website Design</a> by <a href="<?php echo esc_url( 'https://www.gourmetmarketing.net/' ); ?>" target="_blank" rel="noopener noreferrer">Gourmet Marketing</a>
        </div>
      </div><!-- .page-row -->

    </footer><!-- #colophon -->
  </div><!-- #page -->

  <script type="text/javascript">
    document.getElementsByTagName('html')[0].classList.remove('no-js');
    document.getElementsByTagName('html')[0].className += 'js';
  </script>

  <?php wp_footer(); ?>

</body>

</html>
