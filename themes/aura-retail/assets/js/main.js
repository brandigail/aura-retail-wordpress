/**
 * Aura Retail: mobile menu toggle (vanilla JS).
 */
( function () {
	'use strict';

	var toggle = document.querySelector( '.aura-nav-toggle' );
	var nav = document.getElementById( 'aura-nav' );

	if ( ! toggle || ! nav ) {
		return;
	}

	toggle.addEventListener( 'click', function () {
		var open = nav.classList.toggle( 'is-open' );
		toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
	} );
}() );
