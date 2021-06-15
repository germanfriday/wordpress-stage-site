!function($){"use strict";$(document).ready(function(){
     // Open video in popup
	function wcInitPopupVideo() {
		if ( $( '.video-popup , .kloud-button-wrapper  ' ).length > 0 ) {
			$( '.action-popup-url ,  .about-video-button' ).magnificPopup({
				disableOn: 0,
				type: 'iframe',
			});

			$( '.jws-popup-mp4' ).magnificPopup({
				disableOn: 0,
				type: 'inline',
			});
		}
	};
    wcInitPopupVideo();
})}(window.jQuery);