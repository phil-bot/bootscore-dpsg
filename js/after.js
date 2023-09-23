jQuery(function ($) {

/******************
 THEME ADJUSTMENTS
******************/

	/*** Activate bootstrap tooltips ***/
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	  return new bootstrap.Tooltip(tooltipTriggerEl)
	});

}); // jQuery End