(function($){

	$(function() {

		var lazyLoad = $('body').find('.lazyload');
		if(lazyLoad.length > 0) {

			// console.log('lazyload elemente gefunden');
			lazyLoad.lazyLoadXT({
				// optionen
			})

		}

		if(Modernizr.touchevents) {

			var dataLazy = $('body').find('img[data-lazy]');
			if(dataLazy.length > 0) {

				// console.log('lazyload elemente gefunden');
				dataLazy.lazyLoadXT({
					// optionen
					srcAttr: 'data-lazy'
				});

			}

		}

	})

})(jQuery);
