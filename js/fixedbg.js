jQuery(function ($) {
	/*** mobile device fixed background image hack ***/
	$is_mobile_device = null !== navigator.userAgent.match(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/);
	if ($is_mobile_device) {
		$('body').prepend($('<div/>', {
			id: 'fixedbg' 
		}));
		$('.has-parallax').each(function(index, el) {
			var bg = $(this).css('background-image');
			if(bg != 'none') {
				$(this).css('background-image', 'none');
				$('#fixedbg').css('background-image', bg);
				$('#fixedbg').css('z-index', '-10');
				$('#fixedbg').css('position', 'fixed');
				$('#fixedbg').css('left', '0');
				$('#fixedbg').css('top', '0');
				$('#fixedbg').css('right', '0');
				$('#fixedbg').css('height', '100vh');
				$('#fixedbg').css('background-position','50% 50%');
				$('#fixedbg').css('background-repeat','no-repeat');
				$('#fixedbg').css('background-size','cover');
				return false;
			}
		});
	}
}); // jQuery End
