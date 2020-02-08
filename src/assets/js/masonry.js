(function ($) {

	$(function () {

		var $grid = $('.masonry').masonry({
			// set itemSelector so .grid-sizer is not used in layout
			itemSelector: '.grid-item',
			// use element for option
			columnWidth: '.grid-sizer',
			percentPosition: true
		});

		$grid.on('layoutComplete', function () {
			// Your settings
		});

		$grid.imagesLoaded().progress(function () {
			$grid.masonry('layout');
		});

	})

})(jQuery);
