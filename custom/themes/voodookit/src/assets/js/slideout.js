import { MediaQuery } from 'foundation-sites';
import Slideout from 'slideout';

const slideout = new Slideout({
	'panel': document.querySelector('.js-slideout-panel'),
	'menu': document.querySelector('.js-slideout-menu'),
	'padding': 256,
	'tolerance': 70
});

const slideoutToggle = document.querySelector('.js-toggle-slideout');
let slideoutToggleHeight = slideoutToggle.offsetHeight;

slideoutToggle.addEventListener('click', function() {
	slideout.toggle();
});

/**
 * set the height of the slideout
 * @param height
 */

if(slideoutToggleHeight > 0 && !Foundation.MediaQuery.is('large')) {
	document.querySelector('body').style.paddingBottom = slideoutToggle.offsetHeight + 'px';
}

$(window).on('changed.zf.mediaquery', function(event, newSize, oldSize) {
	console.log(newSize, oldSize);

	let toggler = document.querySelector('.js-toggle-slideout');

	if(newSize === 'large' || newSize === 'xlarge') {
		document.querySelector('body').style.paddingBottom = 0 + 'px';
	}
	else {
		document.querySelector('body').style.paddingBottom = toggler.offsetHeight + 'px';
	}

});



// const fixedHeader = document.querySelector('.js-fixed-header');
//
// // if fixed header is in usage
// slideout.on('translate', function(translated) {
// 	fixedHeader.style.transform = 'translateX(' + translated + 'px)';
// });
//
// slideout.on('beforeopen', function () {
// 	fixedHeader.style.transition = 'transform 300ms ease';
// 	fixedHeader.style.transform = 'translateX(256px)';
// });
//
// slideout.on('beforeclose', function () {
// 	fixedHeader.style.transition = 'transform 300ms ease';
// 	fixedHeader.style.transform = 'translateX(0px)';
// });
//
// slideout.on('open', function () {
// 	fixedHeader.style.transition = '';
// });
//
// slideout.on('close', function () {
// 	fixedHeader.style.transition = '';
// });
