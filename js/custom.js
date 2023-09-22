jQuery(function ($) {

/******************
 THEME ADJUSTMENTS
******************/

	/*** Add classes to the main nav for user friendliness ***/
	$('li.current-page-ancestor').children('a').addClass('active');
	$('li.current-page-ancestor').parents('li').children('a').addClass('active');

	/*** Change Read More Links ***/
	$("a.read-more").each(function(){
		// remove the " »"
		var newText = $(this).text().trim().replace('»', '')
		$(this).text( newText.trim() );
		// append an icon to the link
		$(this).append('<i class="dpsgi dpsgi-arrow-link ms-2"></i>');
		//// make whole card clickable
		if(dpsg_theme_options.stretched == 'true') {
			$(this).addClass('stretched-link');
		}
	});

	/*** remove page title and description on front-page ***/
	if(dpsg_theme_options.title == 'true') {
		$('main#main.site-main div.py-3.py-md-5.text-center').remove();
	}

	/*** remove page title and description on front-page ***/
	if(dpsg_theme_options.title == 'true' && dpsg_theme_options.swiper != 'true') {
		$('main#main.site-main').addClass('pt-3');
	}
	
	/*** add class to figure child, if its a gutenberg template for bootstrap cards with top-image ***/
	$("figure.card-img-top img").addClass('card-img-top');
	
	/*** change category-badge color ***/
	$(".category-badge a").removeClass('bg-primary-subtle text-primary-emphasis');
	$(".category-badge a").addClass('bg-secondary');
	
	/*** change font size of card-header ***/
	$(".card-body a.text-body h2.blog-post-title").toggleClass('h5 h4');
	$(".card-body a.text-body h2.blog-post-title").parent().removeClass('text-decoration-none');

	/*** activate bootstrap tooltips ***/
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	  return new bootstrap.Tooltip(tooltipTriggerEl)
	});

}); // jQuery End