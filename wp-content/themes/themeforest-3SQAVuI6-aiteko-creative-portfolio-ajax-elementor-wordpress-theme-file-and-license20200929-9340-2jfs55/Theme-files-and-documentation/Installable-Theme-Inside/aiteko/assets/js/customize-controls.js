/**
 * Scripts within the customizer controls window.
 */
( function() {
	"use strict";
	wp.customize.bind( 'ready', function() {

		wp.customize.section( 'theme_skin_side', function( section ) {
			section.expanded.bind( function( isExpanding ) {
				wp.customize.previewer.send( 'sidemenu-highlight', { expanded: isExpanding });
			} );
		} );

		wp.customize.section( 'theme_social_icons', function( section ) {
			section.expanded.bind( function( isExpanding ) {
				wp.customize.previewer.send( 'socicon-highlight', { expanded: isExpanding });
			} );
		} );

		WipUI.init();
	});

	var WipUI = {
		init: function() {
			var d=this, el = jQuery('.wipThemes_ui_toggle_parent, .wipThemes_ui_refresher_parent'), sel = jQuery('.wipThemes-font-ui'), rng = jQuery('.wipThemes_ui_range_parent');
			if ( el.length ) {
				el.each( function() {
					return d.convert(el);
				});
			}
			if ( sel.length ) {
				sel.each( function() {
					jQuery(sel).find('select').selectpicker({container: 'body', size: 10});
				});
			}
			if ( rng.length ) {
				rng.each( function() {
					var rr=this, rrg = jQuery(this).find('input[type="range"]'), unt = jQuery(this).data('unit');
					rrg.on('change keyup', function(){
						jQuery(rr).find('input[type="text"]').val(this.value+' '+unt);
					});
					if ( rrg[0].addEventListener ) {
						rrg[0].addEventListener("input", function() {
							jQuery(rr).find('input[type="text"]').val(rrg[0].value+' '+unt);
						}, false);
					} else {
						rrg[0].attachEvent("oninput", function() {
							jQuery(rr).find('input[type="text"]').val(rrg[0].value+' '+unt);
						});
					}
				});
			}
		},
		convert: function( el ) {
			var els = jQuery(el), inp = els.find('input[type="checkbox"]');
			inp.hide();
		}
	}
})( jQuery );
