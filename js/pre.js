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


	$('.heroes .swiper-slide .card-text').addClass('d-none d-xl-block');

	/*** Remove the excerpt and more button on heroes ***/
	if(dpsg_theme_options.swiper_clean == 'true') {
		$('.heroes .swiper-slide .card-text').remove();
	}

	/*** Remove page title and description on front-page ***/
	if(dpsg_theme_options.title == 'true') {
		$('main#main.site-main div.py-3.py-md-5.text-center').remove();
        // And adjust paddings if swiper is not true
        if(dpsg_theme_options.swiper != 'true') {
            $('main#main.site-main').addClass('pt-3');
        }
	}

	/*** Add class to figure child, if its a gutenberg template for bootstrap cards with top-image ***/
	$("figure.card-img-top img").addClass('card-img-top');
	
	/*** Change category-badge color ***/
	$(".category-badge a").removeClass('bg-primary-subtle text-primary-emphasis');
	$(".category-badge a").addClass('bg-secondary');
	
	/*** Change font size of card-header ***/
	$(".card-body a.text-body h2.blog-post-title").toggleClass('h5 h4');
	$(".card-body a.text-body h2.blog-post-title").parent().removeClass('text-decoration-none');

}); // jQuery End



