// Include external vendors
const accordion = require('accordion');


function initAccordions() {

	// select all accordion elements on the page
	const $accordions = document.querySelectorAll(".js--accordion");


// loop through the items
	if($accordions.length > 0) {
		$accordions.forEach(function (item, index) {
			new Accordion(item);
		});
	}

}

// init this script
initAccordions();
