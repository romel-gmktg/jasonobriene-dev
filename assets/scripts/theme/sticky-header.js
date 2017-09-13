/**
 * Handles toggling the sticky class at the header when scrolling past it.
 */
(function() {
  var stickyHeader = document.getElementById( 'masthead' ), // Get the sticky element with the id of `masthead`.
      boundary = stickyHeader.offsetHeight; // Then record the current position, so when we cross the boundary the `sticky` class can be toggled.

  // When the page scrolls, do as little as possible,
  // in this case we're just registering a rAF callback to `checkSticky`.
  window.onscroll = function( event ) {
    requestAnimationFrame( checkSticky );
  };

  function checkSticky() {
    var y = window.scrollY + 2, // Collect current scroll position, with a arbitrary amount of inertia.
        isSticky = document.body.classList.contains( 'sticky' ); // Check if the element contains the `sticky` class already.

    if ( y > boundary ) {
      // If we're in the "sticky" boundary, and it's not already sticky,
      // then apply the class, otherwise do nothing.
      if ( ! isSticky ) {
        document.body.classList.add( 'sticky' );
      }
    } else if ( isSticky ) {
      // Otherwise, we're inside the region *and* the sticky class needs to be removed.
      document.body.classList.remove( 'sticky' );
    }
  }
})();
