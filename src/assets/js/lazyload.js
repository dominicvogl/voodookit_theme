(function($){

	$(function() {

		var body = $('body');

		var lazyLoad = body.find('.lazyload');
		if(lazyLoad.length > 0) {

			// console.log('lazyload elemente gefunden');
			lazyLoad.lazyLoadXT({
				// optionen
			})

		}

		if(feature.touch) {

			var dataLazy = body.find('img[data-lazy]');
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
