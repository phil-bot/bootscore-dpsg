// check if is in viewport
function isOnScreen(elem) {
	// if the element doesn't exist, abort
	if( elem.length == 0 ) {
		return;
	}
	var $window = jQuery(window)
	var viewport_top = $window.scrollTop()
	var viewport_height = $window.height()
	var viewport_bottom = viewport_top + viewport_height
	var $elem = jQuery(elem)
	var top = $elem.offset().top
	var height = $elem.height()
	var bottom = top + height

	return (top >= viewport_top && top < viewport_bottom) ||
	(bottom > viewport_top && bottom <= viewport_bottom) ||
	(height > viewport_height && top <= viewport_top && bottom >= viewport_bottom)
}


jQuery(function ($) {

	/*** mobile device fixed background image hack ***/
	$is_mobile_device = null !== navigator.userAgent.match(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/);

	//if ($is_mobile_device) {

		// create helper div for each fixed-bg wp-parallax
		$('.has-parallax').each(function(index) {
			var image = $(this).css('background-image')
			var idx = index + 1;
			if(image != 'none') {
				$(this).attr('id', 'fixedbg-content-' + idx);
				$(this).css('background-image', 'none');
				$('body').prepend($('<div/>', {
					id: 'fixedbg-helper-' + idx,
					css: {
						'z-index': '-' + idx,
						'position': 'fixed',
						'left': '0',
						'top': '0',
						'right': '0',
						'height': '100vh',
						'background-repeat': 'no-repeat',
						'background-size': 'cover',
						'background-position': '50%',
						'background-image': image
					}
				}));
				if(idx > 1) {
					$('#fixedbg-helper-' + idx).hide();
				}
			};
		});

		var scrollIdx = 0;
		var last = 0;
		var lastScrollTop = 0;
		$(window).scroll(function(event){

		   var st = $(this).scrollTop();
		   if (st > lastScrollTop){

				// DOWNSCROLL
				$("[id^=fixedbg-content-]").each(function() {

					if( isOnScreen( $(this) ) ) {
						scrollIdx = $(this).attr('id').match(/[\d]/)[0];
						if ( scrollIdx > last ) {
							console.log(scrollIdx + ' > ' + last);
							last = scrollIdx;
						}
					}

				});

		   } else {


				// UPSCROLLL
				$("[id^=fixedbg-content-]").each(function() {

					if( isOnScreen( $(this) ) ) {
						scrollIdx = $(this).attr('id').match(/[\d]/)[0];
						if ( scrollIdx < last ) {
							console.log(scrollIdx + ' < ' + last);
							last = scrollIdx;
						}
					}

				});
			
		   }
		   lastScrollTop = st;
		});

	//}

}); // jQuery End



				/*$("[id^=fixedbg-content-]").each(function() {
					var idx = $(this).attr('id').match(/[\d]/);
					if($(this).isInViewport()) {
						$('#fixedbg-helper-' + idx).show();
					} else {
						$('#fixedbg-helper-' + idx).fadeOut('fast');
					};
				});*/