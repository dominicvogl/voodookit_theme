import Slideout from 'slideout';

const slideout = new Slideout({
	'panel': document.querySelector('.js-slideout-panel'),
	'menu': document.querySelector('.js-slideout-menu'),
	'padding': 256,
	'tolerance': 70
});

document.querySelector('.js-slideout-toggle').addEventListener('click', function() {
	slideout.toggle();
});
