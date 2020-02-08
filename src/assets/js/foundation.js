// import Foundation from 'foundation-sites';
// const $mediaquery = new Foundation.MediaQuery(current);
//
// console.info($mediaquery);

// Initialize Foundation framework
(function ($) {

	$(function() {
		$(document).foundation();

// Init accordion in mobile navigation
		const mobileNavigation = new Foundation.AccordionMenu($('.js-accordion-menu'));
	});

})(jQuery);
