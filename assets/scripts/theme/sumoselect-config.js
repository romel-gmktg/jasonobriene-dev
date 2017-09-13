/**
 * Converts all select fields to a stylable dropdown element.
 */
( function( $ ) {
  $( document ).ready( function() {
    var $select = $( 'select:not(.gfield_select)' );

    if ( $select.length ) {
      $select.SumoSelect();
      sumoAddClasses( 'select.SumoUnder:not(.gfield_select)' );
      sumoTrigger( '.SumoSelect:not(.gfield_select)' );
    }
  } ).bind( 'gform_post_render', function() {
    var $select = $( '.gfield_select' );

    if ( $select.length ) {
      $select.SumoSelect();
      sumoAddClasses( '.gfield_select' );
      sumoTrigger( '.SumoSelect.gfield_select' );
    }
  } );

  /**
   * Retrieve all classes of the select field except SumoUnder then add the classes to the Sumo Select element.
   * @param  {string} selector SumoSelect element
   */
  function sumoAddClasses( selector ) {
    var elements = document.querySelectorAll( selector );
    Array.prototype.forEach.call( elements, function( el, i ) {
      var classes = el.className.split( ' ' ),
          sumoUnderIndex = classes.indexOf( 'SumoUnder' );

      classes.splice( sumoUnderIndex, 1 ); // Remove SumoUnder based on its index

      if ( el.classList ) {
        Array.prototype.forEach.call( classes, function( val, i ) {
          el.parentNode.classList.add( val );
        } );
      } else {
        el.parentNode.className += ' ' + classes.join( ' ' );
      }
    } );
  }

  /**
   * Checks if the dropdown fits below the viewport. If not position it above the select field.
   * @param  {string} selector   SumoSelect element
   * @param  {string} optWrapper SumoSelect option list element
   */
  var sumoDropdownTimeout;
  function sumoDropdown( selector, optWrapper ) {
    var position = selector[0].getBoundingClientRect(),
        listHeight = optWrapper.outerHeight(),
        btmPosition = position.bottom + listHeight + 20,
        topPosition = position.top - listHeight;

    if ( ( btmPosition > $( window ).height() ) && ( topPosition > 20 ) ) {
      optWrapper.addClass( 'up' );
    } else {
      optWrapper.removeClass( 'up' );
    }

    // Keep on checking the dropdown's position if .SumoSelect is open.
    sumoDropdownTimeout = setTimeout( function() {
      sumoDropdown( selector, optWrapper );
    }, 200 );

    if ( ! $( '.SumoSelect' ).hasClass( 'open' ) ) {
      clearTimeout( sumoDropdownTimeout );
    }
  }

  /**
   * Handles the execution of sumoDropdown
   * @param  {string} selector SumoSelect element
   */
  function sumoTrigger( selector ) {
    $( selector ).find( '.SelectBox' ).on( 'click', function( event ) {
      event.stopPropagation();

      var $sumoSelect = $( this ).closest( '.SumoSelect' ),
          $sumoOptWrapper = $sumoSelect.find( '.optWrapper' );

      // Check if SumoSelect is open and not disabled.
      if ( ! $sumoSelect.hasClass( 'disabled' ) && $sumoSelect.hasClass( 'open' ) ) {
        sumoDropdown( $sumoSelect, $sumoOptWrapper );
      } else {
        clearTimeout( sumoDropdownTimeout );
      }
    } );

    $( selector ).keyup(function( event ) {
      var $sumoSelect = $( this ).closest( '.SumoSelect' ),
          $sumoOptWrapper = $sumoSelect.find( '.optWrapper' );

      // Check if SumoSelect is open and not disabled.
      if ( ( event.keyCode === 13 ) && $sumoSelect.hasClass( 'open' ) ) {
        sumoDropdown( $sumoSelect, $sumoOptWrapper );
      }
    } );
  }
} )( jQuery );
