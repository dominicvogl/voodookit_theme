import $ from 'jquery'
import 'slick-slider'

$('.slick-slider').each(function() {
	$(this).slick({
		// options
	})
};

$('.js-postloop-carousel').each(function() {

	$(this).slick(
		{
			// options
			slidesToScroll: 1,
			slidesToShow: 1,
			mobileFirst: true,
			variableWidth: true,
			infinite: false,
			responsive: [
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 1
					}
				}
			]
		}
	)

});
