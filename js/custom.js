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
		var newText = $(this).text().replace(' »', '');
		$(this).text( newText );
		// append an icon to the link
		$(this).append('<i class="dpsgi dpsgi-arrow-link ms-2"></i>');
		//// make whole card clickable
		//$(this).addClass('stretched-link');
		
	});

	/*** remove page title and description on front-page ***/
	//$("html body.home.blog.hfeed div#page.site.main div#content.site-content.container.py-5.mt-4 div#primary.content-area main#main.site-main div.py-3.py-md-5.text-center").remove();
  
	/*** add class to figure child, if its a gutenberg template for bootstrap cards with top-image ***/
	$("figure.card-img-top img").addClass('card-img-top');
  

	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	  return new bootstrap.Tooltip(tooltipTriggerEl)
	});

}); // jQuery End



