jQuery(document).ready(function($) {

	$( 'html' ).removeClass( 'no-js' );
	
	$( ".toggle" ).click(
		function(){
			$(this).next().slideToggle();
		}
	);

	function stickyHeader() {
	
		if ( $(document).scrollTop() > 38 ) {
			$( 'body' ).addClass( 'stickyheader' );
		} else {
			$( 'body' ).removeClass( 'stickyheader' );
		}
		
	} // stickyHeader

	
	$( window ).scroll(function() {

		stickyHeader()

	} );
	
	stickyHeader();
	
	if (typeof $.fn.fitVids === 'function') { 
		$( '.single' ).fitVids();
	} // if it fitVids exists, make videos full width
	
	
	// retractable search form on home page
	
	var searchform = $( '.filter-social .search-form' );
	
	searchform.addClass( 'retracted' );
	$( '.search-form.retracted input.search-submit' ).click( function(e) {
		$( '.filter-social .search-form input.search-field' ).width( '280' );
		if ( searchform.hasClass('retracted') ) {
			$( '.filter-social .filter' ).fadeOut();
			searchform.removeClass( 'retracted' );
			searchform.find( '.search-field' ).focus();
			return false;
		}
	} );

	// mobile menu toggle
	$( '.menu-toggle' ).click( function() {
		var header = $( '#header' );
		var initialheight = 62;
		
		if ( ! header.hasClass( 'in-transition' ) ) {
		
			header.addClass( 'in-transition' );
					
			if ( header.hasClass( 'mobile-nav-open' ) ) {
				header.animate( { height : initialheight }, function() { 
					header.removeClass( 'in-transition' ); 
				} );
				header.removeClass( 'mobile-nav-open' );
			} else {
				header.height( 'auto' );
				var newheight = header.height();
				header.height( initialheight );
				header.animate( { height : newheight }, function() { 
					header.removeClass( 'in-transition' ); 
					header.height( 'auto' );
				} );
				header.addClass( 'mobile-nav-open' );
			}

		} // only toggle if not currently animating

		return false;
		
	} ); // mobile menu toggle
	
	
} );