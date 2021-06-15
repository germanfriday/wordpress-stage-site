/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

( function( $ ) {
	"use strict";
	var css = {};
	wp.customize.bind( 'preview-ready', function() {
		if ( $('head').find("#custom-skin-loader-css").length < 1 ) {
			$('head').append('<style type="text/css" id="custom-skin-loader-css"></style>');
		}

		wp.customize.preview.bind( 'sidemenu-highlight', function( data ) {
			if ( true === data.expanded ) {
				if ( ! $('html').hasClass('side-bind') ) {
					$('.aiteko-hamburger__menu').trigger('click');
				}
			} else {
				if ( $('html').hasClass('side-bind') ) {
					$('.aiteko-hamburger__menu').trigger('click');
				}
			}
		});

		wp.customize.preview.bind( 'socicon-highlight', function( data ) {
			if ( true === data.expanded ) {
				if ( ! $('.aiteko-social--list-wrap').hasClass('social_show') ) {
					$('.aiteko-social__button').trigger('click');
				}
			} else {
				if ( $('.aiteko-social--list-wrap').hasClass('social_show') ) {
					$('.aiteko-social__button').trigger('click');
				}
			}
		});
	});

	// single post: taglists.
	// @since 1.0
	wp.customize( 'show_tag_lists', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$('#tag_lists_customization').show();
			} else {
				$('#tag_lists_customization').hide();
			}
		});
	});

	// single post: social share buttons.
	// @since 1.0
	wp.customize( 'show_social_shares', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$('#social_shares_customization').show();
			} else {
				$('#social_shares_customization').hide();
			}
		});
	});

	// single post: author info box.
	// @since 1.0
	wp.customize( 'show_author_box', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$('#author_box_customization').show();
			} else {
				$('#author_box_customization').hide();
			}
		});
	});

	// single post: next/prev link.
	// @since 1.0
	wp.customize( 'post_prev_next', function( value ) {
		value.bind( function( to ) {
			//console.log( to );
			if ( true === to ) {
				$('#post_prev_next_customization').show();
			} else {
				$('#post_prev_next_customization').hide();
			}
		});
	});

	// footer widgets
	// @since 1.0
	wp.customize( 'footer_widgets', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$('.footer-widgets').show();
			} else {
				$('.footer-widgets').hide();
			}
		});
	});

	// Social icons
	// @since 1.0
	wp.customize( 'enable_site_social', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$('.aiteko-social-follow > *').show();
			} else {
				$('.aiteko-social-follow > *').hide();
			}
		});
	});

	var socialsettings = ['social_dribbble','social_facebook','social_github','social_google-plus','social_medium','social_instagram','social_linkedin','social_pinterest','social_twitter','social_youtube','social_youtube'];

	socialsettings.forEach( set => {
		wp.customize( set, function( value ) {
			value.bind( function( to ) {
				if ( '' === to ) {
					if ( $('.aiteko-social-follow').find('.'+set).not(':hidden') ) {
						$('.aiteko-social-follow').find('.'+set).hide();
					}
				} else {
					if ( $('.aiteko-social-follow').find('.'+set).is(':hidden') ) {
						 $('.aiteko-social-follow').find('.'+set).show();
					}
				}
			});
		});
	});

	// Heading font-family
	// @since 1.0
	wp.customize( 'aiteko_heading_font', function( value ) {
		value.bind( function( to ) {
			var fm = to.split(':');
			
			fm = '"'+ fm[0].replace(/\++/g, " ") +'", sans-serif';

			if ( $('head').find('#custom-font-heading').length ) {
				$("#custom-font-heading").attr("href", "//fonts.googleapis.com/css?family="+to);
			} else {
				$('head').prepend('<link id="custom-font-heading" rel="stylesheet" href="https://fonts.googleapis.com/css?family='+to+'" type="text/css" media="screen">');
			}
		});
	});

	// Body font-family
	// @since 1.0
	wp.customize( 'aiteko_body_font', function( value ) {
		value.bind( function( to ) {
			var fm = to.split(':');
			
			fm = '"'+ fm[0].replace(/\++/g, " ") +'", sans-serif';

			if ( $('head').find('#custom-font-body').length ) {
				$("#custom-font-body").attr("href", "//fonts.googleapis.com/css?family="+to);
			} else {
				$('head').prepend('<link id="custom-font-body" rel="stylesheet" href="https://fonts.googleapis.com/css?family='+to+'" type="text/css" media="screen">');
			}
		});
	});

} )( jQuery );