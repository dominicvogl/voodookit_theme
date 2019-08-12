import Slideout from 'slideout';

const slideout = new Slideout({
	'panel': document.querySelector('.js-slideout-panel'),
	'menu': document.querySelector('.js-slideout-menu'),
	'padding': 256,
	'tolerance': 70
});

document.querySelector('.js-toggle-slideout').addEventListener('click', function() {
	slideout.toggle();
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
