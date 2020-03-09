// import { MediaQuery } from 'foundation-sites';
// import Slideout from 'slideout';

(function ($) {

	$(function () {

		let toggler = document.querySelector('.js-toggle-slideout');
		let slideout;
		slideout = new Slideout({
			'panel': document.querySelector('.js-slideout-panel'),
			'menu': document.querySelector('.js-slideout-menu'),
			'padding': 256,
			'tolerance': 70
		});

		let close;
		close = (eve) => {
			eve.preventDefault();
			slideout.close();
		};

		slideout
			.on('beforeopen', function () {
				this.panel.classList.add('panel-open');
			})
			.on('open', function () {
				this.panel.addEventListener('click', close);
			})
			.on('beforeclose', function () {
				this.panel.classList.remove('panel-open');
				this.panel.removeEventListener('click', close);
			});

		const setBodyPadding = (togglerHeight) => {
			document.querySelector('body').style.paddingBottom = togglerHeight + 'px';
		};

		const initTogglerPadding = (toggler) => {
			if (toggler.offsetHeight > 0 && !Foundation.MediaQuery.is('large')) {
				setBodyPadding(toggler.offsetHeight);
			}

			$(window).on('changed.zf.mediaquery', function (event, newSize, oldSize) {
				// console.log(event, newSize, oldSize);

				toggler = document.querySelector('.js-toggle-slideout');
				setBodyPadding(toggler.offsetHeight);

			});
		};


// Init functions
		initTogglerPadding(toggler);

// Events
		toggler.addEventListener('click', function () {
			slideout.toggle();
		});


	});

}(jQuery));
